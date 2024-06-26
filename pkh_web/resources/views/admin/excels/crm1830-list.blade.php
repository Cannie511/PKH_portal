<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Số chứng từ</th>
            <th>Ngày nhập</th>
            <th>Diễn giải</th>
            <th>Tk đối ứng</th>
            <th>Loại chi phí</th>
            <th>Phòng ban</th>
            <th>Phát sinh nợ</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->voucher]]</td>
                <td>[[$item->cost_date]]</td>
                <td>[[$item->description]]</td>
                <td>[[$item->contra_account]]</td>
                <td>[[$item->cate_name]]</td>
                <td>[[$item->department_name]]</td>
                <td>[[$item->amount]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>