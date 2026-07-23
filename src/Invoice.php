<?php

namespace Eweaver\FluentInvoice;

use Dompdf\Dompdf;
use Dompdf\Options;

class Invoice
{
    private $data = [
        'id' => '',
        'from_name' => '',
        'from_email' => '',
        'to_name' => '',
        'to_email' => '',
        'items' => [],
        'notes' => '',
        'date' => '',
    ];

    public function __construct(string $id)
    {
        $this->data['id'] = $id;
        $this->data['date'] = date('F j, Y');
    }

    public static function make(string $id): self
    {
        return new self($id);
    }

    public function from(string $name, string $email = ''): self
    {
        $this->data['from_name'] = $name;
        $this->data['from_email'] = $email;
        return $this;
    }

    public function to(string $name, string $email = ''): self
    {
        $this->data['to_name'] = $name;
        $this->data['to_email'] = $email;
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

    public function render(): string
    {
        ob_start();
        extract($this->data);
        include __DIR__ . '/templates/template.php';
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
