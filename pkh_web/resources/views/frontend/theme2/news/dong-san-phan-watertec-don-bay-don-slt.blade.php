@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm Watertec đòn bẩy đơn SLT"; ?>

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
				Phan Khang Home- các đại lý WaterTec trên toàn quốc vui lòng đón đọc thông tin sản phẩm mới về dòng Vòi tay bẩy đơn SLT trên báo Tuổi Trẻ hôm nay thứ Năm (16/3/2017) để có thêm hình ảnh hỗ trợ việc kinh doanh của cửa hàng mình. Trân trọng thông báo.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-phan-watertec-don-bay-don-slt.jpg") %>' alt="dong-san-phan-watertec-don-bay-don-slt" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-phan-watertec-don-bay-don-slt-2.jpg") %>' alt="dong-san-phan-watertec-don-bay-don-slt-2" style="margin:auto">
			</p>

			<p class="text-right">
				<i>(Tuổi Trẻ ngày 16/03/2017)</i>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
