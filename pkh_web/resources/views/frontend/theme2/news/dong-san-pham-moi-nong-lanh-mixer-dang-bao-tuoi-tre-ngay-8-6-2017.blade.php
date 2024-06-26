@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm mới nóng lạnh Mixer ngày 8/6/2017"; ?>

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
				Các đại lý vui lòng đón đọc Dòng sản phẩm mới nóng lạnh Mixer trên báo tuổi trẻ hôm nay thứ 5 (8/6/2017) để có thêm thông tin cho việc kinh doanh. Trân trọng thông báo.
			</p>
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-nong-lanh-mixer.jpg") %>' alt="dong-san-pham-moi-nong-lanh-mixer" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-nong-lanh-mixer-tuoi-tre-8-6-2017.jpg") %>' alt="su-kien-vietbuild-2017-so-do" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
