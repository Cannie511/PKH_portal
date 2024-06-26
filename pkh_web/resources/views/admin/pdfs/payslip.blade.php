<?php
    $total_income = $employee->real_salary + $employee->overtime_salary + $employee->bonus;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <style type="text/css">
            /* html, body { display: block; } */
            /* html, body {  display: table; } */
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
                padding: 2px;  
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
                <td style="padding-left: 5px" width="400px">
                    <b><span>Công ty TNHH PHAN KHANG HOME</span></b><br/>
                    <span>Showroom: 63, đường số 30,Phường Tân Phong, Quận 7</span><br/>
                    <span>Hotline:  (+84)90-6610-116</span><br/>
                    <span>Website:  www.phankhangco.com</span><br/>
                </td>
                <td class="text-right">
                    <span></span>
                    <img id="logo" src="data:image/jpeg;base64,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" alt="" />
                </td>
            </tr>
        </table>
        <h3 style="text-align: center">Bảng lương [[$salaryMonth]]</h3>
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 150px">Mã nhân viên:</td>
                <td>[[$employee->employee_code]]</td>
                <td style="width: 150px">Thời gian:</td>
                <td class="text-right">[[$salary->from_date]] ~ [[$salary->to_date]]</td>
            </tr>
            <tr>
                <td>Tên nhân viên:</td>
                <td>[[$employee->fullname]]</td>
                <td style="width: 150px">Ngày in:</td>
                <td class="text-right">[[date('Y-m-d H:i:s')]]</td>
            </tr>
        </table>

        <br/>

        <table class="table" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Mục</th>
                    <th>Công thức</th>
                    <th class="text-right">Giá trị</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Lương GROSS</td>
                    <td>(1)</td>
                    <td class="text-right">[[number_format($employee->gross_salary)]] đ</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Lương cơ bản</td>
                    <td>(2)</td>
                    <td class="text-right">[[number_format($employee->basic_salary)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Số ngày làm việc</td>
                    <td></td>
                    <td class="text-right">[[number_format($employee->total_days)]] Ngày</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Lương thực tế</td>
                    <td>(4)</td>
                    <td class="text-right">[[number_format($employee->real_salary)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>Tăng ca</td>
                    <td>(5)</td>
                    <td class="text-right">[[number_format($employee->overtime_salary)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td>Thưởng + Hoa Hồng</td>
                    <td>(6)</td>
                    <td class="text-right">[[number_format($employee->bonus)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">7</td>
                    <td>Tổng thu nhập</td>
                    <td>(7) = (4) + (5) + (6)</td>
                    <td class="text-right">[[number_format($total_income)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">8</td>
                    <td>Bảo hiểm xã hội ([[$salary->tax_bhxh_percent]]%)</td>
                    <td>(8) = (2) * [[$salary->tax_bhxh_percent]]%</td>
                    <td class="text-right">[[number_format($employee->tax_bhxh)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">9</td>
                    <td>Bảo hiểm y tế ([[$salary->tax_bhyt_percent]]%)</td>
                    <td>(9) = (2) * [[$salary->tax_bhyt_percent]]%</td>
                    <td class="text-right">[[number_format($employee->tax_bhyt)]] đ </td>
                <tr>
                    <td class="text-center">9</td>
                    <td>Bảo hiểm y tế ([[$salary->tax_bhyt_percent]]%)</td>
                    <td>(9) = (2) * [[$salary->tax_bhyt_percent]]%</td>
                    <td class="text-right">[[number_format($employee->tax_bhyt)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">10</td>
                    <td>Bảo hiểm thất nghiệp ([[$salary->tax_bhtn_percent]]%)</td>
                    <td>(10) = (2) * [[$salary->tax_bhtn_percent]]%</td>
                    <td class="text-right">[[number_format($employee->tax_bhtn)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">11</td>
                    <td>Thuế TNCN</td>
                    <td>(11) (*)</td>
                    <td class="text-right">[[number_format($employee->tax_pit)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">12</td>
                    <td>Các khoản phạt khác</td>
                    <td>(12)</td>
                    <td class="text-right">[[number_format($employee->minus_amount)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">13</td>
                    <td>Tạm ứng</td>
                    <td>(13)</td>
                    <td class="text-right">[[number_format($employee->advance)]] đ </td>
                </tr>
                <tr>
                    <td class="text-center">14</td>
                    <td>Thực nhận</td>
                    <td>(14) = (7) - (8) - (9) - (10) - (11) - (12) - (13)</td>
                    <td class="text-right"><b>[[number_format($employee->net_salary)]] đ </b></td>
                </tr>
            </tbody>
        </table>

        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-center">Giám đốc</td>
                <td class="text-center">Nhân viên</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="text-center">PHAN HỮU CHIẾN</td>
                <td class="text-center">[[$employee->fullname]]</td>
            </tr>
        </table>

    </body>
</html>