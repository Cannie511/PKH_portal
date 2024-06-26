<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Bank name</th>
            <th>Store name</th>
            <th>Store address</th>
            <th>Bank branch</th>
            <th>Bank account no</th>
            <th>Bank account name</th>
            <th>notes</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->bank_name]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->address]]</td>
                <td>[[$item->bank_branch]]</td>
                <td>[[$item->bank_account_no]]</td>
                <td>[[$item->bank_account_name]]</td>
                <td>[[$item->notes]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>