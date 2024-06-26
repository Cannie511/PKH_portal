<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>delivery_vendor_name</th>
            <th>contact_name</th>
            <th>contact_email</th>
            <th>contact_tel</th>
            <th>contact_fax</th>
            <th>contact_mobile1</th>
            <th>contact_mobile2</th>
            <th>notes</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->delivery_vendor_name]]</td>
                <td>[[$item->contact_name]]</td>
                <td>[[$item->contact_email]]</td>
                <td>[[$item->contact_tel]]</td>
                <td>[[$item->contact_fax]]</td>
                <td>[[$item->contact_mobile1]]</td>
                <td>[[$item->contact_mobile2]]</td>
                <td>[[$item->notes]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>