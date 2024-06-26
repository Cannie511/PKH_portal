<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Cửa hàng</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phầm</th>
            <th>Giá</th>
            <th>SL Đặt</th>
            <th>SL Giao</th>
            <th>Còn lại</th>
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
                <td>[[$item->product_code]]</td>
                <td>[[$item->product_name]]</td>
                <td>[[$item->unit_price]]</td>
                <td>[[$item->order_amount]]</td>
                <td>[[$item->delivery_amount]]</td>
                <td>[[$item->order_amount - $item->delivery_amount ]]</td>
                <td>[[$item->salesman_name]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>