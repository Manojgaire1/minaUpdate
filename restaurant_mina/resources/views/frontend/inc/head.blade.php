<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
		<title>@yield('page_name')</title>
		
		<link href="{{asset('/front-assets/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet"/>
		<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
		<link href="{{asset('/front-assets/css/slick.css')}}" type="text/css" rel="stylesheet"/>
		<link href="{{asset('/front-assets/css/slick-theme.css')}}" type="text/css" rel="stylesheet"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css" rel="stylesheet"/>
		<!-- <link href="assets/css/scrollbar.css" type="text/css" rel="stylesheet"/> -->
		<link href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
		<link href="{{ asset('/admin-assets/formvalidation/dist/css/formValidation.min.css') }}" rel="stylesheet">
		<link href="{{asset('/front-assets/css/aos.css')}}" type="text/css" rel="stylesheet"/>
		<link href="{{asset('/front-assets/css/style.css')}}" type="text/css" rel="stylesheet"/>
		<link href="{{asset('/css/app.css')}}" type="text/css" rel="stylesheet"/>
		<link href="{{asset('/front-assets/css/responsive.css')}}" type="text/css" rel="stylesheet"/>
		<link href="{{asset('/front-assets/images/fav-icon.png')}}" type="image/png" rel="icon" sizes="316x316">
		@yield('page_specific_css')
	</head>
<body>
	<div class="ajax-loader">
	    <div class="loader-wrapper">
	        <div class="loading-logo">
	            <img src="{{asset('/front-assets/images/logo.png')}}" alt="">
	        </div>
	        <div class="loading-tots">
	            <div class="dot-loader"></div>
	            <div class="dot-loader dot-loader--2"></div>
	            <div class="dot-loader dot-loader--3"></div>
	        </div>
	    </div>
	</div>
	<div class="wrapper">