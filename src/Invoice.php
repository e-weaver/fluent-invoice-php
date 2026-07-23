<?php

namespace Eweaver\FluentInvoice;

use Dompdf\Dompdf;
use Dompdf\Options;

class Invoice
{
    private $data = [
        'id' => '',
        'from' => [],
        'to' => [],
        'items' => [],
        'notes' => '',
        'date' => '',
        'currency' => '$',
        'logo' => '',
        'template' => 'default',
        'color' => '',
        'hasBorder' => null,
    ];

    public function __construct(string $id)
    {
        $this->data['id'] = $id;
        $this->data['date'] = date('F j, Y');
        
        // Attempt to load default 'from' address from .env / environment variables
        $defaultFrom = [];
        if (getenv('INVOICE_FROM_NAME')) $defaultFrom[] = getenv('INVOICE_FROM_NAME');
        if (getenv('INVOICE_FROM_STREET')) $defaultFrom[] = getenv('INVOICE_FROM_STREET');
        if (getenv('INVOICE_FROM_CITY')) $defaultFrom[] = getenv('INVOICE_FROM_CITY');
        if (getenv('INVOICE_FROM_EMAIL')) $defaultFrom[] = getenv('INVOICE_FROM_EMAIL');
        if (getenv('INVOICE_FROM_PHONE')) $defaultFrom[] = getenv('INVOICE_FROM_PHONE');

        if (!empty($defaultFrom)) {
            $this->data['from'] = $defaultFrom;
        }
    }

    public static function make(string $id): self
    {
        return new self($id);
    }

    public function template(string $name): self
    {
        $this->data['template'] = $name;
        return $this;
    }

    public function color(string $hex): self
    {
        $this->data['color'] = $hex;
        return $this;
    }

    public function withBorder(bool $hasBorder = true): self
    {
        $this->data['hasBorder'] = $hasBorder;
        return $this;
    }

    public function from(array $details): self
    {
        $this->data['from'] = $details;
        return $this;
    }

    public function to(array $details): self
    {
        $this->data['to'] = $details;
        return $this;
    }

    public function addItem(string $description, float $price, int $quantity = 1): self
    {
        $this->data['items'][] = [
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $price * $quantity
        ];
        return $this;
    }

    public function setNotes(string $notes): self
    {
        $this->data['notes'] = $notes;
        return $this;
    }

    public function currency(string $symbol): self
    {
        $this->data['currency'] = $symbol;
        return $this;
    }

    public function logo(string $path): self
    {
        $this->data['logo'] = $path;
        return $this;
    }

    public function render(): string
    {
        ob_start();
        
        // Apply default colors and borders per template if not explicitly set
        if (empty($this->data['color'])) {
            switch ($this->data['template']) {
                case 'creative':
                    $this->data['color'] = '#ff9a9e';
                    break;
                case 'corporate':
                    $this->data['color'] = '#2c3e50';
                    break;
                case 'elegant':
                    $this->data['color'] = '#4a5568';
                    break;
                case 'minimal':
                    $this->data['color'] = '#000000';
                    break;
                default:
                    $this->data['color'] = '#3b82f6';
                    break;
            }
        }

        if ($this->data['hasBorder'] === null) {
            $this->data['hasBorder'] = in_array($this->data['template'], ['corporate', 'elegant']);
        }

        extract($this->data);
        
        $templatePath = __DIR__ . "/templates/{$template}.php";
        if (!file_exists($templatePath)) {
            $templatePath = __DIR__ . "/templates/default.php";
        }
        
        include $templatePath;
        return ob_get_clean();
    }

    public function save(string $path)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($path, $dompdf->output());
    }
}
