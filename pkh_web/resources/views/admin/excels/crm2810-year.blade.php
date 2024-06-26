<?php
    use Carbon\Carbon;
    $yearData = $data["yearData"];
    $year = $data["year"];
    
    $totalTarget = 0;
    $totalResult = 0;
?>
<table>
    <tr>
        <td>Năm</td>
        <td><?php echo $year; ?></td>
    </tr>
</table>

<table>
    <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">Loại</th>
        <th rowspan="2">Mã SP</th>
        <th rowspan="2">Tên SP</th>
        <th colspan="2">Dự kiến</th>
        <th colspan="2">Thực tế</th>
        <th rowspan="2">Tỉ lệ</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th></th>
    </tr>
    <?php for($i = 0; $i < count($yearData); $i++): ?>
        <?php 
            $item = $yearData[$i];
            $target_money = $item->amount * intval($item->selling_price) * (100 - $item->discount) / 100;
            if (!isset($item->result_money)) {
                $item->result_money = 0;
            }
            if (!isset($item->result_amount)) {
                $item->result_amount = 0;
            }
            if ($target_money > 0 ) {
                $percent = $item->result_money / $target_money;
            } else {
                $percent = 0;
            }
            $totalTarget += $target_money;
            $totalResult += $item->result_money;
        ?>
        <tr>
            <td><?php echo($i+1); ?></td>
            <td><?php echo $item->product_cat_name; ?></td>
            <td><?php echo $item->product_code; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->amount; ?></td>
            <td><?php echo $target_money; ?></td>
            <td><?php echo $item->result_amount; ?></td>
            <td><?php echo $item->result_money; ?></td>
            <td><?php echo $percent; ?></td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $totalTarget;?></td>
        <td></td>
        <td><?php echo $totalResult;?></td>
        <td>
            <?php 
                if ($totalTarget > 0) {
                    echo ($totalResult / $totalTarget);
                } else {
                    echo(0);
                }
            ?>
        </td>
    </tr>
</table>

<?php
// Format style
$sheet = $data["sheet"];

$endRow = 5 + count($yearData) + 1;

$sheet->getStyle("A3:D3")->getFont()->setBold(true);

$sheet->setColumnFormat(array(
    'F5:H' . $endRow => '#,##0',
    'I5:I' . $endRow => '0.00%'
));

$sheet->setAutoSize(array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I' )); 
?>