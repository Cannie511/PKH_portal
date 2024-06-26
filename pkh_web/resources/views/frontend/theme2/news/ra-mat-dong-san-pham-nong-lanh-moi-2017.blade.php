@extends('frontend.theme2.layouts.master')

<?php $title = "Ra mắt dòng sản phẩm nóng lạnh mới 2017"; ?>

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
				Phan Khang Home - các đại lý waterTec trên toàn quốc vui lòng đón đọc thông tin về sản phẩm mới nong lanh trên Báo tuổi trẻ Thứ 3(28/2/2017) nhằm có thêm hình ảnh hỗ trợ cho việc kinh doanh của cửa hàng mình. Trân trọng thông báo
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/ra-mat-dong-san-pham-nong-lanh-moi-2017_design.jpg") %>' alt="ra-mat-dong-san-pham-nong-lanh-moi-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/ra-mat-dong-san-pham-nong-lanh-moi-2017.jpg") %>' alt="ra-mat-dong-san-pham-nong-lanh-moi-2017" style="margin:auto">
			</p>

			<p class="text-right">
				<i>(Tuổi Trẻ ngày 28/02/2017)</i>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
