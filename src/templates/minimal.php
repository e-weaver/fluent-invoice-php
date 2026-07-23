<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif; color: #111; font-size: 13px; line-height: 1.6; }
        .invoice-box { max-width: 800px; margin: auto; padding: 40px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px 0; vertical-align: top; }
        .text-right { text-align: right; }
        .header-table { margin-bottom: 60px; }
        .title { font-size: 16px; font-weight: bold; letter-spacing: 4px; text-transform: uppercase; }
        .info-table { margin-bottom: 50px; }
        .info-title { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: #888; margin-bottom: 5px; }
        .items-table td { padding: 15px 0; }
        .heading td { border-bottom: 1px solid #000; font-weight: bold; text-transform: uppercase; font-size: 11px; letter-spacing: 2px; }
        .item td { border-bottom: 1px solid #f0f0f0; }
        .total td { font-weight: bold; font-size: 16px; border-top: 2px solid #000; padding-top: 20px; }
        .notes { margin-top: 60px; font-size: 12px; color: #666; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="header-table">
            <tr>
                <td>
                    <?php if (!empty($logo)): ?>
                        <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height: 40px; max-width: 200px;">
                    <?php else: ?>
                        <div class="title">INVOICE</div>
                    <?php endif; ?>
                </td>
                <td class="text-right">
                    #<?= htmlspecialchars($id) ?><br>
                    <?= htmlspecialchars($date) ?>
                </td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <div class="info-title">From</div>
                    <?php foreach ($from as $line): ?>
                        <?= htmlspecialchars($line) ?><br>
                    <?php endforeach; ?>
                </td>
                <td style="width: 50%;">
                    <div class="info-title">To</div>
                    <?php foreach ($to as $line): ?>
                        <?= htmlspecialchars($line) ?><br>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <tr class="heading">
                <td>Description</td>
                <td class="text-right">Amount</td>
            </tr>
            <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
            <tr class="item">
                <td><?= htmlspecialchars($item['description']) ?> (x<?= $item['quantity'] ?>)</td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td></td>
                <td class="text-right">Total: <?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
            </tr>
        </table>

        <?php if (!empty($notes)): ?>
        <div class="notes">
            <?= nl2br(htmlspecialchars($notes)) ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
