<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Ngày nhập</th>
            <th>Kho</th>
            <th>Loại</th>
            <th>Tên cửa hàng</th>
            <th>Địa chỉ</th>
            <th>Người phụ trách</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Ghi chú</th>
            <th>Thời gian tạo</th>
            <th>Thời gian cập nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->import_date]]</td>
                <td>[[$item->warehouse_name]]</td>
                <td>
                    <?php if ($item->import_type == 1) echo "Bảo hành"; else echo "Trả lại"; ?>
                </td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->store_address]]</td>
                <td>[[$item->salesman_name]]</td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->notes]]</td>
                <td>[[$item->created_at]]</td>
                <td>[[$item->updated_at]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>