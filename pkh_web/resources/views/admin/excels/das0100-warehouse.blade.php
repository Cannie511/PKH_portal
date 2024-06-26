<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã SP</th>
            <th>Mã nhà máy</th>
            <th>Tên SP</th>
            <th>Tên SP gốc</th>
            <th>Giá</th>
            <th>Kho PKH</th>
            <th>Kho SEC</th>
            <th>Kho TIKI</th>
            <th>Kho Nhất Việt</th>
            <th>Tổng tồn</th>
            <th>Giá trị</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->stock_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->name_origin]]</td>
                <td>[[$item->selling_price]]</td>
                <td>[[$item->amount_1]]</td>
                <td>[[$item->amount_2]]</td>
                <td>[[$item->amount_3]]</td>
                <td>[[$item->amount_4]]</td>
                <td>[[$item->amount]]</td>

                <td>[[$item->selling_price * $item->amount]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>