<div class="social-links">
  <div class="container">
    <div class="row hidden-xs">
      <div class="col-md-12" >
        <p><span>Follow Us On</span> 
        	<a target="_blank" href="https://www.facebook.com/profile.php?id=100013954690613"><i class="fa fa-facebook"></i>Facebook</a>
        	<!-- <a href="#"><i class="fa fa-twitter"></i>Twitter</a>
        	<a href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
        	<a href="#"><i class="fa fa-linkedin"></i>LinkedIn</a> --></p>
      </div>
    </div>    
    <div class="row visible-xs">
    	<div class="col-xs-12" ><span>Follow Us On</span></div>
    	<div class="col-xs-6" ><a target="_blank" href="https://www.facebook.com/profile.php?id=100013954690613"><i class="fa fa-facebook"></i>Facebook</a></div>
    	<!-- <div class="col-xs-6" ><a href="#"><i class="fa fa-twitter"></i>Twitter</a></div>
    	<div class="col-xs-6" ><a href="#"><i class="fa fa-google-plus"></i>Google Plus</a></div>
    	<div class="col-xs-6" ><a href="#"><i class="fa fa-linkedin"></i>LinkedIn</a></p></div> -->
    </div>
  </div>
</div>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			<!-- Widget 1 -->
			<div class="widget">
				<h5><strong>NHÀ PHÂN PHỐI ĐỘC QUYỀN TẠI VIỆT NAM</strong></h5>
				<a target="_blank" href="http://watertec.biz/vn/contact.htm">
					<img class="img-responsive" src='<% asset_url("/frontend/img/logo_watertec.png")%>' alt="WATERTEC">
				</a>
			</div>
		</div>
		<div class="col-md-4">
		 <!-- widget 2 -->
		 <div class="widget">
			<h4>TIN TỨC</h4>
			<?php
			$listNews = ah_news_list(6);
			?>
			<?php if(!empty($listNews)): ?>
			<ul class="list-unstyled list-news">
				<?php foreach($listNews as $news): ?>
					<li><i class="fa fa-angle-right"></i> <a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a></li>
				<?php endforeach; ?>
		  </ul>
			<?php endif; ?>
		 </div>
	  </div>
	  <div class="col-md-4">
		 <!-- Widget 3 -->
		 <div class="widget">
			<h4>DANH MỤC SẢN PHẨM</h4>
			<ul class="list-unstyled list-inline">
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="bo-van-voi" href='[[url("/danh-muc-san-pham#WT00B")]]'>Bộ van vòi</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="day-cap" href='[[url("/danh-muc-san-pham#WT005")]]'>Dây cấp</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="tay-sen-tam" href='[[url("/danh-muc-san-pham#WT004")]]'>Tay sen tắm</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="van-khoa" href='[[url("/danh-muc-san-pham#WT00A")]]'>Van khóa</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="voi-ho" href='[[url("/danh-muc-san-pham#WT002")]]'>Vòi hồ</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="voi-lavabo" href='[[url("/danh-muc-san-pham#WT001")]]'>Vòi Lavabo</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="voi-rua" href='[[url("/danh-muc-san-pham#WT00C")]]'>Vòi rửa chén âm tường</a></li>
			   <li><i class="fa fa-angle-right"></i> <a class="btn-ga" ga-cat="product" ga-action="click" ga-label="voi-xit-ve-sinh" href='[[url("/danh-muc-san-pham#WT003")]]'>Vòi xịt vệ sinh</a></li>
			</ul>
		 </div>
	  </div>
	 </div>
	 <div class="row">
	  <hr />
	  <div class="col-md-12"><p class="copy pull-left">
			   Copyright &copy; Phan Khang Co., Ltd | Powered by <a href="http://ecreation.vn" target="_blank">eCreation JSC</a></p></div>
	</div>
  </div>
</footer>