<html>
<body>

<span>Chào <?php echo $param['user']['name']; ?>,</span>
<br/>

<p>
Mật khẩu của bạn đã được thiết lập lại. Vui lòng đăng nhập theo hướng dẫn sau.
</p>

<pre>
---------------------------------------<br/>
URL: <?php echo $param['loginUrl']; ?><br/>
Tài khoản: <?php echo $param['user']['email']; ?><br/>
Mật khẩu: <?php echo $param['newPassword']; ?><br/>
---------------------------------------
</pre>

<p>
Mọi thắc mắc về hệ thống xin vui lòng liên hệ dịch vụ khách hàng với email cs@phankhangco.com hoặc số điện thoại hotline 
</p>


</body>
</html>