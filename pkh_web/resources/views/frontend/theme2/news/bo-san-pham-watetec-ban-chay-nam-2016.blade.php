@extends('frontend.theme2.layouts.master')

<?php $title = "Bộ sản phẩm Watertec bán chạy năm 2016"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			<img class="img-responsive" src='<% asset_url("frontend/img/watertec-san-pham-ban-chay-2016.jpg") %>' alt="san pham watertect ban chay nam 2016">
		</div>

		<div class="row hide" style="visibility:hidden">
			Bộ sản phẩm watertec bán chạy năm 2016
			<ul>
				<li><small>WT001W-6HSVSTR-1</small>Dây tay sen 301 (Trắng)<strong>70.000 VND</strong></li>
				<li><small>WT001Q-6HBVXTR-1</small>Dây xịt vệ sinh Vitus 301 (Trắng)<strong>63.000 VND</strong></li>
				<li><small>WT001I-6L0VHTR-1</small>Vòi hộ Zemart L501 (Trắng)<strong>14.000 VND</strong></li>
				<li><small>WT001Y-6HSPDTR-1</small>Dây cấp PVC 4 tấc (Trắng)<strong>23.000 VND</strong></li>
				<li><small>WT001E-6K2V3TR-6</small>Van RA2T K601B (Trắng)<strong>35.000 VND</strong></li>
				<li><small>WT0018-6QUVCRT-6</small>Vòi rửa chén Pillar Q203 (Trắng)<strong>98.000 VND</strong></li>
				<li><small>WT0003-6QUVLTR-6</small>Vòi lavabo Pillar Q201 (Trắng)<strong>61.000 VND</strong></li>
			</ul>
		</div>

	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
