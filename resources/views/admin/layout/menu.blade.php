<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">{{count($contacts)}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">Có {{count($contacts)}} liên hệ chưa đọc</span>
                    @php
                        $current_date = new DateTime();
                    @endphp
                    @foreach ($contacts as $key => $contact)
                        @if ($key < 3)
                            @php
                                $created_date = new DateTime($contact->updated_at);
                                $interval = $created_date->diff($current_date);
                                $total_seconds = ($interval->d * 24 * 3600) + ($interval->h * 3600) + ($interval->i * 60) + $interval->s;
                                $hours = floor($total_seconds / 3600);
                                $minutes = floor(($total_seconds % 3600) / 60);
                                $seconds = $total_seconds % 60;
                                $textDate = "";
                                if(round($hours) == 0){
                                    if (round($minutes) == 0) {
                                        $textDate = round($seconds)." giây trước";
                                    }else{
                                        $textDate = round($minutes)." phút trước";
                                    }
                                }else{
                                    $textDate = round($hours)." giờ trước";
                                    if(round($hours) > 59){
                                        $textDate = $interval->d ." ngày trước";
                                    }
                                }
                            @endphp
                            <div class="dropdown-divider"></div>
                            <a href="{{route('view_contact',$contact->id)}}" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> {{$contact->name}}
                                <span class="float-end text-secondary fs-7">{{$textDate}}</span>
                            </a>
                        @endif
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="{{route('list_contact')}}" class="dropdown-item dropdown-footer"> Xem tất cả liên hệ </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{asset('library/admin/user-01.png')}}" class="user-image rounded-circle shadow" alt="{{Auth::User()->name}}"/>
                    <span class="d-none d-md-inline">{{Auth::User()->name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="{{asset('library/admin/user-01.png')}}" class="rounded-circle shadow" alt="{{Auth::User()->name}}"/>
                        <p>{{Auth::User()->name}}</p>
                    </li>
                    <li class="user-footer">
                        <a href="{{route('logout')}}" class="btn btn-default btn-flat float-end">Đăng xuất</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>