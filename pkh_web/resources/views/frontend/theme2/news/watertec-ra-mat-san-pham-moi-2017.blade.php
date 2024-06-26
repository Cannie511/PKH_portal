@extends('frontend.theme2.layouts.master')

<?php $title = "Watertec ra mắt sản phẩm mới 2017"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			<img class="img-responsive" src='<% asset_url("frontend/img/watertec-ra-mat-san-pham-moi-2017.jpg") %>' alt="Watertec ra mắt sản phẩm mới 2017">
		</div>
	</div>

	<div class="row hide">
		Watertec ra mắt sản phẩm mới 2017
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
