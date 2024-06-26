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

<?php foreach($listProductChunkArr as $groupIndex => $listCat3): ?>
	<?php 
		$imgIndex = 1; 
		$className = $groupIndex % 2 == 0 ? "": "dark-group";
		$imgClassName = $groupIndex % 2 == 0 ? "": "rounded img-thumbnail";
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
					<img class="img-responsive margin-auto image-product <?php echo $imgClassName;?>" src="<?= $imgUrl?>" alt="<?php echo $product->product_code . " " . $product->name; ?>">
					<h6 class="header-text mt5"><?php echo $product->name; ?></h6>
					<h6 class="header-text black"><?php echo $product->product_code; ?></h6>
					<!-- <p class="text-desc"><?php echo $product->short_content; ?></p> -->
					<a class="btn btn-outline-secondary btn-detail mb-5" href="/san-pham/<?php echo Str::slug($product->name) . "/" . substr($product->product_code,0,6);?>">CHI TIẾT</a>
				</div>
				<?php 
					$imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
				?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php endforeach; ?>

<div class="container">
	<div class="product-cat-container">
	<?php foreach($listProductCat as $cat): ?>
		<div class="cat-item">
			<a class="btn btn-outline-secondary btn-product-cat" href="/danh-muc/<?php echo Str::slug($cat->name) . "/" . $cat->product_cat_code;?>"><?php echo $cat->name;?></a>
		</div>
	<?php endforeach; ?>
	</div>
</div>


@stop


