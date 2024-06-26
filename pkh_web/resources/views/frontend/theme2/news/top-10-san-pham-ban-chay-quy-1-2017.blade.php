@extends('frontend.theme2.layouts.master')

<?php $title = "Top 10 sản phẩm bán chạy Quý 1 - 2017"; ?>

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
			WaterTec VN - công ty Phan Khang Home công bố danh sách Top 10 sản phẩm bán chạy quý 1/2017. Liên hệ đặt hàng hoặc làm Đại lý phân phối qua email cs@phankhangco.com hoặc 0906 610 116.
		</p>			
		<p class="text-center">
			<img class="img-responsive" src='<% asset_url("frontend/img/news/top-10-san-pham-ban-chay-quy-1-2017.jpg") %>' alt="top-10-san-pham-ban-chay-quy-1-2017" style="margin:auto">
		</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>


@stop
