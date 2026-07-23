<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif; color: #333; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; font-size: 16px; line-height: 24px; <?php if($hasBorder): ?>border: 1px solid #eaeaea;<?php endif; ?> }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        .invoice-box table td { padding: 8px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 30px; }
        .invoice-box table tr.top table td.title { font-size: 40px; line-height: 40px; color: <?= htmlspecialchars($color) ?>; font-weight: bold; }
        .invoice-box table tr.top table td.title img { max-height: 60px; max-width: 250px; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #f8fafc; border-bottom: 2px solid #e2e8f0; font-weight: bold; color: #475569; }
        .invoice-box table tr.item td { border-bottom: 1px solid #f1f5f9; color: #64748b; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #cbd5e1; font-weight: bold; font-size: 20px; color: #0f172a; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <?php if (!empty($logo)): ?>
                                    <img src="<?= htmlspecialchars($logo) ?>" alt="Logo">
                                <?php else: ?>
                                    INVOICE
                                <?php endif; ?>
                            </td>
                            <td>
                                Invoice #: <?= htmlspecialchars($id) ?><br>
                                Created: <?= htmlspecialchars($date) ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>From:</strong><br>
                                <?php foreach ($from as $line): ?>
                                    <?= htmlspecialchars($line) ?><br>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <strong>To:</strong><br>
                                <?php foreach ($to as $line): ?>
                                    <?= htmlspecialchars($line) ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item Description</td>
                <td>Amount</td>
            </tr>
            <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
            <tr class="item">
                <td><?= htmlspecialchars($item['description']) ?> (x<?= $item['quantity'] ?>)</td>
                <td><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td></td>
                <td>Total Due: <?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
            </tr>
        </table>
        <?php if (!empty($notes)): ?>
        <p style="margin-top: 50px; color: #64748b; font-size: 14px;"><strong>Notes:</strong><br><?= nl2br(htmlspecialchars($notes)) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
