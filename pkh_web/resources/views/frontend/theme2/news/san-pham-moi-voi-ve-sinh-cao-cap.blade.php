@extends('frontend.theme2.layouts.master')

<?php $title = "Sản phẩm mới vòi vệ sinh cao cấp"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			<img class="img-responsive" src='<% asset_url("frontend/img/phankhang-san-pham-moi-2016.png") %>' alt="voi ve sinh cao cap watertec 2016">
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>


@stop
