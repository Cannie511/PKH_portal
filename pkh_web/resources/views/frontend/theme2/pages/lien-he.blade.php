@extends('frontend.theme2.layouts.master')

@section('title')Về chúng tôi @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead')
<style type="text/css">
.gmap {
    width: 100%;
    padding: 8px 8px 0;
    background: #fff;
    box-shadow: 0 0 2px #aaa;
    border-radius: 5px;
    margin-bottom: 20px;
}
</style>
@stop

@section('content')

<div class="container">
    <div class="main contact-page">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable   mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li class="active">Liên hệ</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="gmap">
                                    <div id='map' style="width: 100%; height: 450px;"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Load form -->
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="contact_form">
                                    <?php if (isset($sended) && $sended == '1'): ?>
                                        <div class="alert alert-success" role="alert">
                                            Cảm ơn bạn đã liên hệ với chúng tôi. Thông tin của bạn đã được gửi đến người phụ trách. Chúng tôi sẽ liên hệ với bạn trong thời gian ngắn nhất.
                                        </div>
                                    <?php endif; ?>

                                    <form id="contact-form" action='<% url("/lien-he") %>' method="post" class="form-validate">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="hasTooltip required" title="Nhập tên bạn">
                                                        Tên<span class="star">&#160;*</span></label>					
                                                        <input type="text" name="name" value="" class="required" size="30" required aria-required="true" />				
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="hasTooltip required" title="Nhập địa chỉ mail">
                                                        Email<span class="star">&#160;*</span></label>					
                                                        <input type="email" name="email" value="" class="required" size="30" required aria-required="true" />				
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="hasTooltip required" title="Nhập số điện thoại">
                                                        Điện thoại<span class="star">&#160;*</span></label>					
                                                        <input type="text" name="tel" value="" class="required" size="30" required aria-required="true" />				
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label id="jform_contact_message-lbl" for="jform_contact_message" class="hasTooltip required" title="&lt;strong&gt;Message&lt;/strong&gt;&lt;br /&gt;Enter your message here.">
                                                    Nội dung<span class="star">&#160;*</span></label>					
                                                    <textarea name="content" cols="50" rows="10" class="required" required aria-required="true" ></textarea>				
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group1">
                                        </div>
                                        <div class="row text-right">
                                            <div class="col-md-12">
                                                <button class="btn btn-detail validate" type="submit">Gửi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <h5 class="text-center">Cty TNHH Phan Khang Home</h5>
                                <!-- Load address -->
                                <div class="contact_address">
                                    <!--<span class="jicons-icons" >
                                    <img src="/virtuemart_53948/media/contacts/images/con_address.png" alt="Address: " />		</span>-->
                                    <address>
                                        <!-- Address -->
                                        <p class="text-center">63 Đường 30, P. Tân Phong, Quận 7, Tp.HCM</p>
                                        <!-- Phone number -->
                                        <p><abbr title="Phone"><i class="fa fa-phone fa-fw"></i></abbr> <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="02854333716" href="tel:02854333716">(+84)2854-333-716</a></p>
                                        <!-- Hot line -->
                                        <p><abbr title="Hot Line"><i class="fa fa-mobile fa-fw"></i></abbr> <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a></p>
                                        <!-- Fax -->
                                        <p><abbr title="FAX"><i class="fa fa-fax fa-fw"></i></abbr> <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="054333715" href="tel:0906610116">(+84)54-333-715</a></p>
                                        <!-- Email -->
                                        <p><abbr title="Email"><i class="fa fa-envelope-o fa-fw"></i></abbr> <a class="btn-ga" ga-cat="contact" ga-action="mail" ga-label="info@phankhangco.com"  href="mailto://info@phankhangco.com">info@phankhangco.com</a></p>
                                    </address>
                                </div>
                                <div class="contact_contactinfo">
                                    <h5 class="text-center">Thời gian làm việc</h5>
                                    <div class="address">
                                        <span>Thứ Hai - Thứ Sáu : từ 08:00 đến 17:00</span> <br/>
                                        <span>Thứ Bảy : từ 08:00 đến 12:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('pagescript')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;language=vi&key=<% env('GOOGLE_MAP_KEY')%>"></script>
<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.validate.min.js") %>'></script>
<script type="text/javascript" src='<% asset_url("frontend/theme/js/validate.js") %>'></script>

<script type="text/javascript">
	
function initMap() {
	var lat = 10.737462;
	var lng = 106.711953;
	var pos = new google.maps.LatLng(lat, lng);

	var map 	= new google.maps.Map(document.getElementById('map'), {
		center: pos,
		zoom: 17,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapMaker: true
	});
	var marker 	= new google.maps.Marker({
		position: pos,
		map: map,
		title: 'PhanKhangCo Co., Ltd'
	});

	var content = '<div style="font-weight: bold; color: black;">Cty TNHH Phan Khang Home</div>'
		+ '<div style="color: black;">63 Đường 30, P. Tân Phong, Quận 7, Hồ Chí Minh</div>'
		+ '<a href="http://www.phankhangco.com" alt="Cty TNHH Phan Khang Home">www.phankhangco.com</a>';

	var infoWindowOpts = {
		disableAutoPan : true,
		content: content
	};
	var infowin = new google.maps.InfoWindow(infoWindowOpts);
	infowin.open(map, marker);
}

jQuery(function(){
	google.maps.event.addDomListener(window, 'load', initMap);

	jQuery("#formContact").submit(function(event) {
		var isError = false;

		if( !isValidText($('#name').val()) ) {
			isError = true;
			alert('Vui lòng nhập tên');
			jQuery('#name').focus();
		} else if( !isValidText($('#email').val()) ) {
			isError = true;
			alert('Vui lòng nhập email');
			jQuery('#email').focus();
		} else if( !isValidText($('#content').val()) ) {
			isError = true;
			alert('Vui lòng nhập nội dung');
			jQuery('#content').focus();
		}

		if (isError) {
			event.preventDefault();
			return false;
		}

		return true;
	});

	function isValidText(value) {
		if( value === undefined || value === null || value === '' ) {
			return false;
		}

		return true;
	}
});	

</script>

@stop