<table>
    <thead>
        
        <tr>
            <th>NO</th>
            <?php foreach($data["header"] as $header): ?>
                <td>[[$header]]</td>     
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data["data"] as $item): ?>
            <tr>
                <td>[[$index]]</td>
                    <?php foreach($data["header"] as $header): ?>
                        <?php
                            if (isset($item[$header])){
                                $it = $item[$header];
                            } else {
                                $it= "";
                            }
                            
                        ?>
                        <td>[[$it]]</td>
                
                    <?php endforeach; ?>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>