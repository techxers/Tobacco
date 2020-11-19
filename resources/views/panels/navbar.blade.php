<div id="preloader">
    <div class="sk-spinner sk-spinner-wave" id="status">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div><!-- End Preload -->

<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <a href="{{route('landing')}}" id="logo">
                    <img id="logo_img1" src="{{asset('images/logo/leaf.jpg')}}" width="auto" height="100" alt="" data-retina="true" class="hidden-xs" style="padding-bottom: 10px!important;">
                    <img src="{{asset('images/logo/leaf.jpg')}}" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>
            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{asset('images/logo/leaf.jpg')}}" width="auto" height="64" alt="" data-retina="true">
                    </div>

                    <ul style="margin-top: .8em">
                        <li>
                            <a href="{{route('landing')}}" class="show-submenu">Home</a>

                        </li>

                      
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="" data-toggle="modal" data-target="#login_2" id="openDiagLogin">{{ __('Login') }}</a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#register" class="show-submenu">{{ __('Register') }}<i class="icon-down-open-mini"></i></a>
                           
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                 
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                    </ul>
                    {{--
                     <div class="d-flex" style="margin-top: 1em!important;">
                         <a class="btn-primary btn" style="border-radius: 100px;padding: 8px 16px;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.1);font-size: 16px" href="#0" data-toggle="modal" data-target="#login_2">Login</a>
                     </div>
                     --}}
                </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->
</header>
<!-- End Header =============================================== -->