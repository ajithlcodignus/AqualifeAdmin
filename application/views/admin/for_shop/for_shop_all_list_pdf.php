<html>

<head>
    <style>
        @font-face {

            font-family: malayalam;
            font-style: normal;
            font-weight: normal;
            src: url('../../../../assets/fonts/NCL_RAHU_B_WIN_NEW_COPY.TTF');
        }

        table {
            border-collapse: collapse;
            font-family: malayalam;
        }

        th {
            border: 1px solid #000;
        }

        td {
            border: 1px solid #000;
        }

        .item_list_td1 {
            width: 20%;
        }

        .item_list_td2 {
            width: 40%;
            font-family: 'malayalam';
        }

        .item_list_td3 {
            width: 20%;
        }

        .item_list_td4 {
            width: 20%;
        }
    </style>
</head>

<body>
    <div>
        <table style="width: 100%;">
            <tr>
                <th class="item_list_td1">SL NO</th>
                <th class="item_list_td1">ITEM CODE</th>
                <th class="item_list_td2">NAME</th>
                <th class="item_list_td3">MRP</th>
                <th class="item_list_td4">OFFER PRICE</th>
            </tr>
            <?php
            $i = 1;
            foreach ($item as $value) {
            ?>
                <tr>
                    <td class="item_list_td1"><?= $i; ?></td>
                    <td lass="item_list_td2"><?= $value->quickItemId; ?></td>
                    <td lass="item_list_td2"><?= $value->quickName; ?></td>
                    <td lass="item_list_td3"><?= $value->quickPrice; ?></td>
                    <td lass="item_list_td4"><?= $value->quickOfferPrice; ?></td>
                </tr>
            <?php $i++;
            }
            ?>
        </table>
    </div>
</body>

</html>