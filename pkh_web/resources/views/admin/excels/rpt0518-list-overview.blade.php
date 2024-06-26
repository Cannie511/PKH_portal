<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Store name</th>
            <th>Province</th>
            <th>First order</th>
            <th>2016 TurnOver</th>
            <th>2017 TurnOver</th>
            <th>2018 TurnOver</th>
            <th>2019 TurnOver</th>
            <th>Total</th>
            <th>Month Purchase</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->province]]</td>
                <td>[[$item->first_order]]</td>
                <td>[[$item->Y2016]]</td>
                <td>[[$item->Y2017]]</td>
                <td>[[$item->Y2018]]</td>
                <td>[[$item->Y2019]]</td>
                <td>[[$item->total]]</td>
                <td>[[$item->month_purchase]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>