<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>PI NO</th>
            <th>Ngày nhập</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Giá nhập VND</th>
            <th>Chi phí SP VND</th>
            <th>Giá vốn</th>
            <th>Số lượng nhập</th>
            <th>Còn lại</th>
            <th>Giá trị Còn lại</th>
            <th>Số ngày</th>
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
                <td>[[$item->pi_no]]</td>
                <td>[[$item->delivery_date]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->price]]</td>
                <td>[[$item->cost_per_1pro]]</td>
                <td>[[$item->price+$item->cost_per_1pro]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->remain]]</td>
                <td>[[$item->remain*($item->price+$item->cost_per_1pro)]]</td>
                <td>[[$item->max_days]]</td>
                
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
