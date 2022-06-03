@include('frontend.inc.head')

<div class="loader">

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

    <!--top nav section-->

    <header id="main_header">

        <div class="top-nav">

            <div class="container">

                <div id="top_navigation" class="clearfix">

                    <ul class="language_switcher">

                        <li class="@if(app()->getLocale() == 'jp'){{'active'}}@endif"><a href="javascript:void(0);" data-lang="jp">JP</a> </li>

                        <li class="@if(app()->getLocale() == 'en'){{'active'}}@endif"><a href="javascript:void(0);" data-lang="en">ENG</a></li>

                    </ul>

                    <ul class="social-icons">

                        <li><a href="https://www.facebook.com/Indianresturentmina" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="https://twitter.com/mina69033901" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="https://www.instagram.com/indianrestaurantmina/" target="_blank"><i class="fa fa-instagram"></i></a></li>

                    </ul>



                    <ul class=email>

                        <li><a href="mailto:booking@indianrestaurantmina.com"><i class="fa fa-envelope" aria-hidden="true"></i> booking@indianrestaurantmina.com</a></li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- end top nav  -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="container">

                <button class="navbar-toggler" type="button">

                    <span class="navbar-toggle-icon"></span>

                    <span class="navbar-toggle-icon"></span>

                    <span class="navbar-toggle-icon"></span>

                    <span class="navbar-toggle-icon"></span>

                </button>



                <a class="navbar-brand" href="{{route('frontend.homepage')}}"><img src="{{asset('/front-assets/images/logo.png')}}" class="img-responsive"></a>

                <div class="language-xs">

                    <ul class="language_switcher">

                       <li class="@if(app()->getLocale() == 'jp'){{'active'}}@endif"><a href="javascript:void(0);" data-lang="jp">JP</a> </li>

                        <li class="@if(app()->getLocale() == 'en'){{'active'}}@endif"><a href="javascript:void(0);" data-lang="en">ENG</a></li>

                    </ul>

                    <li class="nav-item dropdown_cart_list">

                       @include('frontend.inc.minaCart')

                    </li>

                </div>

                <div class="collapse navbar-collapse">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item {{Request::is('/') ? 'active' : ''}}">

                            <a class="nav-link" href="{{route('frontend.homepage')}}">{{ __('menu.home') }} <span class="sr-only">(current)</span></a>

                        </li>

                        <li class="nav-item {{Request::is('about*') ? 'active' : ''}}">

                            <a class="nav-link" href="{{route('frontend.aboutpage')}}">{{ __('menu.about') }}</a>

                        </li>

                        <li class="nav-item {{Request::is('menu*') ? 'active' : ''}}">

                            <a class="nav-link" href="{{route('frontend.menupage')}}">{{ __('menu.menu') }}</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="#" id="reservation">{{ __('menu.reservation') }}</a>

                        </li>

                        <li class="nav-item {{Request::is('contact*') ? 'active' : ''}}">

                            <a class="nav-link" href="{{route('frontend.contactpage')}}">{{ __('menu.contact') }}</a>

                        </li>

                        <li class="nav-item {{Request::is('gallery*') ? 'active' : ''}}">

                            <a class="nav-link" href="{{route('frontend.gallerypage')}}">{{ __('menu.gallery') }}</a>

                        </li>

                        @if(!Request::is('checkout*'))

                            @if(!Request::is('takeout*'))

                                <li class="nav-item dropdown_cart_list">

                                   @include('frontend.inc.minaCart')

                                </li>

                            @endif

                        @endif

                        

                    </ul>

                </div>

                <!--  mobile nav  -->

                <div class="mobile-nav">

                    <ul>

                        <li class='nav-item active'>

                            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="{{route('frontend.homepage')}}">{{ __('menu.home') }} <span class="sr-only">(current)</span></a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link {{Request::is('about*') ? 'active' : ''}}" href="{{route('frontend.aboutpage') }}">{{ __('menu.about') }}</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link {{Request::is('menu*') ? 'active' : ''}}" href="{{route('frontend.menupage')}}">{{ __('menu.menu') }}</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link reservation" href="#">{{ __('menu.reservation') }}</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link {{Request::is('contact*') ? 'active' : ''}}" href="{{route('frontend.contactpage')}}">{{ __('menu.contact') }}</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link {{Request::is('gallery*') ? 'active' : ''}}" href="{{route('frontend.gallerypage')}}">{{ __('menu.gallery') }}</a>

                        </li>

                    </ul>



                    <ul class="social-icons">

                        <li><a href="https://www.facebook.com/Indianresturentmina" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="https://twitter.com/mina69033901" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="https://www.instagram.com/indianrestaurantmina/" target="_blank"><i class="fa fa-instagram"></i></a></li>

                        

                    </ul>



                    <ul class=email>

                        <li><a href="mailto:booking@indianrestaurantmina.com"><i class="fa fa-envelope" aria-hidden="true"></i> booking@indianrestaurantmina.com</a></li>

                    </ul>

                    </div>

                </div>

        </nav>

    </header>

    <!-- top nav header -->