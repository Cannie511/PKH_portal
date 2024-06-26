<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày nghỉ</th>
            <th>Loại</th>
            <th>Ngày đăng ký</th>
            <th>Người đăng ký</th>
            <th>Trạng thái</th>
            <th>Ngày duyệt</th>
            <th>Người duyệt</th>
            <th>Nội dung</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->absent_date]]</td>
                <td>
                    <?php
                    if ($item->absent_type == 1 ) {
                        echo "Nghỉ buổi sáng";
                    } else if ($item->absent_type == 2 ) {
                        echo "Nghỉ buổi chiều";
                    } else if ($item->absent_type == 3 ) {
                        echo "Nghỉ cả ngày";
                    }
                    ?>
                </td>
                <td>[[$item->created_at]]</td>
                <td>[[$item->user_name]]</td>
                <td>
                    <?php
                    if ($item->status == 1 ) {
                        echo "Chờ duyệt";
                    } else if ($item->status == 2 ) {
                        echo "Đồng ý";
                    } else if ($item->status == 3 ) {
                        echo "Từ chối";
                    } else if ($item->status == 4 ) {
                        echo "Hủy";
                    }
                    ?>
                </td>
                <td>[[$item->approve_ts]]</td>
                <td>[[$item->approve_name]]</td>
                <td>
                    [[$item->reason]]
                    [[$item->cmt]]
                </td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>