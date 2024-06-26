<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Store name</th>
            <th>Province</th>
            <th>Year</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->store_name]]</td>
                <td>[[$item->province]]</td>
                <td>[[$item->year]]</td>
                <td>[[$item->T1]]</td>
                <td>[[$item->T2]]</td>
                <td>[[$item->T3]]</td>
                <td>[[$item->T4]]</td>
                <td>[[$item->T5]]</td>
                <td>[[$item->T6]]</td>
                <td>[[$item->T7]]</td>
                <td>[[$item->T8]]</td>
                <td>[[$item->T9]]</td>
                <td>[[$item->T10]]</td>
                <td>[[$item->T11]]</td>
                <td>[[$item->T12]]</td>
                <td>[[$item->total]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>