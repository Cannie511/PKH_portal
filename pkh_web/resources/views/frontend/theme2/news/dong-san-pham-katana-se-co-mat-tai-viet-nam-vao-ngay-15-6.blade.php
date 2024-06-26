@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm Katana sẽ có mặt tại Việt Nam vào ngày 15/6"; ?>

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
				WaterTec VN - Dòng sản phẩm Katana sẽ có mặt tại Việt Nam vào ngày 15/6. Các Đại lý toàn quốc đón đọc Dòng sản phẩm mới cao cấp Katana Maylaysia trên Báo tuổi trẻ hôm nay thứ 6(12/5/2017) để hỗ trợ thêm việc kinh doanh. Liên hệ đặt hàng hoặc làm Đại lý phân phối qua email cs@phankhangco.com hoặc 0906 610 116.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6.jpg") %>' alt="dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6-tuoi-tre.jpg") %>' alt="dong-san-pham-katana-se-co-mat-tai-viet-nam-vao-ngay-15-6" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
