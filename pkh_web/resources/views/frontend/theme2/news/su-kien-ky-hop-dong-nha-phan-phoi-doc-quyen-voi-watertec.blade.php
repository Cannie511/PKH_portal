@extends('frontend.theme2.layouts.master')

<?php $title = "Sự kiện ký hợp đồng nhà phân phối độc quyền với Watertec"; ?>

@section('title')Tin tức | <?php echo $title; ?> @stop
@section('description') Phan Khang Home ký hợp đồng nhà phân phối độc quyền tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước, độc quyền @stop

@section('news-title') <?php echo $title; ?> @stop

@section('pageHead')
<style type="text/css">
img {
    margin: auto;
}
</style>
@stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">

	<div class="row news-detail">
		<div class="col-md-12">
			<p>Lời đầu tiên cho phép chúng tôi – Công ty TNHH PHAN KHANG HOME (PKH) được gửi tới Ban Giám Đốc Nhà Máy Watertec đã dành thời gian quý báu để đến làm việc tại văn phòng &amp; showroom trong chuyến viếng thăm trong tháng 12 vừa qua! </p>
			
			<blockquote>
				-	Một buổi ký kết &amp; bàn giao hợp đồng độc quyền tận tay sau khi đã thông cáo báo chí và xác nhận trước đó trong không khí nhẹ nhàng & ấm áp từ những sự giản đơn! 
			</blockquote>
			<p>
			Chúng tôi tự hào vì được trở thành nhà phân phối độc quyền của Watertec tại Việt Nam – Đó cũng là một sự vinh dự!
			</p>

			<!-- <p class="text-center">
				<img class="img-responsive img-news img-news-center " src='<% asset_url("frontend/img/phan-khang-home-don-tiep-doan-vieng-tham-watertec-2.jpg") %>' alt="phan khang home don tiep doan vieng tham cua ban giam doc watertec">
			</p> -->
					
			<blockquote>
				-	Một buổi đào tạo &amp; chia sẻ từ Tổng Giám Đốc của nhà máy với nhân viên PKH diễn ra trong không khí đầm ấm &amp; thân thiện với thông điệp gửi gắm từ slogan của nhà máy Simply Better để định hình trong cách suy nghĩ, cách làm &amp; kiểm chứng của mỗi thành viên PKH từ những bước nhỏ như cách mà Tổng Giám Đốc nhà máy đã thực hiện cách đó hơn 30 năm.
			</blockquote>
			<p>
			Chúng tôi trân trọng vì được chia sẻ & học hỏi những điều vô giá đó từ một đối tác – một nhà máy sản xuất vòi nhựa lớn nhất thế giới tính đến thời điểm hiện tại! 
			</p>
			<!-- <p class="text-center">
			<img class="img-responsive img-news img-news-center " src='<% asset_url("frontend/img/watertec-phan-khang-home-giai-dap-thac-mac.jpg") %>' alt="watertec phan khang home giai dap thac mac ve san pham">
			</p> -->
			<blockquote>
				-	Một buổi giải đáp thắc mắc về sản phẩm dành cho các nhà phân phối đã đến và làm việc với PKH từ buổi ban đầu được đích thân Tổng Giám Đốc nhà máy Watertec thực hiện.
			</blockquote>
			<p>
			Chúng tôi tri ân vì được hỗ trợ giải đáp các vấn đề thắc mắc của nhà máy ở buổi ban đầu – PKH vẫn còn nhiều thiết sót trong việc theo đuổi kim chỉ nam hành động đem sản phẩm & dịch vụ chính hãng chất lượng đến cho nhà phân phối & khách hàng sử dụng hàng Watertec như slogan của công ty Quality Talks
			</p>
			<p>
			Sự trân trọng & tri ân của Phan Khang Home dành cho đối tác và khách hàng vẫn vậy! 
			</p>
			<p>
			Hãy đến với chúng tôi để cùng nhau tạo một sự khác biệt!
			</p>
			<p>
				Mọi thông tin chi tiết vui lòng liên hệ: 
				<div class="cwell">
					<!-- Address section -->
					<div class="address">
						<address>
							<!-- Company name -->
							<h5>Cty TNHH Phan Khang Home</h5>
							<!-- Address -->
							<span>63 Đường 30, P. Tân Phong, Quận 7, Tp.HCM</span>
							<br>
							<!-- Phone number -->
							<abbr title="Phone"><i class="fa fa-phone fa-fw"></i></abbr> <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="02854333716" href="tel:02854333716">(+84)2854-333-716</a>
							<!-- Phone number -->
							<abbr title="Hotline"><i class="fa fa-mobile fa-fw"></i></abbr><a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a>
							<!-- Phone number -->
							<abbr title="Hotline"><i class="fa fa-envelope-o fa-fw"></i></abbr><a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="info@phankhangco.com"  href="mailto://info@phankhangco.com">info@phankhangco.com</a>
						</address>
					</div>
				</div>
			</p>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
