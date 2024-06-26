<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Mã nhà máy</th>
            <th>Đầu kỳ</th>
            <th>Nhập</th>
            <th>Xuất</th>
            <th>ĐK +</th>
            <th>ĐK -</th>
            <th>Cuối kỳ</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <?php 
            $endNum = $item->start_num - $item->out_num - $item->out_num_edit + $item->in_num + $item->in_num_edit;
            ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->stock_code]]</td>
                <td>[[$item->start_num]]</td>
                <td>[[$item->in_num]]</td>
                <td>[[$item->out_num]]</td>
                <td>[[$item->in_num_edit]]</td>
                <td>[[$item->out_num_edit]]</td>
                <td>[[$endNum]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>