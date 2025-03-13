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
    <section id="about_us" class="section-about-us">
        <div class="container">
            <div class="title-index">
                <span>Về chúng tôi</span>
            </div>
            <div class="row">
                @foreach ($about_us as $item)
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
@endsection
