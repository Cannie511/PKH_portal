@extends('frontend.theme2.layouts.master')

<?php $title = "Thông báo thay đổi giá sản phẩm Watertec từ Quý 2 năm 2017"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			Công ty Phan Khang Home xin thông báo đến các Đại lý phân phối một số thay đổi về giá thành sản phẩm waterTec bắt đầu có hiệu lực từ quý 2 ngày 1/4/2017. mọi thắc mắc vui lòng liên hệ Bộ phận chăm sóc khách hàng cs@phankhangco.com hoặc hotline 0906610116. Trân trọng thông báo.
		</div>
		<div class="col-md-12 text-center">
			<img class="img-responsive" style="margin:auto" src='<% asset_url("/frontend/img/news/thong-bao-thay-doi-gia-san-pham-watertec-tu-quy-2-2017.jpg") %>' alt="Thông báo thay đổi giá sản phẩm Watertec từ Quý 2 năm 2017">
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
