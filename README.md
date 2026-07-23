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
    ->from([
        'eWeaver Tech',
        '123 Developer Lane',
        'Tech City, TC 90210',
        'hello@eweaver.in'
    ])
    ->to([
        'Acme Corp',
        '456 Business Blvd',
        'Corporate Town, CT 10001',
        'billing@acme.com'
    ])
    ->addItem('Custom Web Development', 1500)
    ->addItem('Monthly SEO Retainer', 500)
    ->currency('€')
    ->logo('https://example.com/path/to/logo.png')
    ->setNotes('Thank you for your business!')
    ->save('invoice.pdf');
```

And that's it! A beautifully formatted PDF will be saved to your specified path.

### Auto-fill "From" Address via `.env`
If you are generating invoices for your own company, you don't need to manually pass the `->from()` array every time. You can define the following environment variables in your `.env` file, and the package will automatically populate the "From" section for you!

```env
INVOICE_FROM_NAME="eWeaver Tech"
INVOICE_FROM_STREET="123 Developer Lane"
INVOICE_FROM_CITY="Tech City, TC 90210"
INVOICE_FROM_EMAIL="hello@eweaver.in"
INVOICE_FROM_PHONE="+1 (555) 123-4567"
```

## Features

- **Fluent API:** Clean, chainable methods.
- **Customizable:** Add your own logo, currency symbols, and full multi-line addresses.
- **Built-in Template:** Comes with a highly professional, modern invoice template out of the box.
- **Dompdf Engine:** Built on top of the industry-standard `dompdf` for reliable rendering.

## License

MIT License
