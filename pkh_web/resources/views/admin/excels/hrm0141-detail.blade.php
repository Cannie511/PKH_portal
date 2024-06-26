<?php
    use Carbon\Carbon;
    $calendar = $data["calendar"];
    $employee = $data["employee"];
    $month = $data["month"];
?>
<table>
    <tr>
        <td><h3>Bảng thời gian làm việc</h3></td>
        <td></td>
    </tr>
    <tr>
        <td>Tháng</td>
        <td><?php echo $data["month"]; ?></td>
    </tr>
    <tr>
        <td>Mã Nhân viên</td>
        <td><?php echo($employee->employee_code); ?></td>
    </tr>
    <tr>
        <td>Tên Nhân viên</td>
        <td><?php echo($employee->fullname); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo($employee->email); ?></td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Ngày</th>
            <th>Thứ</th>
            <th>Sớm nhất</th>
            <th>Trễ nhất</th>
            <th>Bắt đầu</th>
            <th>Kết thúc</th>
            <th>Thời gian</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php 
            // For summary
            $totalDays = 0;
            $totalWorkingDays = 0;
            $totalWorkingHours = 0;
            $todayAbsent = 0;
            $todayAbsentNo = 0;
            $todayHoliday = 0;
            $totalWorkingHoursString = "00:00";
        ?>
        <?php foreach($calendar as $cal): ?>
            <?php
                // add to summary
                if ($cal["workday"] > 0) {
                    if ($cal["is_holiday"] == 1) {
                        $todayHoliday++;
                    } else {
                        $totalDays += $cal["workday"];
                        if ( isset($cal["working_hours"]) && $cal["working_hours"]) {
                            $totalWorkingDays += ($cal["working_hours"] >= 4)? 1: 0.5;
                            $totalWorkingHours += $cal["working_hours"];
                        }

                        if ( !isset($cal["first_time"]) && 
                            isset($cal["absent_type"]) &&
                            $cal["absent_type"] != '1' && 
                            $cal["absent_type"] != '2' && 
                            $cal["absent_type"] != '3' ) {
                            $todayAbsentNo += 1;
                        }

                        if ( isset($cal["absent_type"]) && $cal["absent_type"] == 3) {
                            $todayAbsent += 1;
                        } else if (isset($cal["absent_type"]) && 
                            ($cal["absent_type"] == 1 || $cal["absent_type"] == 2)) {
                            $todayAbsent += 0.5;
                        } 
                    }
                }
            ?>
            <tr>
                <td><?php echo $index; ?></td>
                <td><?php echo $cal["date"]; ?></td>
                <td><?php echo Carbon::createFromFormat('Y-m-d', $cal["date"])->format('D') ; ?></td>
                <td><?php echo $cal["first_time"] ?? ""; ?></td>
                <td><?php echo $cal["last_time"] ?? ""; ?></td>
                <td><?php echo $cal["start_time"] ?? ""; ?></td>
                <td><?php echo $cal["end_time"] ?? ""; ?></td>
                <td><?php echo $cal["working_hour_min"] ?? ""; ?></td>
                <td>
                    <?php if(isset($cal["leave_type"]) && $cal["leave_type"] == '1'): ?>
                    AL&nbsp;
                    <?php endif; ?>
                    <?php if(isset($cal["leave_type"]) && $cal["leave_type"] == '2'): ?>
                    NP&nbsp;
                    <?php endif; ?>
                    <?php if(isset($cal["absent_type"]) && $cal["absent_type"] == '1'): ?>
                    (AM)&nbsp;
                    <?php endif; ?>
                    <?php if(isset($cal["absent_type"]) && $cal["absent_type"] == '2'): ?>
                    (PM)&nbsp;
                    <?php endif; ?>
                    <?php if(isset($cal["absent_type"]) && $cal["absent_type"] == '3'): ?>
                    (ALL DAY)&nbsp;
                    <?php endif; ?>
                    <?php if(isset($cal["absent_reason"])): ?>
                        <?php echo($cal["absent_reason"]); ?>
                    <?php endif; ?>
                    <?php if(isset($cal["holiday_reason"])): ?>
                        <?php echo($cal["holiday_reason"]); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php $index++; ?>
        <?php endforeach; ?>
    </tbody>
    <?php 
        if ($totalWorkingHours > 0 ){
            $hours = floor($totalWorkingHours / 60);
            $min = $totalWorkingHours - $hours * 60;
            $totalWorkingHoursString = $hours . " hours " . substr("00" . $min, -2) . " minutes";
        }
    ?>
    <tfoot>
        <tr>
            <td>Số ngày trong tháng</td>
            <td><?php echo($totalDays);?></td>
        </tr>
        <tr>
            <td>Số ngày lễ</td>
            <td><?php echo($todayHoliday);?></td>
        </tr>
        <tr>
            <td>Số ngày nghỉ có phép</td>
            <td><?php echo($todayAbsent);?></td>
        </tr>
        <tr>
            <td>Số ngày nghỉ không phép</td>
            <td><?php echo($todayAbsentNo);?></td>
        </tr>
        <tr>
            <td>Số ngày đi làm</td>
            <td><?php echo($totalWorkingDays);?></td>
        </tr>
        <tr>
            <td>Số giờ làm</td>
            <td><?php echo($totalWorkingHoursString);?></td>
        </tr>
    </tfoot>
</table>

<table>
    <tr>
        <td>AL<td>
        <td>Annual Leave<td>
    </tr>
    <tr>
        <td>NP<td>
        <td>Unpaid Leave<td>
    </tr>
    <tr>
        <td>ML<td>
        <td>Maternity Leave<td>
    </tr>
    <tr>
        <td>HO<td>
        <td>Holiday<td>
    </tr>
</table>