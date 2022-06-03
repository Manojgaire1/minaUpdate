
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <ul class="pcoded-item pcoded-left-item">
                        <li class="pcoded-trigger {{Request::is('admin/dashboard*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/dashboard')}}">
                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                <span class="pcoded-mtext">Dashboard</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                        <li class="pcoded-trigger  {{Request::is('admin/products*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/products')}}">
                                <span class="pcoded-micon"><i class="ti-package"></i><b>V</b></span>
                                <span class="pcoded-mtext">Foods</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class=" pcoded-trigger  {{Request::is('admin/menus*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/menus')}}">
                                <span class="pcoded-micon"><i class="ti-menu"></i><b>V</b></span>
                                <span class="pcoded-mtext">Menu</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="pcoded-trigger  {{Request::is('admin/reservations*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/reservations')}}">
                                <span class="pcoded-micon"><i class="ti-flag"></i><b>V</b></span>
                                <span class="pcoded-mtext">Reservations</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                        <li class="pcoded-trigger  {{Request::is('admin/takeout*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/takeouts')}}">
                                <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i><b>B</b></span>
                                <span class="pcoded-mtext">Takeouts</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="pcoded-trigger  {{Request::is('admin/branches*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/branches')}}">
                                <span class="pcoded-micon"><i class="ti-link"></i><b>B</b></span>
                                <span class="pcoded-mtext">Branches</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="pcoded-trigger  {{Request::is('admin/settings*') ? 'active ' : '' }}">
                            <a href="{{url('/admin/settings')}}">
                                <span class="pcoded-micon"><i class="ti-settings"></i><b>B</b></span>
                                <span class="pcoded-mtext">Settings</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                </div>
            </nav>
