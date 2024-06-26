@extends('frontend.theme2.layouts.master')

@section('title')Danh mục sản phẩm @stop
@section('description') Giới thiệu về Phan Khang Ho, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead') 
<link rel="stylesheet" href='<% asset_url("frontend/js/jQuery-flexImages-master/jquery.flex-images.css") %>'>
<style>
	.item-product.item {
		text-align: center;
		border: 1px solid #eee;
		width: 180px;
		height: 213px;
	}
	.item-product.item img {
		max-width: 180px;
		max-height: 180px;
		margin: auto;
	}
	.bottom {
		border-top: 1px solid #eee;
		padding: 3px;
		font-size: 11px;
		line-height: 1.2em;
		background-color: #fafafa;
	}
	.group-cat {
		padding-top: 30px;
	}
	.dark-group {
		background-color: #eaeaea;
	}
	.header-text {
		text-transform: uppercase;
	}
	.black {
		color: #333;
	}
	.image-product {
		max-width: 120px;
		max-height: 120px;
		margin-top: 15px;
		margin-bottom: 15px
	}
	.img-product-container {
		/* background-color: #eaeaea; */
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.box-container {
		margin-top: 10px
	}
</style>
@stop

@section('pagescript')
@stop

@section('content')

<br/>

<?php
use Illuminate\Support\Str;
$listProductChunkArr = array_chunk($listProduct, 3, true);
?>

<!-- Product -->
<div class="container">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="/"><i class="fa fa-home"></i></a>
			</li>
			<li class="breadcrumb-item">
			<a href="/danh-muc/<?php echo Str::slug($product->product_cat_name)?>/<?php echo $product->product_cat_code;?>"><?php echo($product->product_cat_name) ?></a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">
				<?php echo("[" . $product->product_code . "] " . $product->name) ?>
			</li>
		</ol>
	</nav>
						
	<br/>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="sub-header">
				<h5 class="sub-header-text">SẢN PHẨM</h5>
				<img class="sub-title-logo" src='<% asset_url("frontend/theme2/images")%>/logo-sub-title.png' alt="">
			</div>
		</div>
	</div>

	<br/>

	<div class="row justify-content-start"">
		<div class="offset-md-2 col-md-3 col-sm-4 col-xs-12 img-product-container">
			<div class="container">
				<?php 
					//$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
					$code = substr($product->product_code, 0, 6);
					$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
					if ( !file_exists(public_path("img/product/" . $code . ".png"))) {
						$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . "WT0000.png";
					}
				?>
				<div class="text-center">
					<img class="img-responsive margin-auto image-product1 img-thumbnail" src="<?= $imgUrl?>" alt="<?php echo $product->product_code . " " . $product->name; ?>">
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-8 col-xs-12">
			<div class="sub-header box-container">
				
				<h5>
				<a class="" href="/danh-muc/<?php echo Str::slug($product->product_cat_name) . "/" . $product->product_cat_code;?>"><?php echo $product->product_cat_name ?></a>
				</h5>
				<h4><?php echo $product->product_code ?></h4>
				<h3><?php echo $product->name ?></h3>

				<?php if ($product->warranty_year > 0) { ?>
					<h4>Bảo hành:  <?php echo $product->warranty_year ?> năm</h4>
				<?php } ?>

				<?php
					$shopee_url = "https://shopee.vn/shop/200161922/search";
					if (isset($product->shopee_url)) {
						$shopee_url = $product->shopee_url;
					}
				?>

				<br/>
				<a class="btn" target="__blank" href="<?php echo $shopee_url;?>">
					<img class="img-fluid" src="/img/shopee.png" />
				</a>
				<br/>

				<?php if ($product->warranty_year > 0) { ?>
					<a class="btn btn-outline-secondary btn-detail mt-5 mb-5" href="/bao-hanh/<?php echo substr($product->product_code,0,6);?>">ĐĂNG KÝ BẢO HÀNH</a>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>

<?php foreach($listProductChunkArr as $groupIndex => $listCat3): ?>
	<?php 
		$imgIndex = 1; 
		$className = $groupIndex % 2 == 0 ? "": "dark-group";
	?>
	<div class="group-cat <?= $className?>">
		<div class="container">
		<div class="product-container">
			
			<?php foreach($listCat3 as $key => $product): ?>
				<div class="product-item">
				<?php 
					//$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
					$code = substr($product->product_code, 0, 6);
					$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
					if ( !file_exists(public_path("img/product/" . $code . ".png"))) {
						$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . "WT0000.png";
					}
				?>
					<img class="img-responsive margin-auto image-product" src="<?= $imgUrl?>" alt="<?php echo $product->product_code . " " . $product->name; ?>">
					<h6 class="header-text mt5"><?php echo $product->name; ?></h6>
					<h6 class="header-text black"><?php echo $product->product_code; ?></h6>
					<!-- <p class="text-desc"><?php echo $product->short_content; ?></p> -->
					<a class="btn btn-outline-secondary btn-detail mb-5" href="/san-pham/<?php echo Str::slug($product->name) . "/" . substr($product->product_code,0,6);?>">CHI TIẾT</a>
				<?php 
					$imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
				?>
				</div>
			<?php endforeach; ?>
		</div>
		</div>
	</div>

<?php endforeach; ?>

@stop


