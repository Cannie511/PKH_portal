<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Ngày thu</th>
            <th>Loại</th>
            <th>Mã cửa hàng</th>
            <th>Mã kế toán</th>
            <th>Tên cửa hàng</th>
            <th>Số tài khoản</th>
            <th>Tên nhân viên</th>
            <th>Số tiền</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->payment_date]]</td>
                <td>[[$item->payment_type]]</td>
                <td>[[$item->store_id]]</td>
                <td>[[$item->accountant]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->bank_account_no]]</td>
                <td>[[$item->salesman_name]]</td>
                <td>[[$item->payment_money]]</td>
                <td>[[$item->notes]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>