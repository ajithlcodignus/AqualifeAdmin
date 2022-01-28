<div class="card">
    <div class="card-body" >
        <div class="row">
            <table style="width: 100%;border: 1px solid;border-collapse: collapse;">
                <tr>
                    <th colspan="7"  style="border: 1px solid;text-align: center;">ORDER SUMMERY</th>
                </tr>
                <tr>
                    <th style="border: 1px solid;text-align: center;">Sl No</th>
                    <th style="border: 1px solid;text-align: center;">Date</th>
                    <th style="border: 1px solid;">Shop</th>
                    <th style="border: 1px solid;text-align: right;">Total</th>
                    <th style="border: 1px solid;text-align: right;">Payment Amount</th>
                    <th style="border: 1px solid;text-align: center;">Order Status</th>
                    <th style="border: 1px solid;text-align: right;">Delivery Fee</th>
                </tr>
                <?php
                if (count($result)) {
                    $i = 1;
                    foreach ($result as $val) {
                        ?>
                        <tr>
                            <td style="border: 1px solid;text-align: center;"><?= $i; ?></td>
                            <td style="border: 1px solid;text-align: center;"><?= date('d-m-Y', strtotime($val->orderDate)); ?></td>
                            <td style="border: 1px solid;"><?= $val->shopName; ?></td>
                            <td style="border: 1px solid;text-align: right;"><?= number_format($val->totalAmount, 2) ?></td>
                            <td style="border: 1px solid;text-align: right;"><?= number_format($val->paymentAmount, 2) ?></td>
                            <td style="border: 1px solid;text-align: center;"><?= $val->orderStatus; ?></td>
                            <td style="border: 1px solid;text-align: right;"><?= number_format($val->deliveryFee, 2) ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" style="border: 1px solid;">No records</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>