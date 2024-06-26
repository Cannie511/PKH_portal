<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Weekday</th>
            <th>Date </th>
            <th>Username</th>
            <th>Login time</th>
            <th>Delayed time (minute)</th>
        
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <?php
                    $name = $item["name"];
                    $weekday = $item["D"];
                    $date = $item["date"];
                    $time = $item["time"];
                    $min =$item["min"];
                 ?>
                <td>[[$index]]</td>
                <td>[[$weekday]]</td>
                <td>[[$date]]</td>
                <td>[[$name]]</td>
                <td>[[$time]]</td>
                <td>[[$min]]</td>
             
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>