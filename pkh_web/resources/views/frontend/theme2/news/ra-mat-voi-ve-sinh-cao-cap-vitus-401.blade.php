@extends('frontend.theme2.layouts.master')

<?php $title = "Watertec ra mắt vòi vệ sinh cao cấp Vitus 401"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			<img class="img-responsive" src='<% asset_url("frontend/img/watertec-voi-ve-sinh-cao-cap-vitus-401.jpg") %>' alt="watertec ra mat voi ve sinh cap cap vitus 401">
		</div>
	</div>

	<div class="row" style="visibility:hidden">
		Vòi xịt vệ sinh cao cấp Vitus 401
		<ul>
			<li><small>WT002H-6HBVXTX-1</small>Dây xịt vệ sinh Vitus 401 (Trắng + Xám)<strong>70.000 VND</strong></li>
			<li><small>WT002C-6HBVXXD-1</small>Dây xịt vệ sinh Vitus 401 (Xanh biển)<strong>80.000 VND</strong></li>
			<li><small>WT002B-6HBVXKE-1</small>Dây xịt vệ sinh Vitus 401 (Kem)<strong>80.000 VND</strong></li>
			<li><small>WT002D-6HBVXXL-1</small>Dây xịt vệ sinh Vitus 401 (Xanh lá)<strong>80.000 VND</strong></li>
		</ul>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
