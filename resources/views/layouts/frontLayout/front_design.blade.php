<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>molelon.uz</title>
        <meta name="description" content="molelon.uz - qishloq xo‘jaligi hayvonlarini sotish va sotib olish.">
        <meta name="keywords" content="mollar, sotish, olish, qo'ylar, echkilar">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="siCXL9czS7AXMeptA-1WQ4f9cnyJv5zGCOOjZzctQIQ" />
        <meta property="og:title" content="molelon.uz">
        <meta property="og:description" content="molelon.uz - qishloq xo‘jaligi hayvonlarini sotish va sotib olish.">
        <meta property="og:image" content="{{ asset('images/frontend_images/favicon.png') }}"/>
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://molelon.uz/">
        <meta property="og:site_name" content="molelon.uz">
        
        <!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/frontend_images/favicon.png') }}">
		
		<!-- Fonts
		============================================ -->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,600,500,300,800,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,300,300italic,500italic,700' rel='stylesheet' type='text/css'>

 		<!-- CSS  -->
		
		<!-- Bootstrap CSS
		============================================ -->      
        <link href="{{ asset('css/frontend_css/bootstrap.min.css') }}" rel="stylesheet">
        
		<!-- font-awesome.min CSS
		============================================ -->      
        <link href="{{ asset('css/frontend_css/font-awesome.min.css') }}" rel="stylesheet">
		
		<!-- Mean Menu CSS
		============================================ -->      
        <link rel="stylesheet" href="{{ asset('css/frontend_css/meanmenu.min.css') }}">
        
		<!-- owl.carousel CSS
		============================================ -->      
        <link rel="stylesheet" href="{{ asset('css/frontend_css/owl.carousel.css') }}">
        
		<!-- owl.theme CSS
		============================================ -->      
        <link rel="stylesheet" href="{{ asset('css/frontend_css/owl.theme.css') }}">
  	
		<!-- owl.transitions CSS
		============================================ -->      
        <link rel="stylesheet" href="{{ asset('css/frontend_css/owl.transitions.css') }}">
		
		<!-- Price Filter CSS
		============================================ --> 
        <link rel="stylesheet" href="{{ asset('css/frontend_css/jquery-ui.min.css') }}">	

		<!-- nivo-slider css
		============================================ --> 
		<link rel="stylesheet" href="{{ asset('css/frontend_css/nivo-slider.css') }}">
        
 		<!-- animate CSS
		============================================ -->         
        <link rel="stylesheet" href="{{ asset('css/frontend_css/animate.css') }}">
		
		<!-- jquery-ui-slider CSS
		============================================ --> 
		<link rel="stylesheet" href="{{ asset('css/frontend_css/jquery-ui-slider.css') }}">
        
 		<!-- normalize CSS
		============================================ -->        
        <link rel="stylesheet" href="{{ asset('css/frontend_css/normalize.css') }}">
   
        <!-- main CSS
		============================================ -->          
        <link rel="stylesheet" href="{{ asset('css/frontend_css/main.css') }}">
        
        <!-- style CSS
		============================================ -->          
        <link rel="stylesheet" href="{{ asset('css/frontend_css/style.css') }}">
        
        <!-- responsive CSS
		============================================ -->          
        <link rel="stylesheet" href="{{ asset('css/frontend_css/responsive.css') }}">

        <link href="{{ asset('css/frontend_css/passtrength.css') }}" rel="stylesheet">
        
        <script src="{{ asset('js/frontend_js/vendor/modernizr-2.8.3.min.js') }}"></script>
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TRZ35GQ');</script>
        <!-- End Google Tag Manager -->

    </head>
    <body class="home-one">
        
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRZ35GQ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
               
        @include('layouts.frontLayout.front_header')

        @yield('content')

		@include('layouts.frontLayout.front_footer')
        <!-- JS -->
        
 		<!-- jquery-1.11.3.min js
		============================================ -->  
		<script src="{{ asset('js/frontend_js/jquery.js') }}"></script>       
        <script src="{{ asset('js/frontend_js/vendor/jquery-1.11.3.min.js') }}"></script>
        
 		<!-- bootstrap js
		============================================ -->         
        <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
		
		<!-- nivo slider js
		============================================ --> 
		<script src="{{ asset('js/frontend_js/jquery.nivo.slider.pack.js') }}"></script>
        
 		<!-- Mean Menu js
		============================================ -->         
        <script src="{{ asset('js/frontend_js/jquery.meanmenu.min.js') }}"></script>
        
   		<!-- owl.carousel.min js
		============================================ -->       
        <script src="{{ asset('js/frontend_js/owl.carousel.min.js') }}"></script>
		
		<!-- jquery price slider js
		============================================ --> 		
		<script src="{{ asset('js/frontend_js/jquery-price-slider.js') }}"></script>
		
		<!-- wow.js
		============================================ -->
        <script src="{{ asset('js/frontend_js/wow.js') }}"></script>		
		<script>
			new WOW().init();
		</script>
        
   		<!-- plugins js
		============================================ -->         
        <script src="{{ asset('js/frontend_js/plugins.js') }}"></script>
		
   		<!-- main js
		============================================ -->           
        <script src="{{ asset('js/frontend_js/main.js') }}"></script>
        <script src="{{ asset('js/frontend_js/mains.js') }}"></script>

        <script src="{{ asset('js/frontend_js/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/frontend_js/passtrength.js') }}"></script>
    </body>
</html>
