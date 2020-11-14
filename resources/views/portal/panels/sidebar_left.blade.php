<!-- Left Sidebar -->

@php
    use App\Helpers\Helper;$configData = Helper::applClasses();
@endphp

 <aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image"><a href="{{route('profile')}}"><img src="{{asset('images/logo/SVG/chef2.svg')}}" alt="User"></a></div>
                            <div class="detail">
                                <h4>{{$user->name}}</h4>
                                <small>{{$user->email ?? ''}}</small>
                            </div>
                            <a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                            <a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                            <a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a>
                        </div>
                    </li>
                    @if(isset($menuData[0]))
                    @foreach($menuData[0]->menu as $menu)
                    @if(isset($menu->navheader))
                    <li class="header text-uppercase">
                        {{ $menu->navheader }}
                    </li>
                    @else
                    @php
                    $custom_classes = "";
                    if(isset($menu->classlist)) {
                    $custom_classes = $menu->classlist;
                    }
                    @endphp
                    @can($menu->policy, $user)
                    <li class="{{ (request()->is('portal/'.$menu->url)) ? 'active open' : '' }} {{ $custom_classes }}">
                        <a href="@if(isset($menu->uri)){{route($menu->uri)}}@else{{'javascript:void(0)'}}@endif" class="menu-toggle">
                            <i class="{{ $menu->icon }}"></i>
                            <span class="menu-title">{{$menu->name}}</span>
                        </a>
                        @if(isset($menu->submenu))
                        @include('portal.panels.submenu', ['menu' => $menu->submenu])
                        @endif
                    </li>
                    @endcan
                    @endif
                    @endforeach
                    @endif

                    <li>
                        <div class="progress-container progress-primary m-t-10">
                            <span class="progress-badge">Traffic this Month</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                                    <span class="progress-value">67%</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-container progress-info">
                            <span class="progress-badge">Server Load</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                    <span class="progress-value">86%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
      

  
    
    </aside>