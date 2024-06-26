@extends('frontend.theme2.layouts.master')

<?php $title = "Vòi xịt vệ sinh Vitus 2 - 2017"; ?>

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
				WaterTec VN- đại diện bởi Phan Khang Home thông báo chương trình " vòi xịt 401 + 15%" nhằm hỗ trợ đại lý của PKH phát triển trong tháng 8. Mọi thông tin đăng ký làm đại lý phân phối hoặc đặt hàng vui lòng liên hệ qua email <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="cs@phankhangco.com"  href="mailto://cs@phankhangco.com">cs@phankhangco.com</a> hoặc hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>. Trân trọng thông báo.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/voi-xit-ve-sinh-vitus-2-2017.jpg") %>' alt="voi-xit-ve-sinh-vitus-2-2017" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
