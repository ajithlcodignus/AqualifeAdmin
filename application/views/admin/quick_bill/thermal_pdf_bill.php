<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orders</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @page {
            margin: 2px;
        }

        body {
            margin: 2px;
            font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; 
        }

        table {
            border-collapse: collapse;
        }

        .bill_title {
            font-size: 10px;

        }

        .bill_title th {
            width: 90px;
            text-align: left;
            padding: 5px 10px;
        }

        .bill_title td {
            width: 400px;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;

        }

        .bill_customer {
            font-size: 10px;
            font-weight: bold;

        }

        .bill_customer th {
            width: 90px;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;
        }

        .bill_customer td {
            width: 400px;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;
            font-weight: normal;
        }

        .item_table {
            font-size: 9px;
        }

        .item_table th {
            font-size: 10px;
        }

        .item_table_td1 {
            width: 5%;
        }

        .item_table_td2 {
            width: 24%;
        }

        .item_table_td3 {
            width: 5%;
        }

        .item_table_td4 {
            width: 5%;
            padding: 5px;
        }

        .item_table_td5 {
            width: 5%;
            padding: 5px;
        }

        .item_table_td6 {
            width: 10%;
            padding: 5px;
        }

        .item_table_td7 {
            width: 20%;
            padding: 5px;
        }



        /* @page {
            margin: 0px;
        }

        body {
            margin: 0px;
        } */
    </style>
</head>

<body>

    <div style="text-align:center">






        <?php if (!empty($quick_output['current_order_details'])) {
        ?>
            <center>
                <table style="width:100%">
                    <tr style="text-align: center;width:100% ">

                        <th style="text-align: center;width:100%;font-size:18px; font-size:13px;">
                        FoodvenoGrocery
                        </th>

                    </tr>
                    <tr style="text-align: center;width:100% ">

                        <td style="text-align: center;width:100%; font-size:13px;">
                            Invoice No : <?= 'QS-' . $orderId ?>
                        </td>

                    </tr>
                    <tr style="text-align: center;width:100% ">

                        <td style="text-align: center;width:100%; font-size:13px;">
                            Date : <?= date('d-M-Y') ?>
                        </td>

                    </tr>

                    <tr style="text-align: center;width:100%">

                        <td style="text-align: center;width:100%; font-size:13px;">
                            support@quickershoppy.com
                        </td>


                    </tr>
                    <tr style="text-align: center;width:100%">


                        <td style="text-align: center; width:100%;padding-bottom:20px;  font-size:13px;">
                            8113813659, 7736151724<br> 0495-2966624
                        </td>


                    </tr>
                </table>
                <table class="bill_title">
                    <tr>
                        <th>

                            <span>Payment Amount</span>
                        </th>
                        <td>
                            <span><?php echo number_format($quick_output['current_order_details']["paymentAmount"], 2) . '/-'; ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span>Payment Mode</span>
                        </th>
                        <td>
                            <span><?php echo $quick_output['current_order_details']["paymentMode"]; ?></span>

                        </td>
                    </tr>
                </table>
            </center>
            <center>
                <table class="bill_customer">
                    <tr>
                        <th>

                            <span>Shop Name </span>
                        </th>
                        <td>
                            <span><?php echo $quick_output['current_order_details']["shopName"]; ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span>Customer Name </span>
                        </th>
                        <td>
                            <span><?php echo $quick_output['current_order_details']["userName"] ?></span>

                        </td>

                    </tr>
                    <tr>
                        <th>

                            <span>Customer Phone </span>
                        </th>
                        <td>
                            <span><?= $quick_output['current_order_details']["userMobile"]  ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span> Order Date&Time </span>
                        </th>
                        <td>
                            <span><?php echo $quick_output['current_order_details']["orderEntryDate"] ?></span>

                        </td>
                    </tr>

                    <tr>
                        <th>

                            <span>Address</span>
                        </th>
                        <td>
                            <span> <?php echo $quick_output['current_order_details']["userAddress"] ?></span>

                        </td>
                    </tr>
                </table>
            </center>

            <center>
                <h3>Item Details</h3>
                <?php if (!empty($quick_output['current_order_details']["itemsList"])) {
                ?>

                    <table style="width: 100%" class="item_table">

                        <tr>
                            <th class="item_table_td1" style="text-align: left">SI</th>
                            <th class="item_table_td2" style="text-align: left">Item</th>

                            <th class="item_table_td5" style="text-align: right">Qty</th>
                            <th class="item_table_td6" style="text-align: right">Rate</th>
                            <th class="item_table_td7" style="text-align: right">Amt</th>

                        </tr>



                        <?php

                        // print_r($current_order_details["itemsList"]);
                        $total_item_amount = 0;
                        $total_items = 0;
                        $i = 1;

                        foreach ($quick_output['current_order_details']["itemsList"] as $row) {
                        ?>
                            <tr>
                                <td class="item_table_td1"><?php echo $i; ?></td>
                                <td class="item_table_td2"><?php echo $row->thermalPrinterItems; ?></td>

                                <td class="item_table_td5" style="text-align: right"><?php echo $row->quickQuantity; ?></td>
                                <td class="item_table_td6" style="text-align: right"><?php echo number_format($row->quickAmount, 2);  ?></td>
                                <td class="item_table_td7" style="text-align: right"><?php echo number_format($row->quickQuantity * $row->quickAmount, 2); ?></td>
                            </tr>
                        <?php

                            $total_item_amount = $total_item_amount + ($row->quickQuantity * $row->quickAmount);
                            $total_items += $row->quickQuantity;
                            $i++;
                        }
                        ?>
                        <tr>
                            <td class="item_table_td1"></td>
                            <th class="item_table_td2" style="text-align: left"> Delivery Fee</th>

                            <td class="item_table_td5"></td>
                            <td class="item_table_td6"></td>
                            <th class="item_table_td7" style="text-align: right"><?= number_format($quick_output['current_order_details']["deliveryFee"], 2) ?></th>
                        <tr>
                            <td class="item_table_td1"></td>
                            <th class="item_table_td2" style="text-align: left">GST</th>

                            <td class="item_table_td5"></td>
                            <td class="item_table_td6"></td>
                            <th class="item_table_td7" style="text-align: right"><?= number_format($quick_output['current_order_details']["gst"], 2) ?></th>

                        </tr>
                        </tr>
                        <tr>
                            <td class="item_table_td1"></td>
                            <th class="item_table_td2" style="text-align: left">Grand Total</th>

                            <td class="item_table_td5" style="text-align: right"><?= $total_items ?></td>
                            <td class="item_table_td6"></td>
                            <th class="item_table_td7" style="text-align: right"><?= number_format(($total_item_amount + $quick_output['current_order_details']["deliveryFee"] + $quick_output['current_order_details']["gst"]), 2) ?></th>
                        </tr>


                    </table>

                <?php
                } else
                    echo "No Items"; ?>

    </div>
    </center>

<?php } ?>


</body>

</html>