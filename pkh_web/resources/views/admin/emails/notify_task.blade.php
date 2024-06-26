<html>
<body>

<h3> <?php echo $param['content']; ?></h3>
<p>For the detail, please go to this site: https://portal.phankhangco.com/#/hrm0300</p>

<pre>
---------------------------------------<br/>
Task name : <?php echo $param['task_name']; ?><br/>
Task group: <?php echo $param['task_group_id']; ?><br/>
Detail: <?php if (isset($param['task_content'])) echo $param['task_content']; ?><br/>
Creator: <?php  echo $param['task_creator']; ?><br/>
Person in charge: <?php  echo $param['user_name']; ?><br/>
Deadline: <?php echo $param['deadline']; ?><br/>
--------------------------------------------

Person who is assigned task side.<br/>
Start date: <?php if (isset($param['start_date']))  echo  $param['start_date']; ?><br/>
End date  : <?php if (isset($param['end_date']))   echo $param['end_date']; ?><br/>
Submit content  : <?php if (isset($param['submit_notes']))  echo $param['submit_notes']; ?><br/>
----------------------------------------------- <br/>

<b>Person who evaluate task side</b>.<br/>
Score: <?php if (isset($param['task_score']))  echo $param['task_score']; ?><br/>
Response notes: <?php if (isset($param['response_notes']))  echo $param['response_notes']; ?><br/>

----------------------------------------------- <br/>

</pre>

<p>This is an automated email. Please do not answer.</p>
</body>
</html>