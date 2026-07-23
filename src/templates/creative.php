<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($id) ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #5a5a5a; font-size: 14px; line-height: 1.6; background: #fffaf0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 40px; background: #ffffff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: separate; border-spacing: 0; }
        td { padding: 12px; vertical-align: top; }
        .text-right { text-align: right; }
        .header { margin-bottom: 50px; }
        .title { font-size: 38px; font-weight: 300; color: #ff9a9e; letter-spacing: 2px; }
        .pill { background: #fdfbfb; padding: 15px 25px; border-radius: 15px; border: 1px solid #f0e6e6; }
        .info-title { font-weight: bold; color: #ff9a9e; margin-bottom: 10px; font-size: 16px;}
        .items-table th { background: #ff9a9e; color: #fff; padding: 15px; text-align: left; font-weight: normal; }
        .items-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .items-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
        .items-table td { padding: 15px; border-bottom: 1px dashed #f0e6e6; }
        .total-row td { font-size: 20px; font-weight: bold; color: #ff9a9e; padding-top: 30px; border-bottom: none; }
        .notes { margin-top: 50px; padding: 25px; background: #fdfbfb; border-radius: 15px; color: #888; font-style: italic; text-align: center; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="header">
            <tr>
                <td>
                    <?php if (!empty($logo)): ?>
                        <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height: 70px; max-width: 250px;">
                    <?php else: ?>
                        <div class="title">INVOICE</div>
                    <?php endif; ?>
                </td>
                <td class="text-right">
                    <div class="pill" style="display: inline-block; text-align: left;">
                        <strong>No.</strong> <?= htmlspecialchars($id) ?><br>
                        <strong>Date</strong> <?= htmlspecialchars($date) ?>
                    </div>
                </td>
            </tr>
        </table>
        
        <table style="margin-bottom: 40px;">
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
            <tr>
                <th>Service / Item</th>
                <th class="text-right">Amount</th>
            </tr>
            <?php $subtotal = 0; foreach ($items as $item): $subtotal += $item['total']; ?>
            <tr>
                <td><?= htmlspecialchars($item['description']) ?> <span style="color:#ccc;">(x<?= $item['quantity'] ?>)</span></td>
                <td class="text-right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td class="text-right">Total</td>
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
