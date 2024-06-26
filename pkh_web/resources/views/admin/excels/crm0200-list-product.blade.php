<?php
    $mapStatus = [];
    foreach ($data["status"] as $status) {
        $mapStatus[$status["status_id"]] = $status["descript"];
    }
?>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>store_order_code</th>
            <th>order_date</th>
            <th>store_name</th>
            <th>product_code</th>
            <th>stock_code</th>
            <th>product_name</th>
            <th>amount</th>
            <th>unit_price</th>
            <th>order_sts</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data["list"] as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_order_code]]</td>
                <td>[[$item->order_date]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->stock_code]]</td>
                <td>[[$item->product_name]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->unit_price]]</td>
                <td><?php if (isset($mapStatus[$item->order_sts])) { echo $mapStatus[$item->order_sts]; } ?></td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>