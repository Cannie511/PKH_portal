<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Tỉnh/TP</th>
            <th>Cửa hàng</th> 
            <th>Địa chỉ</th> 
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->area1]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->address]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->product_name]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>