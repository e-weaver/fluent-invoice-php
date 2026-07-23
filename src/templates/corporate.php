<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; font-size: 14px; line-height: 1.5; }
        .invoice-box { max-width: 800px; margin: auto; padding: 0; <?php if($hasBorder): ?>border: 1px solid #ccc;<?php endif; ?> }
        .header { background-color: <?= htmlspecialchars($color) ?>; color: #fff; padding: 40px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
        .text-right { text-align: right; }
        .title { font-size: 32px; font-weight: bold; margin-bottom: 5px; }
        .content { padding: 40px; }
        .info-table { margin-bottom: 40px; }
        .info-table td { padding: 0; }
        .section-title { font-weight: bold; color: <?= htmlspecialchars($color) ?>; border-bottom: 2px solid <?= htmlspecialchars($color) ?>; margin-bottom: 10px; display: inline-block; padding-bottom: 3px; }
        .items-table { border: 1px solid #ddd; }
        .items-table th { background-color: #ecf0f1; padding: 12px; text-align: left; border-bottom: 1px solid #ddd; font-weight: bold; color: <?= htmlspecialchars($color) ?>; }
        .items-table td { padding: 12px; border-bottom: 1px solid #ddd; }
        .items-table .text-right { text-align: right; }
        .total-row td { background-color: #f8f9fa; font-weight: bold; font-size: 16px; border-top: 2px solid <?= htmlspecialchars($color) ?>; }
        .notes { margin-top: 40px; padding: 20px; background-color: #f8f9fa; border-left: 4px solid <?= htmlspecialchars($color) ?>; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <?php if (!empty($logo)): ?>
                            <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height: 60px; max-width: 250px;">
                        <?php else: ?>
                            <div class="title">INVOICE</div>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <strong>Invoice #<?= htmlspecialchars($id) ?></strong><br>
                        Date: <?= htmlspecialchars($date) ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="content">
            <table class="info-table">
                <tr>
                    <td style="width: 50%; padding-right: 20px;">
                        <div class="section-title">BILL FROM</div><br>
                        <?php foreach ($from as $line): ?>
                            <?= htmlspecialchars($line) ?><br>
                        <?php endforeach; ?>
                    </td>
                    <td style="width: 50%;">
                        <div class="section-title">BILL TO</div><br>
                        <?php foreach ($to as $line): ?>
                            <?= htmlspecialchars($line) ?><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>

            <table class="items-table">
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
                <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
                <tr>
                    <td><?= htmlspecialchars($item['description']) ?> (x<?= $item['quantity'] ?>)</td>
                    <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td class="text-right">Total Due:</td>
                    <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
                </tr>
            </table>

            <?php if (!empty($notes)): ?>
            <div class="notes">
                <strong>Notes:</strong><br>
                <?= nl2br(htmlspecialchars($notes)) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
