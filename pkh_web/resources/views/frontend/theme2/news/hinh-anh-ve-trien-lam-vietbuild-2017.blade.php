@extends('frontend.theme2.layouts.master')

<?php $title = "Hình ảnh về triển lãm Vietbuild 2017"; ?>

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
				Triển lãm Vietbuild đã kết thúc tốt đẹp ngày 27.6.2017. WaterTec vietnam- đại diện bởi cty Phan Khang Home xin chân thành cảm ơn tất cả các quý Đại lý đã dành thời gian đến tham quan gian hàng, chia sẻ, hợp tác với công ty. Kính chúc các Đại lý công việc kinh doanh phát triển như ý , gặt hái thành công và thật nhiều may mắn. Trân trọng.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/1.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/2.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/3.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/4.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/5.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/6.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/7.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/8.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/9.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/10.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/11.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/12.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/vietbuild_2017/13.jpg") %>' alt="hinh-anh-ve-trien-lam-vietbuild-2017" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
