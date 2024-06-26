<html>
<body>

<h3>Thông tin người dùng: </h3>

<pre>
---------------------------------------<br/>
Họ tên: <?php echo $param['name']; ?><br/>
Email: <?php echo $param['email']; ?><br/>
Điện thoại: <?php echo $param['tel']; ?><br/>
Nội dung: <br/>
<?php echo $param['content']; ?><br/>
---------------------------------------
</pre>

<h3>Gửi từ </h3>
<pre>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~<br/>
IP: <?php echo $param['ip']; ?><br/>
Agent: <?php echo $param['agent']; ?><br/>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~<br/>
</pre>

</body>
</html>