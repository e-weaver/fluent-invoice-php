<?php

// Note: You must run `composer install` before running this script!
require_once __DIR__ . '/vendor/autoload.php';

use Eweaver\FluentInvoice\Invoice;

echo "Generating invoice.pdf...\n";

Invoice::make('INV-2026-001')
    ->from([
        'eWeaver Tech',
        '123 Developer Lane',
        'Tech City, TC 90210',
        'hello@eweaver.in'
    ])
    ->to([
        'John Doe',
        '99 Client Avenue',
        'Customer City, CC 80112',
        'john@example.com'
    ])
    ->addItem('Custom Web Development', 2500, 1)
    ->addItem('Monthly SEO Retainer', 500, 2)
    ->currency('₹')
    ->setNotes("Thank you for your business!\nPlease pay within 30 days.")
    ->save(__DIR__ . '/invoice.pdf');

echo "Done! Check invoice.pdf in this folder.\n";
