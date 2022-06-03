
<section id="breadcumb" class="main_menu">
	<div class="container" id="banner_section">
		<div class="row">
			<div class="col-sm-12">
				<div class="_mina_breadcumb">
					<ul class="breadcumb">
						<li><a href="{{route('frontend.homepage')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-arrow-right"></i></li>
						<li><a href="#">@yield('page_name')</a></li>
					</ul>
				</div><!--end of the _mina_breadcumb-->
				@if(Request::is('about*'))
				<div class="mina_menu_heading">
					<p class="_top_content"> {{ __('lang.about-page-tagline')}} </p>
				</div>
				@elseif(Request::is('menu*'))
				<div class="mina_menu_heading">
					<p class="_top_content">{{ __('lang.menu-page-tagline')}}</p>
				</div>
				@elseif(Request::is('contact*'))
				<div class="mina_menu_heading">
					<p class="_top_content"> {{ __('lang.contact-page-tagline')}} </p>
				</div>
				@elseif(Request::is('gallery*'))
				<div class="mina_menu_heading">
					<p class="_top_content"> {{ __('lang.gallery-page-tagline')}} </p>
				</div>
				@elseif(Request::is('checkout*'))
				<div class="mina_menu_heading">
					<p class="_top_content">{{ __('lang.checkout-page-tagline')}}</p>
				</div>
				@endif
			</div><!-- end of the breadcumb col-sm-12 -->
		</div><!-- end of the breadcumb row -->
	</div><!-- end of the breadcumb container --> 
</section><!-- end of the breadcumb section -->