<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Quotation') ?> <?= htmlspecialchars($id) ?></title>
    <style>
        @page {
            margin: 40px 40px 80px 40px; /* Leave space for footer */
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .header-table td {
            vertical-align: top;
        }
        .title {
            color: #5a3ba8;
            font-size: 32px;
            font-weight: normal;
            margin: 0 0 20px 0;
            letter-spacing: 0.5px;
        }
        .meta-table {
            width: 100%;
            font-size: 11px;
            line-height: 1.8;
            color: #555;
        }
        .meta-table td.label {
            width: 110px;
            color: #666;
        }
        .meta-table td.value {
            font-weight: bold;
            color: #222;
        }
        .logo {
            max-width: 200px;
            max-height: 80px;
            float: right;
        }
        
        .boxes-wrapper {
            width: 100%;
            margin-bottom: 20px;
        }
        .boxes-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 15px 0;
            margin-left: -15px; /* Offset spacing */
            width: calc(100% + 30px);
        }
        .box {
            background-color: #f3f0fc;
            border-radius: 6px;
            padding: 15px;
            vertical-align: top;
            width: 50%;
        }
        .box-title {
            color: #5a3ba8;
            font-size: 16px;
            margin: 0 0 8px 0;
            font-weight: normal;
        }
        .box-content {
            font-size: 11px;
            line-height: 1.6;
            color: #222;
        }
        .box-content strong {
            display: block;
            margin-bottom: 3px;
            font-size: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .items-table th {
            background-color: #6343ac;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: normal;
        }
        .items-table th.left {
            text-align: left;
        }
        .items-table th.right {
            text-align: right;
        }
        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eaeaea;
            text-align: center;
            color: #333;
        }
        .items-table td.left {
            text-align: left;
        }
        .items-table td.right {
            text-align: right;
        }
        
        .summary-wrapper {
            float: right;
            width: 250px;
            margin-top: 10px;
        }
        .summary-table {
            width: 100%;
            font-size: 11px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 6px 0;
            text-align: right;
            color: #333;
        }
        .summary-table td:first-child {
            text-align: left;
            color: #555;
        }
        .summary-table tr.total-row td {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #222;
            border-bottom: 2px solid #222;
            padding: 10px 0;
            color: #000;
        }

        .terms {
            clear: both;
            padding-top: 50px;
            font-size: 11px;
        }
        .terms-title {
            color: #5a3ba8;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: normal;
        }
        .terms p {
            color: #444;
            line-height: 1.5;
            margin: 0;
        }

        .footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 40px;
            font-size: 9px;
            color: #666;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            vertical-align: top;
        }
        .footer-center {
            text-align: center;
            color: #888;
        }
        .footer-right {
            text-align: right;
        }
        .footer-val {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 2px;
        }
    </style>
</head>
<body>
    
    <!-- Footer repeated on every page via fixed positioning -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 20%;">
                    Quotation No
                    <span class="footer-val"><?= htmlspecialchars($id) ?></span>
                </td>
                <td style="width: 20%;">
                    Quotation Date
                    <span class="footer-val"><?= htmlspecialchars($date) ?></span>
                </td>
                <td style="width: 40%;" class="footer-center">
                    This is an electronically generated document, no signature is required.
                </td>
                <td style="width: 20%;" class="footer-right">
                    <script type="text/php">
                        if (isset($pdf)) {
                            $font = $fontMetrics->get_font("Helvetica", "normal");
                            $pdf->page_text($pdf->get_width() - 80, $pdf->get_height() - 40, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0.4,0.4,0.4));
                        }
                    </script>
                </td>
            </tr>
        </table>
    </div>

    <table class="header-table">
        <tr>
            <td style="width: 50%;">
                <h1 class="title"><?= htmlspecialchars(ucfirst(strtolower($title ?? 'Quotation'))) ?></h1>
                
                <table class="meta-table">
                    <tr>
                        <td class="label">Quotation No #</td>
                        <td class="value"><?= htmlspecialchars($id) ?></td>
                    </tr>
                    <tr>
                        <td class="label">Quotation Date</td>
                        <td class="value"><?= htmlspecialchars($date) ?></td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%; text-align: right;">
                <?php if (!empty($logo)): ?>
                    <img src="<?= htmlspecialchars($logo) ?>" class="logo" alt="Logo">
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <div class="boxes-wrapper">
        <table class="boxes-table">
            <tr>
                <td class="box" style="margin-right: 7.5px;">
                    <h3 class="box-title">Quotation From</h3>
                    <div class="box-content">
                        <?php if(!empty($from)): ?>
                            <strong><?= htmlspecialchars($from[0]) ?></strong>
                            <?php for($i = 1; $i < count($from); $i++): ?>
                                <?= htmlspecialchars($from[$i]) ?><br>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </td>
                <td style="width: 15px; padding: 0; background: transparent;"></td>
                <td class="box" style="margin-left: 7.5px;">
                    <h3 class="box-title">Quotation For</h3>
                    <div class="box-content">
                        <?php if(!empty($to)): ?>
                            <strong><?= htmlspecialchars($to[0]) ?></strong>
                            <?php for($i = 1; $i < count($to); $i++): ?>
                                <?= htmlspecialchars($to[$i]) ?><br>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th class="left">Item</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $subtotal = 0; 
                $counter = 1;
                foreach ($items as $item): 
                    $subtotal += $item['total']; 
            ?>
            <tr>
                <td class="left">
                    <?= $counter ?>. <?= htmlspecialchars($item['description']) ?>
                </td>
                <td><?= $item['quantity'] ?></td>
                <td><?= htmlspecialchars($currency) ?><?= number_format($item['price'], 2) ?></td>
                <td class="right"><?= htmlspecialchars($currency) ?><?= number_format($item['total'], 2) ?></td>
            </tr>
            <?php $counter++; endforeach; ?>
        </tbody>
    </table>

    <div class="summary-wrapper">
        <table class="summary-table">
            <tr>
                <td>Amount</td>
                <td><?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
            </tr>
            <!-- Currently no individual tax lines available in base fluent-invoice-php items array -->
            <!-- If tax lines become available, they can be inserted here -->
            <tr class="total-row">
                <td>Total</td>
                <td><?= htmlspecialchars($currency) ?><?= number_format($subtotal, 2) ?></td>
            </tr>
        </table>
    </div>

    <?php if (!empty($notes)): ?>
    <div class="terms">
        <h4 class="terms-title">Terms and Conditions</h4>
        <p><?= nl2br(htmlspecialchars($notes)) ?></p>
    </div>
    <?php endif; ?>

</body>
</html>
