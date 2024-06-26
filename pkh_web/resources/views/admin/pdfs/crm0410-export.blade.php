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

            #logo {
                width: 200px;
            }

            #store_info th {
                width: 150px;
                text-align: left;
            }
            #store_info th,
            #store_info td {
                padding-left: 3px;
                padding-right: 3px;
            }

            #detail th,
            #detail td {
                padding-left: 3px;
                padding-right: 3px;
            }

            .sp-code {
                font-weight: bold;
            }

            .sp-name {
                font-style: italic;
            }

            .num_export {
                font-weight: bold;
                font-size: 16px;
                border: 2px solid #000 !important;
                border-top: 2px solid #000;
                border-left: 2px solid #000;
                border-right: 2px solid #000;
                border-bottom: 2px solid #000;
                min-width: 30px;
                padding: 2px 5px;
            }
            .num_export-inner {
                width: 150px;
            }
            .page-break {
                page-break-after: always;
            }

            .p2-title {
                text-align: center;
                font-size: 16px;
            }

            .text-bold {
                font-weight: bold;
            }

            .first_line {
                width: 50px;
                display: inline-block;
            }

            .paragraph {
                text-align: justify;
            }
        </style>
    </head>
    <body>
        <?php
            $pageNames = [];
            $pageNames[0] = "Liên 1: Kho";
            $pageNames[1] = "Liên 2: Kế toán";
            $pageNames[2] = "Liên 3: Lưu tạm";
            $pageNames[3] = "Liên 4: Khách hàng giữ";
        ?>
        <?php for($i = 0; $i < 4; $i++): ?>
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding-left: 5px">
                    <b><span>Công ty TNHH PHAN KHANG HOME</span></b><br/>
                    <b><span>Nhà phân phối độc quyền sản phẩm WATERTEC</span></b><br/>
                    <span>Showroom: 63, đường số 30,Phường Tân Phong, Quận 7</span><br/>
                    <span>Hotline:  (+84)90-6610-116</span><br/>
                    <span>Website:  www.phankhangco.com</span><br/>
                    <!-- <span>Mã số thuế: 0313993571</span><br/> -->
                    <span>Nơi xuất: [[$branch->branch_name]] </span><br/>
                    <span>[[ $pageNames[$i] ]]</span>
                </td>
                <td class="text-right">
                    <span></span>
                    <img id="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAdEAAADICAYAAAC3bdt8AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA/FpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ1dWlkOjVEMjA4OTI0OTNCRkRCMTE5MTRBODU5MEQzMTUwOEM4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjk1MzgzNzcyNzczNjExRTY4QTMxQ0RCODMxQTNCNDFDIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjk1MzgzNzcxNzczNjExRTY4QTMxQ0RCODMxQTNCNDFDIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIElsbHVzdHJhdG9yIENTNiAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0idXVpZDo0ZjJlYzVjMy1jOWU3LTQ2MzEtYWRhMy0zNmNhZjdjY2NjZDAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MkJBNTI0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" alt="" />
                    <br/>
                    <i>Ngày in: [[date('Y-m-d H:i:s')]]</i>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <h2>PHIẾU XUẤT HÀNG (#[[$storeDelivery->store_delivery_id]])</h2>
                </td>
            </tr>
        </table>

        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th>Mã đơn hàng</th>
                <td>[[$storeDelivery->store_delivery_code]] (#[[$storeDelivery->store_delivery_id]])&nbsp;</td>
                <th>Ngày xuất</th>
                <td>[[$storeDelivery->delivery_date]]&nbsp;</td>
            </tr>
            <tr>
                <th>Đơn vị mua hàng</th>
                <td colspan="3">[[$store->name]]</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>[[$store->contact_tel]]&nbsp;[[$store->contact_mobile1]]&nbsp;[[$store->contact_mobile2]]</td>
                <th>Mã số thuế</th>
                <td>[[$store->tax_code]]&nbsp;</td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td colspan="3">[[$store->address]]&nbsp;</td>
            </tr>
            <?php if(isset($store->address_chanh) && !empty($store->address_chanh)): ?>
            <tr>
                <th>Chành</th>
                <td colspan="3">[[$store->address_chanh]]&nbsp;</td>
            </tr>
            <?php endif;?>
            <tr>
                <th>Thông tin tài khoản</th>
                <td colspan="3">
                    Ngân hàng Vietcombank - CN Tân Định HCM <br/>
                    <b>Số tài khoản: 0371000412610 </b> &nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Tên tài khoản: PHAN HUU CHIEN</b> <br/>
                    <b>Nội dung thanh toán: "Tên cửa hàng"</b>
                </td>
            </tr>
            <tr>
                <th>Hạn thanh toán</th>
                <td colspan="3">[[$payment_date]]</td>
            </tr>
            <tr>
                <th>Ghi chú</th>
                <td colspan="3">[[$storeDelivery->notes]]</td>
            </tr>
        </table>

        <br/>

        <?php

            $sumItem = 0;
            $sumCarton = 0;
            $sumMoney = 0;
            $totalDiscount = intval($storeDelivery->discount_1) + intval($storeDelivery->discount_2);
            $discountMoney = $storeDelivery->total - $storeDelivery->total_with_discount;

        ?>
        
        <div class="text-right"><i>Đơn vị tính: VNĐ</i></div>
        <table id="detail" class="table" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 30px">STT</th>
                    <th rowspan="2">SẢN PHẨM</th>
                    <th rowspan="2" style="width: 40px">ĐVT</th>
                    <th rowspan="2" style="width: 70px">ĐƠN GIÁ</th>
                    <th colspan="2" style="width: 70px">SỐ LƯỢNG</th>
                    <th rowspan="2" style="width: 90px">THÀNH TIỀN</th>
                </tr>
                <tr>
                    <th style="width: 40px">(C)</th>
                    <th style="width: 30px">(TH)</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach($storeDeliveryDetail as $dDetail): ?>
                <?php 
                    $sumItem = $sumItem + $dDetail->amount;
                    $sumCarton = $sumCarton + round( ($dDetail->amount / $dDetail->standard_packing));
                    $sumMoney = $sumMoney + $dDetail->unit_price * $dDetail->amount;
                ?>
                <tr>
                    <td class="text-center"><?php echo $index++; ?></td>
                    <td><span class="sp-code">[[$dDetail->product_code]]</span> - <span class="sp-name">[[$dDetail->product_name]]</span></td>
                    <td class="text-center">BỘ</td>
                    <td class="text-right">[[number_format($dDetail->unit_price)]]</td>
                    <td class="text-right">[[number_format($dDetail->amount)]]</td>
                    <td class="text-right">[[number_format(round($dDetail->amount / $dDetail->standard_packing))]]</td>                    
                    <td class="text-right">[[number_format($dDetail->unit_price * $dDetail->amount)]]</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="4"><b>TỔNG CỘNG</b></td>
                    <td class="text-right">[[number_format($sumItem)]]</td>
                    <td class="text-right">[[number_format($sumCarton)]]</td>
                    <td class="text-right">[[number_format($sumMoney)]]</td>
                </tr>
                <?php if ($totalDiscount > 0): ?>
                <tr>
                    <td class="text-center" colspan="6"><b>CHIẾT KHẤU ([[$totalDiscount]]%)</b></td>
                    <td class="text-right">[[number_format($discountMoney)]]</td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td class="text-center" colspan="6"><b>THÀNH TIỀN</b></td>
                    <td class="text-right"><b>[[number_format($storeDelivery->total_with_discount)]]</b></td>
                </tr>
            </tfoot>
        </table>

        <br/>

        <?php if ( count($productSeries) > 0 ): ?>
            <b>Thông tin bộ sản phẩm</b>
            <?php $preBo = "" ;?>
            <?php foreach ($productSeries as $series): ?>
                <?php if ( $preBo != $series->serie_name ): ?>
                    <br/>※ <b>[[$series->serie_name]]:</b>
                    <?php $preBo = $series->serie_name; ?>
                <?php else: ?>
                    , &nbsp;
                <?php endif; ?>
                    <span>[[$series->product_code]] <i>[[$series->product_name]]</i></span>
            <?php endforeach; ?>

            <br/>
            <br/>

        <?php endif; ?>
                
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-center" style="width:33%"><b>Người nhận hàng</b><br/><small>(Ký và ghi rõ họ tên)</small></td>
                <td class="text-center" style="width:34%"><b>Thủ kho</b><br/><small>(Ký và ghi rõ họ tên)</small></td>
                <td class="text-center" style="width:33%"><b>Người duyệt</b><br/><small>(Ký và ghi rõ họ tên)</small></td>
            </tr>
            <tr>
                <td class="text-center" style="width:33%"></td>
                <td class="text-center" style="width:34%"><b></b></td>
    
            </tr>
        </table>
        <div style="position: relative">    
            <div style="position: absolute; bottom: 5px;">
            &nbsp;&nbsp;&nbsp;&nbsp; <span>Hotline: (+84)90-6610-116 </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email:info@phankhangco.com &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website: www.phankhangco.com
            </div>
        </div>
        <div class="page-break"></div>

        <?php endfor; ?>

        <table class="table no-border text-bold" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" style="vertical-align: top">CÔNG TY TNHH PHAN KHANG HOME<br/></td>
                <td class="text-center" width="50%">
                    CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br/>
                    Độc lập - Tự do - Hạnh phúc
                </td>
            </tr>
        </table>

        <br/>

        <div class="p2-title text-bold">THƯ CÁM ƠN</div>

        <p class="paragraph"><span class="first_line"></span>Kính gửi quý Đại lý,</p>

        <p class="paragraph"><span class="first_line"></span>
            Lời đầu tiên, công ty Phan Khang Home xin gửi tới quý khách lời cảm ơn và tri ân sự ủng hộ, hợp tác trong việc kinh doanh sảnh phẩm WaterTec Malysia trong suốt thời gian qua.
        </p>

        <p class="paragraph"><span class="first_line"></span>
            Ngoài mục tiêu xây dựng và phát triển một thương hiệu WaterTec Vietnam thực sự chất lượng, uy tín, xem lợi ích của Quý khách hàng, người tiêu dùng là tiêu chí thành công của công ty, Phan Khang Home mong muốn đồng hành cùng đại lý để từng bước khẳng định thương hiệu của sản phẩm WaterTec đối với người tiêu dùng Việt.
        </p>

        <p class="paragraph"><span class="first_line"></span>
            Nhân đây, Công ty cũng xin gửi một phần quà đến Đại lý. Trong thời gian tới, chúng tôi mong muốn tiếp tục nhận được sự quan tâm, đồng hành nhiệt tình và tích cực của Quý khách hàng để có thể cùng nhau phát triển bền lâu và vững mạnh. Mọi thắc mắc vui lòng liên hệ <b>Bộ phận bán hàng</b> hoặc <b>Chăm sóc khách hàng</b> của Công ty qua email <b>cs@phankhangco.com</b> hoặc hotline <b>0906 610 116</b>.
        </p>

        <p class="paragraph"><span class="first_line"></span>
            Một lần nữa Công ty xin gửi lời cảm ơn chân thành.
        </p>

        <p class="paragraph"><span class="first_line"></span>
            Kính chúc Quý khách hàng sức khỏe, hạnh phúc và thành công.
        </p>

        <p class="paragraph"><span class="first_line"></span>
            Trân trọng.
        </p>

        <table class="table no-border text-bold" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" style="vertical-align: top">
                    <br/>
                    Nơi nhận:<br/>
                    - Đại lý,<br/>
                    - Lưu: VT, hồ sơ.
                </td>
                <td class="text-center" width="50%" style="vertical-align: top">
                    GIÁM ĐỐC CÔNG TY
                    <br/>
                    <img id="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARgAAACMCAIAAAAobCE6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkQyRTYyRjFGMkIyNjExRTdCM0M3REZENzk1NEQ3NTlDIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkQyRTYyRjIwMkIyNjExRTdCM0M3REZENzk1NEQ3NTlDIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RDJFNjJGMUQyQjI2MTFFN0IzQzdERkQ3OTU0RDc1OUMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RDJFNjJGMUUyQjI2MTFFN0IzQzdERkQ3OTU0RDc1OUMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7Um1zBAAAZWklEQVR42uyd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" alt="" />
                    <br/>
                    PHAN HỮU CHIẾN
                </td>
            </tr>
        </table>

    </body>
</html>