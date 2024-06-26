@extends('frontend.theme2.layouts.master')

<?php $title = "Chương trình khuyến mãi hấp dẫn tháng 5/2017"; ?>

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
				WaterTec Vietnam- Chương trình khuyến mãi cực hấp dẫn dành cho dòng dây xịt 001U, 002U và 001Q bắt đầu từ 1/5/2017. Thông tin chi tiết liên hệ <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="cs@phankhangco.com"  href="mailto://cs@phankhangco.com">cs@phankhangco.com</a> hoặc hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>. Trân trọng thông báo đến quý Đại lý toàn quốc.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/chuong-trinh-khuyen-mai-hap-dan-thang-5-2017.jpg") %>' alt="chuong-trinh-khuyen-mai-hap-dan-thang-5-2017" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
