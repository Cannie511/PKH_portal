<?php
    use Carbon\Carbon;
    $detail = $data["detail"];
    $salary = $data["salary"];
?>

<html>

    <head>
        <style type="text/css">
        .header {
            background-color: #ecf0f5;
            text-align: center;
        }


        .table-border td,
        .table-border th {
            border-bottom: 1px solid #000000;
            border-top: 1px solid #000000;
            border-left: 1px solid #000000;
            border-right: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        </style>
    </head>

    <body>
        <table>
            <tr>
                <td colspan="4" style="text-align:center;"><h3>BẢNG LƯƠNG CHI TIẾT THÁNG <?php echo(Carbon::createFromFormat('Y-m-d', $detail->salary_month)->format('Y-m'))?></h3></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:right;">Mã Nhân viên:</td>
                <td><?php echo($detail->employee_code); ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:right;">Tên Nhân viên:</td>
                <td><?php echo($detail->fullname); ?></td>
            </tr>
        </table>

        <?php 
        $index = 1;
        setlocale(LC_MONETARY,"en_US");
        $total_income = intval($detail->real_salary) + intval($detail->overtime_salary) + intval($detail->bonus);
        ?>

        <table class="table-border">
            <tr>
                <th class="header" style="width:5">NO</th>
                <th class="header" style="width:30">Mục</th>
                <th class="header" style="width:40">Công thức</th>
                <th class="header" style="width:20">Giá trị</th>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td style="text-align:left;">Lương GROSS</td>
                <td>(1)</td>
                <td style="text-align:right"><?php echo($detail->gross_salary);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td style=";text-align:left;">Lương cơ bản</td>
                <td>(2)</td>
                <td style="text-align:right"><?php echo($detail->basic_salary);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Số ngày làm việc</td>
                <td></td>
                <td style="text-align:right"><?php echo($detail->total_days . "/" . $detail->standard_days);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Số giờ làm việc</td>
                <td></td>
                <td style="text-align:right"><?php echo($detail->total_hours . "/" . $detail->standard_hours);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Lương thực tế</td>
                <td>(4)</td>
                <td style="text-align:right"><?php echo($detail->real_salary);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Tăng ca</td>
                <td>(5)</td>
                <td style="text-align:right"><?php echo($detail->overtime_salary);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Thưởng + Hoa Hồng</td>
                <td>(6)</td>
                <td style="text-align:right"><?php echo($detail->bonus);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Tổng thu nhập</td>
                <td>(7) = (4) + (5) + (6)</td>
                <td style="text-align:right"><?php echo($total_income);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Bảo hiểm xã hội (<?php echo($detail->tax_bhxh_percent)?>%)</td>
                <td>(8) = (2) * <?php echo($detail->tax_bhxh_percent)?>%</td>
                <td style="text-align:right"><?php echo($detail->tax_bhxh);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Bảo hiểm y tế (<?php echo($detail->tax_bhyt_percent)?>%)</td>
                <td>(9) = (2) * <?php echo($detail->tax_bhyt_percent)?>%</td>
                <td style="text-align:right"><?php echo($detail->tax_bhyt);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Bảo hiểm thất nghiệp (<?php echo($detail->tax_bhtn_percent)?>%)</td>
                <td>(10) = (2) * <?php echo($detail->tax_bhtn_percent)?>%</td>
                <td style="text-align:right"><?php echo($detail->tax_bhtn);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Thuế TNCN</td>
                <td>(11) (*)</td>
                <td style="text-align:right"><?php echo($detail->tax_pit + $detail->tax_pit_edit);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Các khoản phạt khác</td>
                <td>(12)</td>
                <td style="text-align:right"><?php echo($detail->minus_amount);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Tạm ứng</td>
                <td>(13)</td>
                <td style="text-align:right"><?php echo($detail->advance);?></td>
            </tr>
            <tr>
                <td><?php echo $index++; ?></td>
                <td>Thực nhận</td>
                <td>(14) = (7) - (8) - (9) - (10) - (11) - (12) - (13)</td>
                <td style="text-align:right"><?php echo($detail->net_salary);?></td>
            </tr>
        </table>

        <table>
            <tr>
                <td colspan="2" style="text-align:center">
                Nhân viên
                </td>
                <td colspan="2" style="text-align:center">
                Giám Đốc
                </td>
            </tr>
        </table>
    </body>
<html>

<?php
// Format style
$sheet = $data["sheet"];
$sheet->setColumnFormat(array(
    'D6:D20' => '#,##0'
));
?>