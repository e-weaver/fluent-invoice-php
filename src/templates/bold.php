<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: 'Impact', 'Arial Black', sans-serif; color: #000; font-size: 16px; line-height: 1.4; }
        .invoice-box { max-width: 800px; margin: auto; padding: 40px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px; vertical-align: top; }
        .text-right { text-align: right; }
        .title { font-size: 60px; font-weight: 900; text-transform: uppercase; line-height: 1; margin-bottom: 20px; border-bottom: 8px solid #000; padding-bottom: 10px; }
        .info-table { margin-bottom: 40px; font-family: 'Arial', sans-serif; font-size: 14px;}
        .info-box { background: #000; color: #fff; padding: 20px; margin-bottom: 20px; }
        .info-title { font-family: 'Impact', sans-serif; font-size: 20px; letter-spacing: 1px; margin-bottom: 10px; border-bottom: 2px solid #333; padding-bottom: 5px;}
        .items-table { border: 4px solid #000; font-family: 'Arial', sans-serif; }
        .items-table th { background: #000; color: #fff; padding: 15px; font-family: 'Impact', sans-serif; font-size: 18px; letter-spacing: 1px; }
        .items-table td { padding: 15px; border-bottom: 2px solid #000; font-weight: bold; }
        .items-table .text-right { text-align: right; }
        .total-row td { font-family: 'Impact', sans-serif; font-size: 24px; background: #fff; color: #000; border-top: 4px solid #000; }
        .notes { margin-top: 40px; padding: 20px; border: 4px solid #000; font-family: 'Arial', sans-serif; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="title">
            <?php if (!empty($logo)): ?>
                <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height: 80px; max-width: 300px;">
            <?php else: ?>
                INVOICE
            <?php endif; ?>
        </div>
        
        <table class="info-table">
            <tr>
                <td style="width: 33%; padding: 0 10px 0 0;">
                    <div class="info-box" style="background: transparent; color: #000; border: 4px solid #000;">
                        <div class="info-title">DETAILS</div>
                        <strong>INV #:</strong> <?= htmlspecialchars($id) ?><br>
                        <strong>DATE:</strong> <?= htmlspecialchars($date) ?>
                    </div>
                </td>
                <td style="width: 33%; padding: 0 10px;">
                    <div class="info-box">
                        <div class="info-title">FROM</div>
                        <?php foreach ($from as $line): ?>
                            <?= htmlspecialchars($line) ?><br>
                        <?php endforeach; ?>
                    </div>
                </td>
                <td style="width: 33%; padding: 0 0 0 10px;">
                    <div class="info-box" style="background: #e74c3c;">
                        <div class="info-title">TO</div>
                        <?php foreach ($to as $line): ?>
                            <?= htmlspecialchars($line) ?><br>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <tr>
                <th style="text-align: left;">DESCRIPTION</th>
                <th class="text-right">AMOUNT</th>
            </tr>
            <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
            <tr>
                <td><?= htmlspecialchars($item['description']) ?> (x<?= $item['quantity'] ?>)</td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td class="text-right">TOTAL DUE</td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
            </tr>
        </table>

        <?php if (!empty($notes)): ?>
        <div class="notes">
            <strong style="font-family: 'Impact'; font-size: 20px;">NOTES</strong><br>
            <?= nl2br(htmlspecialchars($notes)) ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
