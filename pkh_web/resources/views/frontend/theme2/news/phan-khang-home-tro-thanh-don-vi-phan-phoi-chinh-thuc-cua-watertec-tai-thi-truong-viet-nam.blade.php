@extends('frontend.theme2.layouts.master')

<?php $title = "Phan Khang Home trở thành đơn vị phân phối chính thức của WATERTEC tại thị trường Việt Nam"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') <?php echo $title; ?> @stop
@section('keywords') Watertec, van nước, vòi nước, van nhua watetec, voi nhua watertec @stop

@section('news-title') <?php echo $title; ?> @stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			
			<p class="text-center">
				<img class="img-responsive" src='<% asset_url("frontend/img/tin-tuc-phan-phoi-watertec.jpg") %>' alt="Phan Khang Home phan phoi doc quyen watertec">
			</p>
			<p>
				Với kim chỉ nam hành động đem sản phẩm &amp; dịch vụ chính hãng chất lượng, Công ty Phan Khang Home đồng hành cùng đối tác chiến lược công ty Watertec – Malaysia để phân phối độc quyền dòng sản phẩm của Watertec với
			</p>
			<ol>
				<li>Sản phẩm van, vòi bằng nhựa chính hãng đạt chất lượng cao được sản xuất tại Malaysia với cam kết bảo hành từ 1 đến 10 năm.</li>
				<li>Dịch vụ hỗ trợ bán hàng chuyên nghiệp dành cho các đối tác phân phối tại Việt Nam để đem đến
	cho người tiêu dùng Việt những sản phẩm van, vòi chất lượng, được minh chứng từ hơn 10 năm
	qua tại thị trường nước nhà.</li>
				<li>Dịch vụ hỗ trợ sau bán hàng theo phương châm tận tâm chuyên nghiệp để đáp ứng nhu cầu
	ngày càng cao của người tiêu dùng Việt khi không còn gói trọn trong phạm vi sản phẩm, mà còn
	là dịch vụ cung cấp từ nhà phân phối. Phan Khang Home tự tin để đáp ứng nhu cầu hiện tại &amp;
	mong muốn đáp ứng cả nhu cầu tương lai khi tiêu chí liên tục cải tiến chất lượng sản phẩm &amp;
	dịch vụ được xác định là yếu tố hàng đầu trong tầm nhìn kinh doanh của một doanh nghiệp.</li>
			</ol>
			<p>
				Vì vậy, sự kiện Phan Khang Home trở thành nhà phân phối độc quyền sản phẩm Watertec tại thị trường
	Việt Nam (thông tin được công bố rộng rãi khắp cả nước trên báo Tuổi Trẻ - số ra ngày 09/11/2016)
	được xem như lời chào đầu của công ty Phan Khang Home dành cho các đối tác phân phối trong nước và
	khách hàng Việt – những con người đang đi tìm sự uy tín &amp; tin cậy từ một đối tác hay công ty trên thị
	trường nội địa.
			</p>
			<p class="text-center">
				<img class="img-responsive" style="margin: 5px auto" src='<% asset_url("frontend/img/tuoi-tre-phan-phoi-doc-quyen-watertec.jpg") %>' alt="Báo tuổi trẻ Phan Khang Home trở thành nhà phân phối độc quyền WATERTEC tại Việt Nam" />
				<br/>
				<small>Báo tuổi trẻ ngày 9/11/2016 - Phan Khang Home trở thành nhà phân phối độc quyền WATERTEC tại Việt Nam</small>
			</p>
			<strong><i>Hãy để chất lượng lên tiếng!</i></strong>
			<p class="text-right">
				<i>(Tuổi Trẻ ngày 09/11/2016)</i>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>



	

@stop
