<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Ngày</td>
            <th>Xuất/Nhập</td>
            <th>Loại vật phẩm</td>
            <th>Vật phẩm</td>
            <th>Giá</td>
            <th>Số lượng</td>
            <th>Thành tiền</td>
            <th>Trạng thái</td>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <?php 
            //$endNum = $item->start_num - $item->out_num - $item->out_num_edit + $item->in_num + $item->in_num_edit;
            ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->changed_date]]</td>
                <td>
                    <?php
                    if ($item->warehouse_change_type == 1 ) {
                        echo "Nhập";
                    } else if ($item->warehouse_change_type == 2 ) {
                        echo "Xuất";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($item->type == 1 ) {
                        echo "Marketing";
                    } else if ($item->type == 2 ) {
                        echo "Văn phòng";
                    } else if ($item->type == 3 ) {
                        echo "In ấn";
                    }
                    ?>
                </td>
                <td>[[$item->name]]</td>
                <td>[[$item->price]]</td>
                <td>[[$item->amount]]</td>
                <td>[[$item->price * $item->amount]]</td>
                <td>
                    <?php
                    if ($item->status == '1' ) {
                        echo "Mới";
                    } else if ($item->status == '2' ) {
                        echo "Đồng ý";
                    } else if ($item->status == '3' ) {
                        echo "Từ chối";
                    } else if ($item->status == '4' ) {
                        echo "Hủy";
                    }
                    ?>
                </td>

                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>