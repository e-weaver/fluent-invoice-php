# Fluent Invoice PHP

A lightweight, beautiful, and highly fluent PHP wrapper around `dompdf` that makes generating professional PDF invoices a one-liner.

## Why use this?

Generating PDFs in PHP is traditionally painful, requiring verbose configuration and ugly HTML concatenations. This library provides a clean, modern, and fluent API to generate beautiful invoices instantly.

## Installation

```bash
composer require e-weaver/fluent-invoice-php
```

## Usage

```php
use Eweaver\FluentInvoice\Invoice;

Invoice::make('INV-1023')
    ->from('eWeaver Tech', 'hello@eweaver.in')
    ->to('Acme Corp', 'billing@acme.com')
    ->addItem('Custom Web Development', 1500)
    ->addItem('Monthly SEO Retainer', 500)
    ->setNotes('Thank you for your business!')
    ->save('invoice.pdf');
```

And that's it! A beautifully formatted PDF will be saved to your specified path.

## Features

- **Fluent API:** Clean, chainable methods.
- **Built-in Template:** Comes with a highly professional, modern invoice template out of the box.
- **Dompdf Engine:** Built on top of the industry-standard `dompdf` for reliable rendering.

## License

MIT License
