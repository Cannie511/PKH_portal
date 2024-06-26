@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm Watertec Quatro Chrome"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">

		<p>
			WaterTec Vietnam - các Đại lý toàn quốc vui lòng đón đọc thông tin về Dòng sản phẩm Quatro Chrome hôm nay thứ 2 (27/3/2017) để có thêm tài liệu hỗ trợ cho việc kinh doanh của các đại lý.
		mọi liên hệ vui lòng email <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="cs@phankhangco.com"  href="mailto://cs@phankhangco.com">cs@phankhangco.com</a> hoặc hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>. Trân trọng thông báo.
		</p>			
		<p class="text-center">
			<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-watertec-quatro-chrome.jpg") %>' alt="dong-san-pham-watertec-quatro-chrome" style="margin:auto">
			<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-watertec-quatro-chrome-2.jpg") %>' alt="dong-san-pham-watertec-quatro-chrome-2" style="margin:auto">
		</p>

		<p class="text-right">
			<i>(Tuổi Trẻ ngày 27/03/2017)</i>
		</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
