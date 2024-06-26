<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th> 
            <th>Số lượng</th>
            <th>Ghi chú</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->notes]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>