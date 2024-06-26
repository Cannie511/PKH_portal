@extends('frontend.theme2.layouts.master')

<?php $title = "Dòng sản phẩm mới nóng lạnh Mixer"; ?>

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
				Các đại lý vui lòng đón đọc Dòng sản phẩm mới nóng lạnh Mixer trên báo tuổi trẻ thứ 5 (8/6/2017). 
			</p>
			<p>
			WaterTec Vietnam- đại diện bởi công ty Phan Khang Home, sẽ hứa hẹn đem lại các dòng sản phẩm mới Katana, Mixer nóng lạnh, dòng mạ Chrome với thiết kế độc đáo, tinh tế, giá thành cạnh tranh. 
			PKH mong gặp quý Đại lý ở Vietbuild 2017 - tại vị trí số 2415, 2416 hội trường A5 ( bên phải lối vào) của Trung tâm hội chợ và Triển lãm Sài Gòn SECC, 799 Nguyễn Văn Linh, phường Tân Phú, quận 7, HCM. 
			</p>
			<p>
			Thời gian từ 8:30- 19:00 ngày 23/6-27/6/2017
			</p>			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/dong-san-pham-moi-nong-lanh-mixer.jpg") %>' alt="dong-san-pham-moi-nong-lanh-mixer" style="margin:auto">
				<img class="img-responsive" src='<% asset_url("frontend/img/news/su-kien-vietbuild-2017-gian-hang_2.jpg") %>' alt="su-kien-vietbuild-2017-so-do" style="margin:auto">
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
