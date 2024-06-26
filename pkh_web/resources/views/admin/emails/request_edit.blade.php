<html>
<body>

<h3>Yêu cầu xử lý đơn hàng: </h3>

<pre>
---------------------------------------<br/>
Tên: <?php echo $param['user']; ?><br/>
Mail: <?php echo $param['user_mail']; ?><br/>
Ngày: <?php echo date('Y-m-d'); ?><br/>
Loại: <?php echo $param['type']; ?><br/>

Mã đơn hàng: <?php echo $param['store_order_code']; ?><br/>
Lý do: <?php echo $param['notes']; ?><br/>
URL: <a href="<?php echo env('DOMAIN_ADMIN', 'http://portal.phankhangco.com') . '/#' . $param['url']; ?>"><?php echo env('DOMAIN_ADMIN', 'http://portal.phankhangco.com') . '/#/crm0210/' . $param['url']; ?></a><br/>
---------------------------------------
</pre>

</body>
</html>