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
            <th>store_delivery_code</th>
            <th>delivery_date</th>
            <th>store_name</th> 
            <th>address</th>
            <th>total</th>
            <th>total_with_discount</th>
            <th>delivery_sts</th>
            <th>discount_1</th>
            <th>discount_2</th>
            <th>promotion_name</th>
            <th>order_type</th>
            <th>branch_name</th>
            <th>salesman_name</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data["list"] as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_order_code]]</td>
                <td>[[$item->order_date]]</td>
                <td>[[$item->store_delivery_code]]</td>
                <td>[[$item->delivery_date]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->address]]</td>
                
                <td>[[$item->total]]</td>
                <td>[[$item->total_with_discount]]</td>
                <td><?php if (isset($mapStatus[$item->delivery_sts])) { echo $mapStatus[$item->delivery_sts]; } ?></td>
                <td>[[$item->discount_1]]</td>
                <td>[[$item->discount_2]]</td>

                <td>[[$item->promotion_name]]</td>
                <td>[[$item->order_type]]</td>
                <td>[[$item->branch_name]]</td>
                <td>[[$item->salesman_name]]</td>

                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>