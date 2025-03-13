@php
    $currentUrl = $_SERVER['REQUEST_URI'];
    $list1 = ["slider","about_us","service","transport","why_choose_us","news"];
    $list2 = ["company","setup_column"];
    $isFound1 = false;
    $isFound2 = false;
    foreach ($list1 as $item) {
        if (strpos($currentUrl, $item) !== false) {
            $isFound1 = true;
            break;
        }
    }
    foreach ($list2 as $item) {
        if (strpos($currentUrl, $item) !== false) {
            $isFound2 = true;
            break;
        }
    }
@endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            @if (count($company) && $company[0]->logo != "")
                <img src="{{asset('storage/company/logo/'.$company[0]->logo)}}" alt="{{$company[0]->name}}" class="brand-image opacity-75 shadow" />
            @else
                <img src="{{asset('library/admin/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            @endif
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item @if ($isFound1 == true) menu-open @endif">
                    <a href="#" class="nav-link @if ($isFound1 == true) active @endif"">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>Trang chủ <i class="nav-arrow fa-solid fa-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('list_slider')}}" class="nav-link @if (strpos($currentUrl, 'slider') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-image"></i> <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_about_us')}}" class="nav-link @if (strpos($currentUrl, 'about_us') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-circle-info"></i></i> <p>Về chúng tôi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_service')}}" class="nav-link @if (strpos($currentUrl, 'service') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-bell-concierge"></i> <p>Dịch vụ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_transport')}}" class="nav-link @if (strpos($currentUrl, 'transport') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-truck-fast"></i> <p>Vận chuyển</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_why_choose_us')}}" class="nav-link @if (strpos($currentUrl, 'why_choose_us') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-question"></i> <p>Tại sao chọn chúng tôi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_news')}}" class="nav-link @if (strpos($currentUrl, 'news') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-newspaper"></i> <p>Tin tức</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if ($isFound2 == true) menu-open @endif">
                    <a href="#" class="nav-link @if ($isFound2 == true) active @endif"">
                        <i class="nav-icon fa-solid fa-gear"></i>
                        <p>Hệ thống <i class="nav-arrow fa-solid fa-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('company')}}" class="nav-link @if (strpos($currentUrl, 'company') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-users-rectangle"></i> <p>Thông tin công ty</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('setup_column')}}" class="nav-link @if (strpos($currentUrl, 'setup_column') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-list-check"></i> <p>Setup trường dữ liệu</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>