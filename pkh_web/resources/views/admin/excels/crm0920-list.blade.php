<table>
    <thead>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">Ngày</td>
            <th rowspan="2">Kho</th>
            <th rowspan="2">NCU</th>
            <th rowspan="2">Loại</td>
            <th rowspan="2">Mã SP</td>
            <th rowspan="2">Tên sản phẩm</td>
            <th rowspan="2">Số lượng</td>    
            <th colspan="3">Đặt hàng</td>
            <th colspan="3">Giao hàng</td>
            <th rowspan="2">Cửa hàng</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Mã đặt hàng</th>                                
            <th>Ngày đặt</th>                                
            <th>Tình trạng</th>                                
            <th>Mã giao hàng</th>                                
            <th>Ngày giao</th>                                
            <th>Tình trạng</th> 
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
                <td>[[$item->warehouse_name]]</td>
                <td>[[$item->supplier_code]]</td>
                <td>
                    <?php
                    if ($item->warehouse_change_type == 1 ) {
                        echo "Nhập";
                    } else if ($item->warehouse_change_type == 2 ) {
                        if ($item->order_type == 2 ) {
                            echo "Xuất bảo hành";
                        } else if ($item->order_type == 3 ) {
                            echo "Xuất mẫu";
                        } else {
                              echo "Xuất";
                        }
                      
                    } else if ($item->warehouse_change_type == 3 ) {
                        echo "Tăng";
                    } else if ($item->warehouse_change_type == 4 ) {
                        echo "Giảm";
                    } else if ($item->warehouse_change_type == 5 ) {
                        echo "Nhập bảo hành để bán";
                    } else if ($item->warehouse_change_type == 6 ) {
                        echo "Nhập trả lại để bán";
                    } 
                    else if ($item->warehouse_change_type == 7 ) {
                        echo "Nhập kho từ kho khác";
                    } 
                    else if ($item->warehouse_change_type == 8 ) {
                        echo "Xuất kho cho kho khác";
                    } 
                    ?>
                </td>
                <td>[[$item->product_code]]</td>
                <td>[[$item->product_name]]</td>
                <td>[[$item->amount]]</td>

                <?php if ($item->warehouse_change_type != 2 ): ?>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php else: ?>
                    <td>[[$item->store_order_code]]</td>
                    <td>[[$item->order_date]]</td>
                    <td>
                        <?php
                        if ($item->order_sts == 0 ) {
                            echo "Mới";
                        } else if ($item->order_sts == 1 ) {
                            echo "Đang soạn";
                        } else if ($item->order_sts == 2 ) {
                            echo "Đã giao";
                        } else if ($item->order_sts == 4 ) {
                            echo "Hoàn tất";
                        } else if ($item->order_sts == 5 ) {
                            echo "Hủy";
                        } 
                        ?>
                    </td>
                <?php endif; ?>

                <?php if ($item->warehouse_change_type != 2 ): ?>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php else: ?>
                    <td>[[$item->store_delivery_id]]</td>
                    <td>[[$item->delivery_date]]</td>
                    <td>
                        <?php
                        if ($item->delivery_sts == 0 ) {
                            echo "Mới";
                        } else if ($item->delivery_sts == 1 ) {
                            echo "Đang giao";
                        } else if ($item->delivery_sts == 4 ) {
                            echo "Hoàn tất";
                        } else if ($item->delivery_sts == 5 ) {
                            echo "Hủy";
                        } 
                        ?>
                    </td>
                <?php endif; ?>

                <td>[[$item->store_name]]</td>
                
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>