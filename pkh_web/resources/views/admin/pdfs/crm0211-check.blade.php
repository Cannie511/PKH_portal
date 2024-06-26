<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <style type="text/css">
            body {
                font-family: "DejaVu Sans";
                font-size: 12px;
                margin-bottom: 50px;
            }
            .table {
                width: 100%;
                border: 1px solid #000;
            }
            .table th {
                vertical-align: middle;
                text-align: center;
                font-weight: bold;
            }
            .table th, td {
                border: 1px solid #000;   
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
            .text-left{
                text-align: left !important;
            }

            .table.no-border,
            .table.no-border tr,
            .table.no-border td {
                border: none;
            }
        </style>
    </head>
    <body>
        <script type="text/php">
        if ( isset($pdf) ) { 
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    //$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $font = $fontMetrics->get_font("DejaVu Sans", "normal");
                    $size = 8;
                    $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                    $y = 750;
                    $x = 520;
                    $pdf->text($x, $y, $pageText, $font, $size);
                } 
            ');
        }
        </script>
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td><h2>PHIẾU SOẠN HÀNG</h2></td>
                <td class="text-right"><i>Người in: [[$username]]</i></td>
                <td style="width: 200px" class="text-right"><i>Ngày in: [[date('Y-m-d H:i:s')]]</i></td>
            </tr>
            <tr> 
                <td>Nơi xuất: [[$branch->branch_name]] - [[$branch->branch_address]]</td>
            </tr>
        </table>
        <?php if(!empty($orders)): ?>
        	<?php foreach($orders as $order): ?>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th class="text-left">Mã soạn hàng</th>
                        <td><b>[[$order->store_delivery_code]]</b></td>
                        <th class="text-left">Ngày đặt hàng</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th class="text-left">Người tạo</th>
                        <td>[[$order->create_by]]</td>
                        <th class="text-left">Người sửa</th>
                        <td>[[$order->update_by]]</td>
                    </tr>
                 
                    <tr>
                        <th class="text-left">Cửa hàng</th>
                        <td colspan="3"><i>[[$order->store->name]]</i></td>
                    </tr>
                    <tr>
                        <th class="text-left">Địa chỉ</th>
                        <td colspan="3">[[$order->store->address]]&nbsp;</td>
                    </tr>
                    <?php if(isset($order->store->address_chanh) && !empty($order->store->address_chanh)): ?>
                    <tr>
                        <th class="text-left">Chành</th>
                        <td colspan="3">[[$order->store->address_chanh]]&nbsp;</td>
                    </tr>
                    <?php endif; ?>
                </table>
                <table class="table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 30px">STT</th>
                            <th rowspan="2">Mô tả</th>
                            <th rowspan="2" style="width: 60px">Giá</th>
                            <th rowspan="2">Đơn vị<br/>Đóng gói</th>
                            <th colspan="4">Số lượng</th>
                            <th rowspan="2">Thành tiền</th>
                            <th rowspan="2">Ghi chú</th>
                        </tr>
                        <tr>
                            <th>ĐH</th>
                            <th>ĐG</th>
                            <th>CL</th>
                            <th>TT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index = 1;
                            $sumCarton = 0; 
                            $sumMoney = 0;
                        ?>
                        <?php if(!empty($order->details)): ?>
                            <?php foreach ($order->details as $detail): ?>
                                <?php 
                                    $sumCarton += round($detail->amount / $detail->standard_packing, 1);
                                    $remain = $detail->amount;
                                    if( isset($order->sumExport[$detail->product_id]) ) {
                                        $remain = $detail->amount - $order->sumExport[$detail->product_id];
                                    }
                                    $money = $remain * $detail->unit_price;
                                    $sumMoney += $money;
                                ?>
                                <tr>
                                    <td class="text-center">[[$index++]]</td>
                                    <td>
                                        <b>[[$detail->product_code]]</b> <br/>
                                        [[$detail->product_name]] 
                                        <!--<br/>
                                        <b>([[$detail->stock_code]]</b> - [[$detail->stock_name]]) -->
                                    </td>
                                    <td class="text-center">[[number_format($detail->unit_price)]]</td>
                                    <td class="text-center">Bộ<br/>([[$detail->standard_packing]])</td>
                                    <td class="text-center">
                                        [[number_format($detail->amount)]]
                                        <br/>
                                        ([[round($detail->amount / $detail->standard_packing, 1)]])
                                    </td>
                                    <td class="text-center">
                                     0
                                    </td>
                                    <td class="text-center">
                                       0
                                    </td>
                                    <td>
                                    </td>
                                    <td class="text-right">
                                        [[number_format($money)]]
                                    </td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                    <thead>
                        <tr>
                            <td colspan="4"></td>
                            <td class="text-center">[[$sumCarton]]</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">[[number_format($sumMoney)]]</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Chiết khấu &nbsp;</td>
                            <td colspan="2" class="text-right">[[number_format($order->discount_1 + $order->discount_2)]]%</td>
                            <td></td>
                            <td></td>
                        <tr>
                            <td colspan="6" class="text-right">Thành tiền sau chiết khấu &nbsp;</td>
                            <td colspan="2" class="text-right">[[number_format($sumMoney * ( 100 - $order->discount_1 + $order->discount_2) / 100 )]]</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Thành tiền thực tế &nbsp;</td>
                            <td colspan="2" class="text-right"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                </table>
                <br/>
        	<?php endforeach;?>
        <?php else: ?>
        	Không tìm thấy đơn đặt hàng.
        <?php endif; ?>

      

        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-center" style="width:50%"><b>Người lập phiếu</b></td>
                <td class="text-center" style="width:50%"><b>Thủ kho</b></td>
            </tr>
        </table>

    </body>
</html>