<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>area1_name</th>
            <th>area2_name</th>
            <th>purchase_date</th>
            <th>name</th>
            <th>email</th>
            <th>tel</th>
            <th>store</th>
            <th>created_at</th>
            <th>product_code</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->area1_name]]</td>
                <td>[[$item->area2_name]]</td>
                <td>[[$item->purchase_date]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->email]]</td>
                <td>[[$item->tel]]</td>
                <td>[[$item->store]]</td>
                <td>[[$item->created_at]]</td>
                <td>[[$item->product_code]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>