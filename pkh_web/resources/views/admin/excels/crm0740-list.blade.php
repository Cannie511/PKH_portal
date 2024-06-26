<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã sp</th>
            <th>Tên sp</th>
            <th>Đóng gói</th>
            <th>số lượng tồn</th>
            <th>Đơn giá kế toán</th>
            <th>Số lượng xuất</th>
            
           
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <?php $product_code  =$item['product_code'] ; ?>
                <?php $product_name  =$item['product_name'] ; ?>
                <?php $standard_packing  =$item['standard_packing'] ; ?>
                <?php $balance  =$item['balance'] ; ?>
                <?php $unit_price  =$item['unit_price'] ; ?>
                <?php $amount  =$item['amount'] ; ?>
                <td>[[$index]]</td>
                <td>[[$product_code]]</td>
                <td>[[$product_name]]</td>
                <td>[[$standard_packing]]</td>
                <td>[[$balance]]</td>
                <td>[[$unit_price]]</td>
                <td>[[$amount]]</td-->
         
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>