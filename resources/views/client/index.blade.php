@extends('client.layout.master-page')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section class="section-slider">
        <div class="my-slider">
            @foreach ($sliders as $slider)
                <div class="item-slider">
                    <img src="{{asset('storage/slider/'.$slider->image)}}" alt="{{$slider->name}}" class="w-100 object-fix">
                </div>
            @endforeach
        </div>
    </section>
    <section id="about-us" class="section-about-us">
        <div class="container">
            <div class="title-index">
                <span>Về chúng tôi</span>
            </div>
            <div class="row">
                @foreach ($aboutUs as $item)
                    <div class="col-lg-4 col-12 mb-lg-0 mb-4">
                        <div class="item-about-us">
                            <div class="item-about-us-image">
                                <img src="{{asset('storage/about_us/'.$item->image)}}" alt="{{$item->name}}" class="w-100 object-fix">
                            </div>
                            <h3 class="item-about-us-title">{{$item->name}}</h3>
                            <div class="item-about-us-desc">
                                {{$item->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="service" class="section-service">
        <div class="title-index">
            <span>Dịch vụ</span>
        </div>
        @foreach ($services as $key => $service)
            <div class="item-service">
                <div class="container">
                    <div class="item-service-detail">
                        <div class="item-service-image">
                            <img src="{{asset('storage/service/'.$service->image)}}" alt="{{$service->name}}">
                        </div>
                        <div class="item-service-content">
                            <h3 class="item-service-title">{{$service->name}}</h3>
                            <div class="item-service-desc">
                                {{$service->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <section id="transport" class="section-transport">
        <div class="container">
            <div class="title-index">
                <span>Ngoài ra chúng tôi cung cấp nhiều loại hình vận chuyển khác</span>
            </div>
            <div class="row">
                @foreach ($transport as $item)
                    <div class="col-lg-3 col-12 mb-lg-0 mb-4">
                        <div class="item-about-us">
                            <div class="item-about-us-image">
                                <img src="{{asset('storage/transport/'.$item->image)}}" alt="{{$item->name}}" class="w-100 object-fix">
                            </div>
                            <h3 class="item-about-us-title">{{$item->name}}</h3>
                            <div class="item-about-us-desc">
                                {{$item->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section-why-choose-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="item-why-choose-us-image">
                        <img src="{{asset('library/client/why_choose_us.png')}}" alt="Tại sao chọn chúng tôi" class="object-fix">
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="title-index">
                        <span>Tại sao nên chọn chúng tôi</span>
                    </div>
                    <div class="py-4"></div>
                    <div class="row">
                        @foreach ($whyChooseUs as $key => $item)
                            <div class="col-lg-6 col-12 mb-lg-0 mb-4">
                                <div class="item-why-choose-us">
                                    <div class="item-why-choose-us-left"><span>0{{$key + 1}}</span></div>
                                    <div class="item-why-choose-us-right">
                                        <h3 class="item-why-choose-us-title">{{$item->name}}</h3>
                                        <div class="item-why-choose-us-desc">
                                            {{$item->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
