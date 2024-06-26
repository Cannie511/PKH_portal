
<?php
$salary = $data["salary"];
$listEmployee = $data["listEmployee"];
?>

<html>

    <head>
        <style type="text/css">
        .header th {
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
        <td colspan="4"><b>THÔNG TIN BẢNG LƯƠNG <?php echo(substr($salary->salary_month,0,7)); ?></b></td>
    </tr>
    <tr>
        <td>Từ ngày</td>
        <td><?php echo($salary->from_date);?></td>
        <td>Đến ngày</td>
        <td><?php echo($salary->to_date);?></td>
    </tr>
    <tr>
        <td>Số ngày LV</td>
        <td><?php echo($salary->total_days);?></td>
        <td>Số giờ chuẩn</td>
        <td><?php echo($salary->total_hours);?></td>
    </tr>
    <tr>
        <td>Ghi chú</td>
        <td colspan="3"><?php echo($salary->notes);?></td>
    </tr>
</table>

<br/>

<table class="table-border">
    <tr class="header">
        <th rowspan="2">NO</th>
        <th rowspan="2">Mã</th>
        <th rowspan="2">Tên</th>
        <th rowspan="2">Giới Tính</th>
        <th rowspan="2">Ngày Sinh</th>
        <th rowspan="2">Số ngày LV</th>
        <th rowspan="2">Số giờ LV</th>
        <th rowspan="2">Lương GROSS</th>
        <th rowspan="2">Lương cơ bản</th>
        <th rowspan="2">Lương thực tế</th>
        <th rowspan="2">Tăng ca</th>
        <th rowspan="2">Thưởng + Hoa Hồng</th>
        <th rowspan="2">Tổng thu nhập</th>
        <th colspan="3">Cách khoản khấu trừ</th>
        <th rowspan="2">Thuế TNCN</th>
        <th rowspan="2">Các khoản khác (Phạt)</th>
        <th rowspan="2">Tạm ứng</th>
        <th rowspan="2">Thực nhận</th>
        <th colspan="3">Khoảng công ty trả</th>
        <th rowspan="2">Tổng cộng</th>
    </tr>
    <tr class="header">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>BHXH (<?php echo($salary->tax_bhxh_percent);?>%)</th>
        <th>BHYT (<?php echo($salary->tax_bhyt_percent);?>%)</th>
        <th>BHTN (<?php echo($salary->tax_bhtn_percent);?>%)</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>BHXH (<?php echo($salary->com_tax_bhxh_percent);?>%)</th>
        <th>BHYT (<?php echo($salary->com_tax_bhyt_percent);?>%)</th>
        <th>BHTN (<?php echo($salary->com_tax_bhtn_percent);?>%)</th>
        <th></th>
    </tr>

    <?php $index = 0 ; ?>
    <?php 
        $sum_gross = 0;
        $sum_basic = 0;
        $sum_real = 0;
        $sum_ot = 0;
        $sum_bonus = 0;
        $sum_bhxh = 0;
        $sum_bhyt = 0;
        $sum_bhtn = 0;
        $sum_pit = 0;
        $sum_advance = 0;
        $sum_minus = 0;
        $sum_total = 0;
        $sum_income = 0;
        $sum_com_bhxh = 0;
        $sum_com_bhyt = 0;
        $sum_com_bhtn = 0;
        $sum_com_total = 0;
    ?>
    <?php foreach($listEmployee as $employee): ?>
    <tr>
        <?php 
            $total_income = $employee->real_salary
                + $employee->overtime_salary + $employee->bonus;
            $com_total = $employee->net_salary 
                +  $employee->tax_bhxh 
                +  $employee->tax_bhyt 
                +  $employee->tax_bhtn 
                +  $employee->tax_pit 
                +  $employee->com_tax_bhxh 
                +  $employee->com_tax_bhyt 
                +  $employee->com_tax_bhtn; 
            // Calculate summary
            $sum_gross += $employee->gross_salary;
            $sum_basic += $employee->basic_salary;
            $sum_real += $employee->real_salary;
            $sum_ot += $employee->overtime_salary;
            $sum_bonus += $employee->bonus;
            $sum_income += $total_income;
            $sum_bhxh += $employee->tax_bhxh;
            $sum_bhyt += $employee->tax_bhyt;
            $sum_bhtn += $employee->tax_bhtn;
            $sum_pit += $employee->tax_pit;
            $sum_minus += $employee->minus_amount;
            $sum_advance += $employee->advance;
            $sum_total += $employee->net_salary;
            $sum_com_bhxh += $employee->com_tax_bhxh;
            $sum_com_bhyt += $employee->com_tax_bhyt;
            $sum_com_bhtn += $employee->com_tax_bhtn;
            $sum_com_total += $com_total;
        ?>
        <td><?php echo(++$index); ?></td>
        <td><?php echo($employee->employee_code); ?></td>
        <td><?php echo($employee->fullname); ?></td>
        <td>
            <?php 
                if ($employee->gender == "MALE") {
                    echo("Nam");
                } else if ($employee->gender == "FEMALE") {
                    echo("Nữ");
                }
            ?>
        </td>
        <td><?php echo($employee->dob); ?></td>
        <td><?php echo($employee->total_days); ?></td>
        <td><?php echo($employee->total_hours); ?></td>
        <td><?php echo($employee->gross_salary); ?></td>
        <td><?php echo($employee->basic_salary); ?></td>
        <td><?php echo($employee->real_salary); ?></td>
        <td><?php echo($employee->overtime_salary); ?></td>
        <td><?php echo($employee->bonus); ?></td>
        <td><?php echo($total_income); ?></td>
        <td><?php echo($employee->tax_bhxh); ?></td>
        <td><?php echo($employee->tax_bhyt); ?></td>
        <td><?php echo($employee->tax_bhtn); ?></td>
        <td><?php echo($employee->tax_pit); ?></td>
        <td><?php echo($employee->minus_amount); ?></td>
        <td><?php echo($employee->advance); ?></td>
        <td><?php echo($employee->net_salary); ?></td>
        <td><?php echo($employee->com_tax_bhxh); ?></td>
        <td><?php echo($employee->com_tax_bhyt); ?></td>
        <td><?php echo($employee->com_tax_bhtn); ?></td>
        <td><?php echo($com_total); ?></td>
    </tr>
    <?php endforeach; ?>
        
    <tr>
        <td></td>
        <td></td>
        <td>Tổng cộng</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo($sum_gross); ?></td>
        <td><?php echo($sum_basic); ?></td>
        <td><?php echo($sum_real); ?></td>
        <td><?php echo($sum_ot); ?></td>
        <td><?php echo($sum_bonus); ?></td>
        <td><?php echo($sum_income); ?></td>
        <td><?php echo($sum_bhxh); ?></td>
        <td><?php echo($sum_bhyt); ?></td>
        <td><?php echo($sum_bhtn); ?></td>
        <td><?php echo($sum_pit); ?></td>
        <td><?php echo($sum_minus); ?></td>
        <td><?php echo($sum_advance); ?></td>
        <td><?php echo($sum_total); ?></td>
        <td><?php echo($sum_com_bhxh); ?></td>
        <td><?php echo($sum_com_bhyt); ?></td>
        <td><?php echo($sum_com_bhtn); ?></td>
        <td><?php echo($sum_com_total); ?></td>
    </tr>

</table>

</body>
</html>

<?php
// Format style
$sheet = $data["sheet"];
$sheet->setColumnFormat(array(
    'H9:X' . (count($listEmployee) + 10) => '#,##0'
));
?>