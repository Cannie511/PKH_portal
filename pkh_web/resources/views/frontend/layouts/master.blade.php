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
		<link rel="stylesheet" href='<% asset_url("frontend/css/vendors.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/css/app.css") %>'>
		<script type="text/javascript" src='<% asset_url("frontend/js/vendors.js") %>'></script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		@show

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
    	
    	@include('frontend.partials.header')

    	@include('frontend.partials.nav')
		
		<div id="main">
    		@yield('content')
    	</div>

    	@include('frontend.partials.footer')

		@yield('pagescript')

    </body>
</html>