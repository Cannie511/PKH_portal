<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="Content-Type" content="text/html;charset=Utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<title>Phan Khang Home Co | @yield('title')</title>
		<meta name="description" content="@yield('description')"/>
		<meta name="keywords" content="@yield('keywords')"/>
		<meta name="robots" content="index,follow,noodp,noydir">
		<meta name="copyright" content="Copyright(c) 2016 PhanKhang Home Co., Ltd. All rights reserved.">
		
		@section('head')
				
		<link rel="shortcut icon" type="image/x-icon" href='<% asset_url("frontend/img/favicon.png") %>' /> 
		<!--<link rel="stylesheet" href='<% asset_url("frontend/css/vendors.css") %>'>-->
		<!--<link rel="stylesheet" href='<% asset_url("frontend/css/app.css") %>'>-->
		<!--<script type="text/javascript" src='<% asset_url("frontend/js/vendors.js") %>'></script>-->
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
		<link rel="stylesheet" href='//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme2/css/theme.css?".ah_js_version()) %>'>

		@show

		<script
			src="//code.jquery.com/jquery-3.4.1.min.js"
			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			crossorigin="anonymous"></script>
		<!-- <script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<!-- <script type="text/javascript" src='<% asset_url("frontend/theme2/js/davidshimjs/qrcode.min.js") %>'></script> -->
		<script type="text/javascript" src='<% asset_url("frontend/theme2/js/EasyQRCodeJS/dist/easy.qrcode.min.js") %>'></script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', '[[env("GOOGLE_ANALYTIC_CODE", "LOCAL-CODE")]]', 'auto');
		  ga('send', 'pageview');

		  $(".btn-ga").on('click', function() {
		  		//var e = $(this).attr('ga-event');
		  		var c = $(this).attr('ga-cat');
		  		var a = $(this).attr('ga-action');
		  		var l = $(this).attr('ga-label');
			  	ga('send', {
				  hitType: 'event',
				  eventCategory: c,
				  eventAction: a,
				  eventLabel: l
				});
		  });

		</script>

		@yield('pageHead')
		
	</head>

    <body oncontextmenu="return false" @yield('bodyAttr')>

		@include('frontend.theme2.partials.top')
    	
    	@yield('content')

		@include('frontend.theme2.partials.footer')
		<script type="text/javascript" src='<% asset_url("frontend/theme2/js/common.js?".ah_js_version()) %>'></script>

		@yield('pagescript')

		@include('frontend.theme2.partials.facebook')
		@include('frontend.theme2.partials.zalo')

    </body>
</html>