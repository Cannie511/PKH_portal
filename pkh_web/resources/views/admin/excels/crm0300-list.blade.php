<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>name</th>
            <th>address</th>
            <th>area1_name</th>
            <th>area2_name</th>
            <th>first_order</th> 
            <th>salesman_name</th>
            <th>chanh_name</th>
           
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->name]]</td>
                <td>[[$item->address]]</td>
                <td>[[$item->area1_name]]</td>
                <td>[[$item->area2_name]]</td>
                <td>[[$item->first_order]]</td>
                <td>[[$item->salesman_name]]</td>
                <td>[[$item->chanh_name]]</td>
             
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>