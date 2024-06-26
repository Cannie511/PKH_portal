<?php
    use Carbon\Carbon;
    $kpi = $data["kpi"];
    $store = $data["store"];
    
    $totalTarget = 0;
    $totalResult = 0;
?>
<table>
    <tr>
        <th colspan="4">KPI Cửa hàng</th>
    </tr>
    <tr>
        <th>Cửa hàng</th>
        <td colspan="3"><?php echo $store->name; ?></td>
    </tr>
    <tr>
        <th>Địa chỉ</th>
        <td colspan="3"><?php echo $store->address; ?></td>
    </tr>
</table>
<table>
    <tr>
        <th>Tháng</th>
        <th>Dự kiến</th>
        <th>Thực tế</th>
        <th>%</th>
    </tr>
    <?php for($i = 1; $i <=12 ; $i++): ?>
        <tr>
            <td>Tháng <?php echo $i; ?></td>
            <td>
                <?php  
                    $prop1 = "month_" . $i . "_target";
                    echo $kpi->$prop1;
                    $totalTarget += $kpi->$prop1;
                    ?>
            </td>
            <td>
                <?php  
                    $prop2 = "month_" . $i . "_result";
                    echo $kpi->$prop2;
                    $totalResult += $kpi->$prop2;
                ?>
            </td>
            <td>
                <?php
                    if ($kpi->$prop1 > 0) {
                        echo($kpi->$prop2 / $kpi->$prop1);
                    } else {
                        echo(0);
                    }
                ?>
            </td>
        </tr>
    <?php endfor;?>

    <tr>
        <td></td>
        <td><?php echo $totalTarget; ?></td>
        <td><?php echo $totalResult; ?></td>
        <td>
            <?php
                if ($totalTarget > 0) {
                    echo($totalResult / $totalTarget);
                } else {
                    echo(0);
                }
            ?>
        </td>
    </tr>

<table>

<?php
// Format style
$sheet = $data["sheet"];

$sheet->getStyle("A5:D5")->getFont()->setBold(true);

$sheet->setColumnFormat(array(
    'B5:C18' => '#,##0',
    'D5:D18' => '0.00%'
));
?>