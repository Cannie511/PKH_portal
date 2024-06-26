<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="Content-Type" content="text/html;charset=Utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		 <meta name="csrf-token" content="{{ csrf_token() }}" />
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

		<!-- <link rel="stylesheet" href='<% asset_url("frontend/theme/css/normalize.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/bootstrap.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/animate.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/error.css") %>'>
		<link rel="stylesheet" href='//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/template.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/vm/allvmscripts.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/vm/virtuemart.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/facebox.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/chosen.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/print.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/libs/slideshowck/css/camera.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/libs/bootstrapmegamenu/css/slicknav.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/libs/bootstrapmegamenu/css/superfish.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/libs/socialmedialinksstyle/css/style.css") %>'>
		<link rel="stylesheet" href='<% asset_url("frontend/theme/css/site.css") %>'> -->
		
		<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
		<link rel="stylesheet" href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

		@show

		<script type="text/javascript">
			var animate =  '1';
		</script>


		<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.min.js") %>'></script>
		<!--<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery-noconflict.js") %>'></script>-->
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.rd-parallax.js") %>'></script>
		<!--<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.ui.core.min.js") %>'></script>-->
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.validate.min.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery-migrate.min.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/additional-methods.min.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/bootstrap.min.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/chosen.jquery.min.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/caption.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/mootools-core.js") %>'></script>
		
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/bootstrapmegamenu/js/superfish.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/bootstrapmegamenu/js/hoverIntent.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/bootstrapmegamenu/js/sftouchscreen.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/bootstrapmegamenu/js/jquery.slicknav.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/slideshowck/js/jquery.easing.1.3.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/libs/slideshowck/js/camera.min.js") %>'></script>

		<script type="text/javascript" src='<% asset_url("frontend/theme/js/scripts.js") %>'></script>
		<!--<script type="text/javascript" src='<% asset_url("frontend/theme/js/scrollUp.min.js") %>'></script>-->
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/template.js") %>'></script>
		<!--<script type="text/javascript" src='<% asset_url("frontend/theme/js/tm-stick-up.js") %>'></script>-->

		<script type="text/javascript" src='<% asset_url("frontend/theme/js/core.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/punycode.js") %>'></script>
		<script type="text/javascript" src='<% asset_url("frontend/theme/js/validate.js") %>'></script>


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

		<div class="wrapper">
			@include('frontend.theme1.partials.top')
			
			<div class="boxed-layout">
				<div id="wrapper" class="z-index">
					<div class="cotainer-top">
						
						@include('frontend.theme1.partials.header')
						
						@include('frontend.theme1.partials.nav')

						<div class="content-box">
							<!--<div id="custom-html">
								<div class="container">
								</div>
							</div>-->
							<!-- Main row -->
							<div class="main-row">
								@yield('content')
							</div>
						</div>

					</div>
					
					@include('frontend.theme1.partials.footer')

				</div>
				<div id="totopscroller"></div>
				<!--<div class="chat-position">
					<div class="moduletable  mod_olark_chat">
						<div class="module_content">
							<script data-cfasync="false" type="text/javascript">/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
								f[z]=function(){
								(a.s=a.s||[]).push(arguments)};var a=f[z]._={
								},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
								f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
								0:+new Date};a.P=function(u){
								a.p[u]=new Date-a.p[0]};function s(){
								a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
								hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
								return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
								b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
								b.contentWindow[g].open()}catch(w){
								c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
								var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
								b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
								loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
								/* custom configuration goes here (www.olark.com/documentation) */
								olark.identify('5615-604-10-1042');/*]]>*/
							</script>
							<noscript>&lt;a href="https://www.olark.com/site/5615-604-10-1042/contact" title="Contact us" target="_blank"&gt;Questions? Feedback?&lt;/a&gt; powered by &lt;a href="https://www.olark.com?welcome" title="Olark live chat software"&gt;Olark live chat software&lt;/a&gt;</noscript>
						</div>
					</div>
				</div>-->
			</div>
			<script type="text/javascript" src='<% asset_url("frontend/theme/js/jquery.ui.core.min.js") %>'></script>
			<script type="text/javascript" src='<% asset_url("frontend/theme/js/tm-stick-up.js") %>'></script>
			<script type="text/javascript" src='<% asset_url("frontend/theme/js/scrollUp.min.js") %>'></script>
			<script type="text/javascript" src='<% asset_url("frontend/theme/js/vm/scriptsAll.js") %>'></script>
			<script type="text/javascript" src='<% asset_url("frontend/theme/js/animate/wow.js") %>'></script>
			<!--<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/jquery.ui.core.min.js"></script>-->
			<!--<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/jquery.ui.core.min.js"></script>-->
			<!--<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/tm-stick-up.js"></script>
				<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/scrollUp.min.js"></script>
				<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/vm/scriptsAll.js"></script>
						<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/animate/wow.js"></script>
				
				<script type="text/javascript" src="/virtuemart_53948/templates/theme589/js/scripts.js"></script>-->
		</div>

		@yield('pagescript')

		@include('frontend.theme2.partials.facebook')

    </body>
</html>