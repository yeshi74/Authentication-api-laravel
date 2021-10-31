<ul class="nav navbar-nav float-right">
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
            <i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">{{$cnt}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{$cnt}} New</h3><span class="grey darken-2">App Notifications</span>
                </div>
            </li>
            <li class="scrollable-container media-list">
                @foreach($lstNotifications as $row)
                    <a class="d-flex justify-content-between" href="{{url($row['action'])}}">
                        <div class="media d-flex align-items-start">
                            <div class="media-left"><i class="fa fa-bullhorn"></i></div>
                            <div class="media-body">
                                <h6 class="primary media-heading">{{$row['subject']}}</h6>
                                <small class="notification-text"> {{substr($row['message'],0,120)}}</small>
                            </div>
                            <small><time class="media-meta" datetime="{{$row['cdate']}}">{{$row['cdate']}}</time></small>
                        </div>
                    </a>
                @endforeach
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
            <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="feather icon-user"></i> Edit Profile</a>
            <a class="dropdown-item" href="{{url('admin/tasks')}}"><i class="feather icon-check-square"></i> Task</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('admin/logout')}}"><i class="feather icon-power"></i> Logout</a>
        </div>
    </li>
</ul>