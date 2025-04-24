<header class="header">
    <div class="container">
        <div class="item-header">
            <div class="item-logo">
                <a href="{{route('index')}}">
                    @if (count($company) && $company[0]->logo != "")
                        <img src="{{asset('storage/company/logo/'.$company[0]->logo)}}" alt="{{$company[0]->name}}" class="object-fix">
                    @else
                        LOGO
                    @endif
                </a>
            </div>
            <ul class="item-nav">
                <li>
                    <a href="{{route('index')}}#about-us">Về chúng tôi</a>
                </li>
                <li>
                    <a href="{{route('index')}}#service">Dịch vụ</a>
                </li>
                <li>
                    <a href="{{route('index')}}#transport">Vận chuyển</a>
                </li>
                <li>
                    <a href="{{route('index')}}#statistical">Thống kê</a>
                </li>
                <li>
                    <a href="{{route('news')}}">Tin Tức</a>
                </li>
                <li>
                    <a href="{{route('index')}}#contact">Liên hệ</a>
                </li>
            </ul>
            <a class="item-show-menu" href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>
        </div>
    </div>
</header>
<div id="menu-mobile">
    <a class="item-hide-menu" href="javascript:void(0)"><i class="fa-solid fa-xmark"></i></a>
    <div class="item-logo-mobile">
        <a href="{{route('index')}}">
            @if (count($company) && $company[0]->logo != "")
                <img src="{{asset('storage/company/logo/'.$company[0]->logo)}}" alt="{{$company[0]->name}}" class="object-fix">
            @else
                LOGO
            @endif
        </a>
    </div>
    <ul>
        <li>
            <a href="{{route('index')}}#about-us">Về chúng tôi</a>
        </li>
        <li>
            <a href="{{route('index')}}#service">Dịch vụ</a>
        </li>
        <li>
            <a href="{{route('index')}}#transport">Vận chuyển</a>
        </li>
        <li>
            <a href="{{route('index')}}#statistical">Thống kê</a>
        </li>
        <li>
            <a href="{{route('news')}}">Tin Tức</a>
        </li>
        <li>
            <a href="{{route('index')}}#contact">Liên hệ</a>
        </li>
    </ul>
</div>