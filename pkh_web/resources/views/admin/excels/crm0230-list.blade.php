<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Tỉnh/TP</th>
            <th>Quận/Huyện</th>
            <th>Cửa hàng</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phầm</th>
            <th>Số lượng</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->area1]]</td>
                <td>[[$item->area2]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->product_name]]</td>
                <td>[[$item->amount]]</td>

                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>