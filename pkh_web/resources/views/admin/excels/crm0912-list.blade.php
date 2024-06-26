<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Ngày</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Số lượng nhập</th>
            <th>Còn lại</th>
            <th>Đơn giá</th>
            <th>Số ngày tồn kho</th>
            <th>Giá trị</th>
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
                <td>[[$item->in_date]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->remain]]</td>
                <td>[[$item->selling_price]]</td>
                <td>[[$item->spent]]</td>
                <td>[[$item->selling_price]]</td>
                
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>