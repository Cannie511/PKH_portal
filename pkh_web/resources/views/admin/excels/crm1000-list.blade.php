<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>delivery_date</th>
            <th>delivery_vendor_name</th> 
            <th>price</th>
            <th>notes</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->delivery_date]]</td>
                <td>[[$item->delivery_vendor_name]]</td>
                <td>[[$item->price]]</td>
                <td>'[[$item->notes]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>