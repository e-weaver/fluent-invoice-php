<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: 'Georgia', serif; color: #444; font-size: 14px; line-height: 1.8; background: #fff; }
        .invoice-box { max-width: 800px; margin: auto; padding: 50px; border: 1px solid #eaeaea; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px 0; vertical-align: top; }
        .text-right { text-align: right; }
        .header-table { border-bottom: 2px solid <?= htmlspecialchars($color) ?>; padding-bottom: 20px; margin-bottom: 40px; }
        .title { font-size: 32px; font-weight: normal; color: <?= htmlspecialchars($color) ?>; font-style: italic; letter-spacing: 1px; }
        .info-table { margin-bottom: 50px; }
        .info-title { font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: <?= htmlspecialchars($color) ?>; margin-bottom: 5px; font-weight: bold; font-family: 'Helvetica Neue', Arial, sans-serif;}
        .items-table th { padding: 15px 0; border-bottom: 1px solid <?= htmlspecialchars($color) ?>; color: <?= htmlspecialchars($color) ?>; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; text-align: left; font-family: 'Helvetica Neue', Arial, sans-serif; font-weight: bold; }
        .items-table td { padding: 15px 0; border-bottom: 1px solid #f0f0f0; }
        .total td { font-style: italic; font-size: 20px; color: <?= htmlspecialchars($color) ?>; border-top: 1px solid <?= htmlspecialchars($color) ?>; padding-top: 20px; }
        .notes { margin-top: 60px; font-size: 13px; color: #888; font-style: italic; text-align: center; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="header-table">
            <tr>
                <td>
                    <?php if (!empty($logo)): ?>
                        <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height: 50px; max-width: 250px;">
                    <?php else: ?>
                        <div class="title">Invoice</div>
                    <?php endif; ?>
                </td>
                <td class="text-right" style="font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 13px;">
                    <strong>No:</strong> <?= htmlspecialchars($id) ?><br>
                    <strong>Date:</strong> <?= htmlspecialchars($date) ?>
                </td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td style="width: 50%; padding-right: 20px;">
                    <div class="info-title">Billed From</div>
                    <?php foreach ($from as $line): ?>
                        <?= htmlspecialchars($line) ?><br>
                    <?php endforeach; ?>
                </td>
                <td style="width: 50%;">
                    <div class="info-title">Billed To</div>
                    <?php foreach ($to as $line): ?>
                        <?= htmlspecialchars($line) ?><br>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <tr>
                <th>Item Description</th>
                <th class="text-right">Amount</th>
            </tr>
            <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
            <tr>
                <td><?= htmlspecialchars($item['description']) ?> <span style="color:#aaa; font-style:italic;">(x<?= $item['quantity'] ?>)</span></td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td>Total Due</td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
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
