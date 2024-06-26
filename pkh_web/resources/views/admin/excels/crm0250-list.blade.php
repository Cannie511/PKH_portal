<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Store id</th>
            <th>Group of area</th>
            <th>Province</th>
            <th>Store name</th>
            <th>Store address</th>
            <th>Store phone 1</th>
            <th>Store phone 2</th>
            <th>Salesman in charge</th>
            <th>delivery date</th>
            <th>paid date</th>
            <th>Number of days to pay</th>
            <th>Delivery value</th>
            <th>Need to pay</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <?php 
            //$endNum = $item->start_num - $item->out_num - $item->out_num_edit + $item->in_num + $item->in_num_edit;
            ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_id]]</td>
                <td>[[$item->group_area_name]]</td>
                <td>[[$item->area1]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->store_address]]</td>
                <td>[[$item->contact_tel]]</td>
                <td>[[$item->contact_mobile1]]</td>
                <td>[[$item->salesman_name]]</td>
                <td>[[$item->delivery_date]]</td>
                <td>[[$item->payment_date]]</td>
                <td>[[$item->days]]</td>
                <td>[[$item->total_with_discount]]</td>
                <td>[[$item->remain_amount]]</td>
                <td>
                    <?php if ($item->sts == '1'){
                        echo "Paid";
                    }  else {
                        echo "Not paid";   
                    }?>
                </td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

