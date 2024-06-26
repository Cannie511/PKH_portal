<html>
<body>

<h3>Thông tin cửa hàng: </h3>

<pre>
---------------------------------------<br/>
Store ID: <?php echo $param['store']['id']; ?><br/>
Name: <?php echo $param['store']['name']; ?><br/>
Address: <?php echo $param['store']['address']; ?><br/>
---------------------------------------
</pre>

<h3>Thông tin đặt hàng: </h3>

<pre>
---------------------------------------<br/>
<?php foreach($param['listProduct'] as $product): ?>
	<?php echo $product['product_code']; ?> &nbsp; <?php echo $product['name']; ?> &nbsp;[QTY] <?php echo $product['qty']; ?>
<?php endforeach; ?>
---------------------------------------
Total: <?php echo $param['order']['total']; ?>
Discount 1: <?php echo $param['order']['discount_1']; ?>%
Discount 2: <?php echo $param['order']['discount_2']; ?>%
</pre>

<h3>Thông tin người đặt: </h3>

<pre>
---------------------------------------<br/>
Tên: <?php echo $param['user']->name; ?><br/>
Email: <?php echo $param['user']->email; ?><br/>
---------------------------------------
</pre>


</body>
</html>