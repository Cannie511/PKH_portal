<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Stock code</th>
            <th>Descript (eng)</th>
            <th>Mã PKH</th>
            <th>Descript (vi)</th>      
            <th>Màu</th>
            <th>Giá</th>      
            <th>Đóng gói</th>
            <th>Số lượng</th>
            <th>Số thùng</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->stock_code]]</td>
                <td>[[$item->product_name]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->name_vi]]</td>
                <td>[[$item->color]]</td>
                <td>[[$item->unit_price]]</td>
                <td>[[$item->standard_packing]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->amount/$item->standard_packing]]</td>
                
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>