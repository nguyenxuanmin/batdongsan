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
                    <a href="#about-us">Về chúng tôi</a>
                </li>
                <li>
                    <a href="#service">Dịch vụ</a>
                </li>
                <li>
                    <a href="#transport">Vận chuyển</a>
                </li>
                <li>
                    <a href="">Thống kê</a>
                </li>
                <li>
                    <a href="">Tin Tức</a>
                </li>
                <li>
                    <a href="">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
</header>