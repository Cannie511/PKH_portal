<html>
<body>

<h3> <?php echo $param['content']; ?></h3>
<p>For the detail, please go to this site: https://portal.phankhangco.com/#/crm1830/ <?php echo $param['cost_id']; ?></p>

<pre>
---------------------------------------<br/>
Ngày nhập : <?php echo $param['cost_date']; ?><br/>
Diễn giải: <?php echo $param['description']; ?><br/>
Số tiền: <?php  echo $param['amount']; ?><br/>
Ghi chú cho đề nghị duyệt: <?php  echo $param['request_notes']; ?><br/>

--------------------------------------------
</pre>

<p>This is an automated email. Please do not answer.</p>
</body>
</html>