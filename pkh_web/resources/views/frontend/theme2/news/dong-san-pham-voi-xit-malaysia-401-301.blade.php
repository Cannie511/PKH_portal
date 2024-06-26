@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm vòi xịt Malaysia 401 &amp; 301"; ?>

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
				WaterTec VN- Các Đại lý toàn quốc đón đọc Dòng sản phẩm vòi xịt Maylaysia 401 &amp; 301 trên Báo tuổi trẻ hôm nay thứ 5 (27/4/2017) để hỗ trợ thêm việc kinh doanh. Liên hệ làm đại lý phân phối hoặc đặt hàng qua email <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="cs@phankhangco.com"  href="mailto://cs@phankhangco.com">cs@phankhangco.com</a> hoặc hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>. Trân trọng thông báo.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-voi-xit-malaysia-401-301.jpg") %>' alt="dong-san-pham-voi-xit-malaysia-401-301" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-voi-xit-malaysia-401-301-2.jpg") %>' alt="dong-san-pham-voi-xit-malaysia-401-301-bao-tuoi-tre" style="margin:auto">
			</p>

			<p class="text-right">
				<i>(Tuổi Trẻ ngày 27/04/2017)</i>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
