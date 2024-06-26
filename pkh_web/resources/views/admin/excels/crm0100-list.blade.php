<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Nhà cung cấp</th>
            <th>Mã PKH</th>
            <th>Tên sản phẩm</th>
            <th>Mã nhà máy</th>
            <th>MOQ</th>
            <th>Lenght</th>
            <th>Width</th>
            <th>Height</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->supplier_name]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->stock_code]]</td>
                <td>[[$item->moq]]</td>
                <td>[[$item->length]]</td>
                <td>[[$item->width]]</td>
                <td>[[$item->height]]</td>
                <td>[[$item->selling_price]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>