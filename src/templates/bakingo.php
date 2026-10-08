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
            font-family: 'DejaVu Sans', sans-serif; /* DejaVu Sans supports Rupee symbol ₹ */
            font-size: 11px;
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
            font-size: 28px;
            font-weight: normal;
            margin: 0 0 20px 0;
            letter-spacing: 0.5px;
        }
        .meta-table {
            width: 100%;
            font-size: 10px;
            line-height: 1.8;
            color: #555;
        }
        .meta-table td.label {
            width: 90px;
            color: #666;
        }
        .meta-table td.value {
            font-weight: bold;
            color: #222;
        }
        .logo {
            max-width: 160px;
            max-height: 60px;
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
            margin-left: -15px; 
            width: calc(100% + 30px);
        }
        .box {
            background-color: #f3f0fc;
            border-radius: 6px;
            padding: 12px;
            vertical-align: top;
            width: 50%;
        }
        .box-title {
            color: #5a3ba8;
            font-size: 14px;
            margin: 0 0 6px 0;
            font-weight: normal;
        }
        .box-content {
            font-size: 10px;
            line-height: 1.6;
            color: #222;
        }
        .box-content strong {
            font-size: 11px;
            font-weight: bold;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 9px;
        }
        .items-table th {
            background-color: #6343ac;
            color: white;
            padding: 8px 6px;
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
            padding: 8px 6px;
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
            font-size: 10px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 5px 0;
            text-align: right;
            color: #333;
        }
        .summary-table td:first-child {
            text-align: left;
            color: #555;
        }
        .summary-table tr.total-row td {
            font-weight: bold;
            font-size: 12px;
            border-top: 2px solid #222;
            border-bottom: 2px solid #222;
            padding: 8px 0;
            color: #000;
        }

        .terms {
            clear: both;
            padding-top: 30px;
            font-size: 10px;
        }
        .terms-title {
            color: #5a3ba8;
            font-size: 12px;
            margin-bottom: 6px;
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
            font-size: 8px;
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
    <?php
        if (!function_exists('fmtActual')) {
            function fmtActual($val) {
                if (!is_numeric($val)) return $val;
                $val = (float) $val;
                if (floor($val) == $val) {
                    return number_format($val, 2);
                }
                
                $parts = explode('.', (string) $val);
                $intPart = number_format((float) $parts[0]);
                $decPart = isset($parts[1]) ? $parts[1] : '';
                
                if (strlen($decPart) == 1) {
                    $decPart .= '0';
                }
                
                return $intPart . '.' . $decPart;
            }
        }
    ?>
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 25%;">
                    Quotation No
                    <span class="footer-val"><?= htmlspecialchars($id) ?></span>
                </td>
                <td style="width: 25%;">
                    Quotation Date
                    <span class="footer-val"><?= htmlspecialchars($date) ?></span>
                </td>
                <td style="width: 25%;">
                    Quotation For
                    <span class="footer-val"><?= !empty($to) ? htmlspecialchars($to[0]) : '' ?></span>
                </td>
                <td style="width: 25%;" class="footer-right">
                    <script type="text/php">
                        if (isset($pdf)) {
                            $font = $fontMetrics->get_font("DejaVu Sans", "normal");
                            $pdf->page_text($pdf->get_width() - 80, $pdf->get_height() - 40, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 9, array(0.1,0.1,0.1));
                        }
                    </script>
                </td>
            </tr>
        </table>
        <div style="text-align: center; margin-top: 10px; font-size: 8px; color: #111;">
            This is an electronically generated document, no signature is required.
        </div>
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
                    <?php if (!empty($meta)): ?>
                        <?php foreach ($meta as $key => $value): ?>
                        <tr>
                            <td class="label"><?= htmlspecialchars($key) ?></td>
                            <td class="value"><?= htmlspecialchars($value) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                            <strong><?= htmlspecialchars($from[0]) ?></strong><br>
                            <?php for($i = 1; $i < count($from); $i++): ?>
                                <?php 
                                    $line = htmlspecialchars($from[$i]);
                                    // Bold any "Label: " pattern
                                    echo preg_replace('/([A-Za-z]+):\s/', '<strong>$1:</strong> ', $line);
                                ?><br>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </td>
                <td style="width: 15px; padding: 0; background: transparent;"></td>
                <td class="box" style="margin-left: 7.5px;">
                    <h3 class="box-title">Quotation For</h3>
                    <div class="box-content">
                        <?php if(!empty($to)): ?>
                            <strong><?= htmlspecialchars($to[0]) ?></strong><br>
                            <?php for($i = 1; $i < count($to); $i++): ?>
                                <?php 
                                    $line = htmlspecialchars($to[$i]);
                                    echo preg_replace('/([A-Za-z]+):\s/', '<strong>$1:</strong> ', $line);
                                ?><br>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <?php if (!empty($country_of_supply) || !empty($place_of_supply)): ?>
    <table style="width: 100%; margin-bottom: 15px; font-size: 11px; font-weight: bold;">
        <tr>
            <td style="text-align: center; width: 50%;">
                <?php if (!empty($country_of_supply)): ?>
                    Country of Supply: <span style="font-weight: normal;"><?= htmlspecialchars($country_of_supply) ?></span>
                <?php endif; ?>
            </td>
            <td style="text-align: center; width: 50%;">
                <?php if (!empty($place_of_supply)): ?>
                    Place of Supply: <span style="font-weight: normal;"><?= htmlspecialchars($place_of_supply) ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php endif; ?>

    <table class="items-table">
        <thead>
            <tr>
                <th class="left">Item</th>
                <th>GST Rate</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <?php if (($gst_type ?? 'intra_state') === 'inter_state'): ?>
                    <th>IGST</th>
                <?php else: ?>
                    <th>CGST</th>
                    <th>SGST</th>
                <?php endif; ?>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $totalAmount = 0;
                $totalCGST = 0;
                $totalSGST = 0;
                $totalIGST = 0;
                $totalFinal = 0;
                $counter = 1;
                foreach ($items as $item): 
                    $amt = $item['amount'] ?? ($item['price'] * $item['quantity']);
                    $gst = $item['gstRate'] ?? 0;
                    $cgst = $item['cgst'] ?? ($amt * ($gst / 200));
                    $sgst = $item['sgst'] ?? ($amt * ($gst / 200));
                    $igst = $item['igst'] ?? ($amt * ($gst / 100));
                    $tot = $item['total'] ?? ($amt + $cgst + $sgst);
                    
                    $totalAmount += $amt;
                    $totalCGST += $cgst;
                    $totalSGST += $sgst;
                    $totalIGST += $igst;
                    $totalFinal += $tot;
            ?>
            <tr>
                <td class="left">
                    <?php if (!empty($item['is_sub_item'])): ?>
                        &nbsp;&nbsp;&nbsp; &#8627; &nbsp; <?= htmlspecialchars($item['description']) ?>
                    <?php else: ?>
                        <?= $counter ?>. <?= htmlspecialchars($item['description']) ?>
                        <?php $counter++; ?>
                    <?php endif; ?>
                    <?php if (!empty($item['specs'])): ?>
                        <div style="font-size: 8.5px; color: #555; margin-top: 3px; margin-left: <?= !empty($item['is_sub_item']) ? '24px' : '12px' ?>;"><?= nl2br(htmlspecialchars($item['specs'])) ?></div>
                    <?php endif; ?>
                </td>
                <td><?= $gst ?>%</td>
                <td><?= $item['quantity'] ?></td>
                <td>
                    <?php if (!empty($item['originalPrice']) && $item['originalPrice'] > $item['price']): ?>
                        <span style="text-decoration: line-through; color: #999; margin-right: 4px;"><?= htmlspecialchars($currency) ?><?= fmtActual($item['originalPrice']) ?></span>
                    <?php endif; ?>
                    <?= htmlspecialchars($currency) ?><?= fmtActual($item['price']) ?>
                </td>
                <td><?= htmlspecialchars($currency) ?><?= fmtActual($amt) ?></td>
                <?php if (($gst_type ?? 'intra_state') === 'inter_state'): ?>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($igst) ?></td>
                <?php else: ?>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($cgst) ?></td>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($sgst) ?></td>
                <?php endif; ?>
                <td class="right"><?= htmlspecialchars($currency) ?><?= fmtActual($tot) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary-wrapper">
        <table class="summary-table">
            <tr>
                <td>Amount</td>
                <td><?= htmlspecialchars($currency) ?><?= fmtActual($totalAmount) ?></td>
            </tr>
            <?php if (($gst_type ?? 'intra_state') === 'inter_state'): ?>
                <?php if($totalIGST > 0): ?>
                <tr>
                    <td>IGST</td>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($totalIGST) ?></td>
                </tr>
                <?php endif; ?>
            <?php else: ?>
                <?php if($totalCGST > 0): ?>
                <tr>
                    <td>CGST</td>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($totalCGST) ?></td>
                </tr>
                <?php endif; ?>
                <?php if($totalSGST > 0): ?>
                <tr>
                    <td>SGST</td>
                    <td><?= htmlspecialchars($currency) ?><?= fmtActual($totalSGST) ?></td>
                </tr>
                <?php endif; ?>
            <?php endif; ?>
            <tr class="total-row">
                <td>Total</td>
                <td><?= htmlspecialchars($currency) ?><?= fmtActual($totalFinal) ?></td>
            </tr>
        </table>
    </div>

    <?php if (!empty($notes)): ?>
    <div class="terms">
        <h4 class="terms-title">Terms and Conditions</h4>
        <p><?= nl2br($notes) ?></p>
    </div>
    <?php endif; ?>

</body>
</html>
