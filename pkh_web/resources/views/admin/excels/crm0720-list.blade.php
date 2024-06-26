<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Mã KT</th>
            <th>Mã CH</th>
            <th>Tên cửa hàng</th>
            <th>Địa chỉ</th>
            <th>Công nợ tháng trước</th>
            <th>Tổng chưa chiết khấu</th>
            <th>Tổng ĐH đã CK</th>
            <th>Đã thanh toán</th>
            <th>Còn phải thu</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <?php
                $remain_lastmonth = -$item->payment_lastmonth + $item->total_with_discount_lastmonth;
                $remain = $remain_lastmonth + $item->total_with_discount_thismonth - $item->payment_thismonth;
            ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->accountant_store_id]]</td>
                <td>[[$item->store_id]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->address]]</td>
                <td>[[$remain_lastmonth]]</td>
                <td>[[$item->total_thismonth]]</td>
                <td>[[$item->total_with_discount_thismonth]]</td>
                <td>[[$item->payment_thismonth]]</td>
                <td>[[$remain]]</td>
                <td></td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>