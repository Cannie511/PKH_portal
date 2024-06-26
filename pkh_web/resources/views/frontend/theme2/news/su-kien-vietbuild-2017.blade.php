@extends('frontend.theme2.layouts.master')

<?php $title = "Sự kiện Vietbuild 2017"; ?>

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
				WaterTec Vietnam- đại diện bởi công ty Phan Khang Home, mong gặp quý đại lý ở Vietbuild 2017 - tại gian hàng số 2415, 2416 hội trường A5 ( bên phải lối vào) của Trung tâm hội chợ &amp; Triển lãm SECC, 799 Nguyễn Văn Linh, phường Tân Phú,quận 7 HCM. từ ngày 23/6 - 27/06/2017 . Giờ mở cửa 8h30-19h00.
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/su-kien-vietbuild-2017-gian-hang.jpg") %>' alt="su-kien-vietbuild-2017-gian-hang" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/su-kien-vietbuild-2017-so-do.jpg") %>' alt="su-kien-vietbuild-2017-so-do" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>


@stop
