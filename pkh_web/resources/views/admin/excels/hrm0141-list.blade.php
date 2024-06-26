<?php
    use Carbon\Carbon;
    $calendar = $data["listAll"]["calendar"];
    $listEmployeeCal = $data["listAll"]["listEmployeeCal"];
?>
<table>
    <tr>
        <td><h3>Bảng thời gian làm việc <?php echo $data["month"]; ?></h3></td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th rowspan="3">NO</th>
            <th rowspan="3">Mã Nhân viên</th>
            <th rowspan="3">Tên Nhân viên</th>
            <?php
                // Print days from calendar
                foreach($calendar as $cal):
            ?>
                <th><?php echo Carbon::createFromFormat('Y-m-d', $cal["date"])->format('d') ; ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <?php
                // Print days from calendar
                foreach($calendar as $cal):
            ?>
                <th><?php echo Carbon::createFromFormat('Y-m-d', $cal["date"])->format('D') ; ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <?php
                // Print days from calendar
                // $weekMap = [
                //     0 => 'SU',
                //     1 => 'MO',
                //     2 => 'TU',
                //     3 => 'WE',
                //     4 => 'TH',
                //     5 => 'FR',
                //     6 => 'SA',
                // ];
                $weekMap = [
                    0 => 0, // 'SU',
                    1 => 1, // 'MO',
                    2 => 1, // 'TU',
                    3 => 1, // 'WE',
                    4 => 1, // 'TH',
                    5 => 1, // 'FR',
                    6 => 0.5 // 'SA',
                ];
                foreach($calendar as $cal):
            ?>
                <th>
                    <?php if($cal["is_holiday"] == 1): ?>
                    0
                    <?php else: ?>
                    <?php 
                        $dayOfWeek = Carbon::createFromFormat('Y-m-d', $cal["date"])->dayOfWeek;
                        echo($weekMap[$dayOfWeek]);
                    ?>
                    
                    <?php endif; ?>
                </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($listEmployeeCal as $employee): ?>
            <tr>
                <td><?php echo $index; ?></td>
                <td><?php echo $employee["code"]; ?></td>
                <td><?php echo $employee["fullname"]; ?></td>

                <!-- Print date -->
                <?php foreach($employee["days"] as $dayInfo): ?>
                    <td>
                        <?php if($dayInfo["is_holiday"] == 1): ?>
                        HO&nbsp;
                        <?php endif; ?>
                        <?php if(isset($dayInfo["leave_type"]) && $dayInfo["leave_type"] == '1'): ?>
                        AL&nbsp;
                        <?php endif; ?>
                        <?php if(isset($dayInfo["leave_type"]) && $dayInfo["leave_type"] == '2'): ?>
                        NP&nbsp;
                        <?php endif; ?>
                        <?php if(isset($dayInfo["absent_type"]) && $dayInfo["absent_type"] == '1'): ?>
                        (AM)&nbsp;
                        <?php endif; ?>
                        <?php if(isset($dayInfo["absent_type"]) && $dayInfo["absent_type"] == '2'): ?>
                        (PM)&nbsp;
                        <?php endif; ?>
                        <?php if(isset($dayInfo["working_hour_min"]) && $dayInfo["working_hour_min"] != '00:00'): ?>
                        X (<?php echo $dayInfo["working_hour_min"] ?>)
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php $index++; ?>
        <?php endforeach; ?>
    </tbody>
</table>