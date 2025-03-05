@php
    $currentUrl = $_SERVER['REQUEST_URI'];
    $list1 = ["blog", "news", "about_us"];
    $list2 = ["company"];
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
            <img src="{{asset('library/admin/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
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
                            <a href="{{route('list_about_us')}}" class="nav-link @if (strpos($currentUrl, 'about_us') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-circle-info"></i></i> <p>Về chúng tôi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_blog')}}" class="nav-link @if (strpos($currentUrl, 'blog') !== false) active @endif">
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
                            <a href="" class="nav-link @if (strpos($currentUrl, 'company') !== false) active @endif">
                                <i class="nav-icon fa-solid fa-users-rectangle"></i> <p>Thông tin công ty</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>