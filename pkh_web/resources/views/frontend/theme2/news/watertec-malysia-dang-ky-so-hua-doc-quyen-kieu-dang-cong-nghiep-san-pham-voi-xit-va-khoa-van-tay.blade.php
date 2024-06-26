@extends('frontend.theme2.layouts.master')

<?php $title = "Watertec Malaysia đăng ký sở hữu độc quyền kiểu dáng công nghiệp sản phẩm vòi xịt và khóa vặn tay"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			Phan Khang Home - sản phẩm vòi xịt và khoá tay vặn WaterTec Malaysia thông báo trên báo Tuổi Trẻ 13/12/2016 với các hình ảnh chi tiết được sở hữu độc quyền kiểu dáng công nghiệp như dưới đây. Mọi sao chép kiểu dáng, hàng nhái giả sẽ bị xử lý theo Pháp Luật.
		</div>
		<div class="col-md-12">
			<img class="img-responsive" src='<% asset_url("/frontend/img/watertec-so-huu-doc-quyen-kieu-dang-voi-xit-khoa-van-tay-2016.jpg") %>' alt="vòi xịt và khóa tay vặn watertec đăng ký sở hữu độc quyền kiểu dáng công nghiệp">
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
