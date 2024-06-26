<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Cửa hàng</th>
            <th>NVBH</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_order_code]]</td>
                <td>[[$item->order_date]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->salesman_name]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>