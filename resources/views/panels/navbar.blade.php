<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <div id="divFavorites"> </div>
                </div>
                

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item">
                        
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">Test New</h3><span class="grey darken-2">App Notifications</span>
                                </div>
                            </li>
                           
                            <li class="dropdown-menu-footer">
                                <a class="dropdown-item p-1 text-center" href="{{url('admin/notifications')}}">Read all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" style="padding: 1.6rem 0.5rem 1.35rem 1rem;" href="#" data-toggle="dropdown">
                            {!! Helper::adminLoginInfo() !!}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="feather icon-user"></i> Change password</a> --}}
                            {{-- <div class="dropdown-divider"></div> --}}
                            <a class="dropdown-item" href="{{url('admin/logout')}}"><i class="feather icon-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
                

            </div>
        </div>
    </div>
</nav>
 
