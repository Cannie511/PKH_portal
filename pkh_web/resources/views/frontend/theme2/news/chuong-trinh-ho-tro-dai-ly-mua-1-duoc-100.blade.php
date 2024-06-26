@extends('frontend.theme2.layouts.master')

<?php $title = "Chương trình hỗ trợ đại lý mua 1 được 100"; ?>

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
				Chương trình hỗ trợ đại lý phát triển sản phẩm mới. <br/>
				Mua 1 mã sản phẩm mới sẽ được chọn mua 1 sản phẩm bất kỳ với số lượng gấp 100 lần.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/ho-tro-dai-ly-mua-1-duoc-100.jpg") %>' alt="chuong-trinh-ho-tro-dai-ly-mua-1-duoc-100" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
