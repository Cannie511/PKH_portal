<table>
    <thead>
        <tr>
        
            <th>NO</th>
            <th>Task name</th>
            <th>Task group</th>
            <th>Task creator</th>
            <th>Assign to</th>
            <th>Task status</th>
        
            <th>Deadline</th>
            <th>End date</th>
            <th>Day delay</th>
            <th>Scoring</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach($data as $item): ?>
            <tr>
                <td>[[$index]]</td>
                <td>[[$item->task_name]]</td>
                <td>
                    <?php
                    if ($item->task_group_id== 1 ) {
                        echo "Daily job";
                    } else if ($item->task_group_id == 2 ) {                      
                            echo "Improvement"; 
                        }
                        else if ($item->task_group_id == 3 ) {                   
                            echo "Developmenth";                    
                        }
                    ?>
                </td>
                <td>[[$item->task_creator]]</td>
                <td>[[$item->user_name]]</td>
                <td>
                    <?php
                    if ($item->task_sts== 1 ) {
                        echo "New";
                    } else if ($item->task_sts == 2 ) {                      
                            echo "Doing"; 
                        }
                        else if ($item->task_sts == 3 ) {                   
                            echo "Finish";                    
                        } else if ($item->task_sts == 4 ) {                   
                            echo "Scoring";                    
                        }
                    ?>
                </td>
                
                <td>[[$item->deadline]]</td>
                <td>[[$item->end_date]]</td>
                <td>[[$item->delay_1]]</td>
                <td>'[[$item->task_score]]</td>
                <?php $index++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>