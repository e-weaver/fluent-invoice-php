<?php

// Note: You must run `composer install` before running this script!
require_once __DIR__ . '/vendor/autoload.php';

use Eweaver\FluentInvoice\Invoice;

echo "Generating invoice.pdf...\n";

Invoice::make('INV-2026-001')
    ->from('eWeaver Tech', 'hello@eweaver.in')
    ->to('John Doe', 'john@example.com')
    ->addItem('Custom Web Development', 2500)
    ->addItem('Monthly SEO Retainer', 500)
    ->setNotes("Thank you for your business!\nPlease pay within 30 days.")
    ->save(__DIR__ . '/invoice.pdf');

echo "Done! Check invoice.pdf in this folder.\n";
