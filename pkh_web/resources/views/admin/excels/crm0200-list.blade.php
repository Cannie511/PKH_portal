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
            <th>store_name</th>
            <th>order_date</th>
            <th>address</th>
            <th>total</th>
            <th>total_with_discount</th>
            <th>order_sts</th>
            <th>discount_1</th>
            <th>discount_2</th>
            <th>promotion_name</th>
            <th>order_type</th>
            <th>branch_name</th>
            <th>completion_percent</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data["list"] as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_order_code]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->order_date]]</td>
                <td>[[$item->address]]</td>
                <td>[[$item->total]]</td>
                <td>[[$item->total_with_discount]]</td>
                <td><?php if (isset($mapStatus[$item->order_sts])) { echo $mapStatus[$item->order_sts]; } ?></td>
                <td>[[$item->discount_1]]</td>
                <td>[[$item->discount_2]]</td>
                <td>[[$item->promotion_name]]</td>
                <td>[[$item->order_type]]</td>
                <td>[[$item->branch_name]]</td>
                <td>[[$item->completion_percent]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>