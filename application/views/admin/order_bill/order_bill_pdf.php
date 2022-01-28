<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orders</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table {
            border-collapse: collapse;
        }

        .bill_title {
            font-size: 14px;

        }

        .bill_title th {
            width: 250px;
            border: 1px solid #000;
            text-align: left;
            padding: 5px 10px;
        }

        .bill_title td {
            width: 400px;
            border: 1px solid #000;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;

        }

        .bill_customer {
            font-size: 14px;
            font-weight: bold;

        }

        .bill_customer th {
            width: 250px;
            border: 1px solid #000;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;
        }

        .bill_customer td {
            width: 400px;
            border: 1px solid #000;
            text-align: left;
            padding-left: 10px;
            padding: 5px 10px;
            font-weight: normal;
        }

        .item_table_td1 {
            width: 10%;
            padding: 5px;

        }

        .item_table_td2 {
            width: 30%;
            padding: 5px;
        }

        .item_table_td3 {
            width: 5%;
            padding: 5px;
        }

        .item_table_td4 {
            width: 10%;
            padding: 5px;
        }

        .item_table_td5 {
            width: 10%;
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

        .item_table_top_border {
            border-top: 1px solid #000;
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

    <div style="border: 1px solid #000; text-align:center">






        <?php if (!empty($output['current_order_details'])) {
        ?>
            <center>
                <table style="width:100%">
                    <tr style="text-align: center;width:100%">
                        <td style="text-align: left; width:40%;padding-left :10px;padding-top:5px">
                            Invoice No : <?=  '#'.$output['current_order_details']["orderHashId"] ?>
                        </td>
                        <th style="text-align: center;  width:20%">
                            <?= TAG_APP_NAME ?>
                        </th>
                        <td style="text-align: right; width:40%;padding :5px 10px 0 0">
                            Date : <?= date('d-M-Y') ?>
                        </td>
                    </tr>
                    <tr style="text-align: center;width:100%">
                        <td></td>
                        <td style="text-align: center;width:100%;text-transform: lowercase;">
                            support@<?= TAG_APP_NAME ?>.in
                        </td>
                        <td></td>

                    </tr>
                    <tr style="text-align: center;width:100%">
                        <td></td>

                        <td style="text-align: center; width:100%;padding-bottom:20px">
                            918590284873
                        </td>
                        <td></td>

                    </tr>
                </table>
                <table class="bill_title">
                    <tr>
                        <th>

                            <span>Payment Amount</span>
                        </th>
                        <td>
                            <span><?php echo number_format($output['current_order_details']["paymentAmount"], 2) . '/-'; ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span>Payment Mode</span>
                        </th>
                        <td>
                            <span><?php echo $output['current_order_details']["paymentMode"]; ?></span>

                        </td>
                    </tr>
                </table>
            </center>
            <center>
                <table class="bill_customer">
                    <tr>
                        <th>

                            <span>Shop Name</span>
                        </th>
                        <td>
                            <span><?php echo $output['current_order_details']["shopName"]; ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span>Customer Name</span>
                        </th>
                        <td>
                            <span><?php echo $output['current_order_details']["userName"] ?></span>

                        </td>

                    </tr>
                    <tr>
                        <th>

                            <span>Customer Phone</span>
                        </th>
                        <td>
                            <span><?= $output['current_order_details']["userMobile"]  ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>

                            <span> Order Date And Time</span>
                        </th>
                        <td>
                            <span><?php echo date("d-M-Y , H:i A", strtotime($output['current_order_details']["entryDate"])) ?></span>

                        </td>
                    </tr>

                    <tr>
                        <th>

                            <span>Address</span>
                        </th>
                        <td>
                            <span> <?php echo $output['current_order_details']["houseName"] . ", " . $output['current_order_details']["fullAddress"] ?>
                                <br>
                                <?php if (!empty($output['current_order_details']["landmark"])) {
                                    echo $output['current_order_details']["landmark"] . ", ";
                                }
                                echo $output['current_order_details']["pinCode"] ?></span>

                        </td>
                    </tr>
                </table>
            </center>

            <center>



                <h3>Item Details</h3>



                <?php if (!empty($output['current_order_details']["itemsList"])) {
                ?>

                    <table style="width: 100%;" class="item_table">

                        <tr>
                            <th class="item_table_top_border item_table_td1" style="text-align: left;border-right:1px solid #000;border-bottom:1px solid #000">SL NO</th>
                            <th class="item_table_top_border item_table_td2" style="text-align: left;border-right:1px solid #000;border-bottom:1px solid #000">Item Name</th>

                            <th class="item_table_top_border item_table_td5" style="text-align: right;border-right:1px solid #000;border-bottom:1px solid #000">Qty</th>
                            <th class="item_table_top_border item_table_td6" style="text-align: right;border-right:1px solid #000;border-bottom:1px solid #000">Rate</th>
                            <th class="item_table_top_border item_table_td7" style="text-align: right;border-bottom:1px solid #000">Total Rate</th>

                        </tr>



                        <?php

                        // print_r($current_order_details["itemsList"]);
                        $total_item_amount = 0;
                        $total_items = 0;
                        $i = 1;

                        foreach ($output['current_order_details']["itemsList"] as $row) {
                        ?>
                            <tr>
                                <td class="item_table_td1" style="border-right:1px solid #000"><?php echo $i; ?></td>
                                <td class="item_table_td2" style="border-right:1px solid #000"><?php echo $row->itemName; ?></td>

                                <td class="item_table_td5" style="text-align: right;border-right:1px solid #000"><?php echo $row->quantity; ?></td>
                                <td class="item_table_td6" style="text-align: right;border-right:1px solid #000"><?php echo number_format($row->offerPrice, 2);  ?></td>
                                <td class="item_table_td7" style="text-align: right;"><?php echo number_format($row->quantity * $row->offerPrice, 2); ?></td>
                            </tr>
                        <?php

                            $total_item_amount = $total_item_amount + ($row->quantity * $row->offerPrice);
                            $total_items += $row->quantity;
                            $i++;
                        }
                        ?>
                        <tr>
                            <td class="item_table_top_border item_table_td1"></td>
                            <th class="item_table_top_border item_table_td2" style="text-align: left"> Delivery Fee</th>

                            <td class="item_table_top_border item_table_td5"></td>
                            <td class="item_table_top_border item_table_td6"></td>
                            <th class="item_table_top_border item_table_td7" style="text-align: right;border-top:1px solid #000"><?= number_format($output['current_order_details']["deliveryFee"], 2) ?></th>
                        <tr>
                            <td class="item_table_top_border item_table_td1"></td>
                            <th class="item_table_top_border item_table_td2" style="text-align: left">GST</th>

                            <td class="item_table_top_border item_table_td5"></td>
                            <td class="item_table_top_border item_table_td6"></td>
                            <th class="item_table_top_border item_table_td7" style="text-align: right"><?= number_format($output['current_order_details']["gst"], 2) ?></th>

                        </tr>
                        </tr>
                        <tr style="border-top: 1px solid #000;">
                            <td class="item_table_top_border item_table_td1"></td>
                            <th class="item_table_top_border item_table_td2" style="text-align: left">Grand Total</th>

                            <td class="item_table_top_border item_table_td5" style="text-align: right"><?= $total_items ?></td>
                            <td class="item_table_top_border item_table_td6"></td>
                            <th class="item_table_top_border item_table_td7" style="text-align: right"><?= number_format(($total_item_amount + $output['current_order_details']["deliveryFee"] + $output['current_order_details']["gst"]), 2) ?></th>
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