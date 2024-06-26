@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm mới Katana đăng báo Tuổi trẻ ngày 26-07-2017"; ?>

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
				WaterTec VN- Các đại lý tòan quốc vui lòng đón đọc Dòng sản phẩm mới trên Báo Tuổi trẻ ngày mai thứ 4(26/07/2017) để có thêm thông tin cho việc kinh doanh của Cửa hàng. Chương trình "mua 1 đựơc 100" sẽ kết thúc trong 5 ngày nữa. Mọi thông tin đăng ký làm đại lý phân phối hoặc đặt hàng vui lòng liên hệ qua email <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="cs@phankhangco.com"  href="mailto://cs@phankhangco.com">cs@phankhangco.com</a> hoặc hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>. Trân trọng thông báo.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017.jpg") %>' alt="dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017_2.jpg") %>' alt="dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017_3.jpg") %>' alt="dong-san-pham-moi-katana-dang-bao-tuoi-tre-26-07-2017" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>


@stop
