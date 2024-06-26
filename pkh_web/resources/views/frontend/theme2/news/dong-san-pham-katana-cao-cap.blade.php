@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm KATANA cao cấp"; ?>

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
				Nhằm hỗ trợ các đại lý kinh doanh sản phẩm waterTec, Công ty Phan Khang Home thực hiện đăng quảng cáo dòng sản phẩm cao cấp KATANA trên Báo Tuổi trẻ ra ngày thứ Tư ( 15/2/2017). Mọi chi tiết vui lòng liên hệ hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a> hoặc <a class="btn-ga" ga-cat="contact" ga-action="click" ga-label="www.phankhangco.com" href="http://www.phankhangco.com">www.phankhangco.com</a>
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/dong-san-pham-katana-cao-cap.jpg") %>' alt="dong san pham katana cao cap watertec" style="margin:auto">
			</p>
			
			<p class="text-right">
				<i>(Tuổi Trẻ ngày 15/02/2017)</i>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
