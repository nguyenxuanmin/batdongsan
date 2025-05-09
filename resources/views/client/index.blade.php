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
    <section id="about-us" class="section-about-us" @if (isset($bgAboutUs)) style="background-image: url({{asset('storage/background/bg_about_us/'.$bgAboutUs->image)}});" @endif>
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
                    <div class="col-xl-3 col-lg-6 col-12 mb-xl-0 mb-4">
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
    <section class="section-why-choose-us" @if (isset($bgWhyChooseUs)) style="background-image: url({{asset('storage/background/bg_why_choose_us/'.$bgWhyChooseUs->image)}});" @endif>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 d-none d-xl-block">
                    <div class="item-why-choose-us-image">
                        <img src="{{asset('library/client/why_choose_us.png')}}" alt="Tại sao chọn chúng tôi" class="object-fix">
                    </div>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="title-index">
                        <span>Tại sao nên chọn chúng tôi</span>
                    </div>
                    <div class="row">
                        @foreach ($whyChooseUs as $key => $item)
                            <div class="col-lg-6 col-12">
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
    <section id="statistical" class="section-statistical" @if (isset($bgStatistical)) style="background-image: url({{asset('storage/background/bg_statistical/'.$bgStatistical->image)}});" @endif>
        <div class="container">
            <div class="title-index">
                <span>Số liệu thống kê</span>
            </div>
            <div class="row">
                <div class="col-xl-6 col-12">
                    @foreach ($statistical as $item)
                        <div class="item-statistical-title">{{$item->name}}</div>
                        <div class="item-statistical-content">
                            <div class="item-statistical-desc" style="width: {{$item->description/1000 * 100}}%;">{{$item->description}}</div>
                        </div>
                    @endforeach
                </div>
                <div class="col-xl-6 d-none d-xl-block">
                    <div class="item-statistical-image">
                        <img src="{{asset('library/client/statistical.webp')}}" alt="Số liệu thống kê" class="object-fix">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-news">
        <div class="container">
            <div class="title-index">
                <span>Tin tức khuyến mãi</span>
            </div>
            <div class="my-news">
                @foreach ($news as $item)
                    <div class="item-news">
                        <div class="item-news-image">
                            <a href="{{route('news_detail',$item->slug)}}" title="{{$item->name}}">
                                <img src="{{asset('storage/news/'.$item->image)}}" alt="{{$item->name}}" class="object-fix w-100">
                            </a>
                        </div>
                        <div class="item-news-date">
                            <span>{{$item->created_at->format('d/m/Y');}}</span>
                        </div>
                        <h3 class="item-news-title">
                            <a href="{{route('news_detail',$item->slug)}}">{{$item->name}}</a>
                        </h3>
                        <div class="item-news-content">
                            {{$item->description}}
                        </div>
                        <a class="tag-view-more" href="{{route('news_detail',$item->slug)}}" title="Xem thêm">Xem thêm <i class="fa-solid fa-angles-right"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="contact" class="section-contact" @if (isset($bgContact)) style="background-image: url({{asset('storage/background/bg_contact/'.$bgContact->image)}});" @endif>
        <div class="container">
            <div class="title-index">
                <span>Liên hệ</span>
            </div>
            <div class="row">
                <div class="col-xl-4 col-12 d-flex non-padding-right">
                    <div class="item-contact-left">
                        @if (isset($contact))
                            <ul class="item-contact">
                                <li>{{$contact->name}}</li>
                                <li><i class="fa-solid fa-location-dot"></i> <span><b>Địa chỉ:</b> {{$contact->address}}</span></li>
                                <li><i class="fa-solid fa-phone"></i> <span><b>Hotline:</b> {{$contact->hotline}}</span></li>
                                <li><i class="fa-solid fa-envelope"></i> <span><b>Email:</b> {{$contact->email}}</span></li>
                                <li><i class="fa-solid fa-clock"></i> <span><b>Giờ làm việc:</b> {{$contact->timework}}</span></li>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-xl-8 col-12 d-flex non-padding-left">
                    <div class="item-contact-right">
                        <p class="item-title-contact">Gửi thông tin phản hồi cho chúng tôi</p>
                        <form id="formContact">
                            <input type="text" name="fmiName" placeholder="Họ và tên" class="form-control mb-3">
                            <input type="text" name="fmiEmail" placeholder="Email" class="form-control mb-3">
                            <textarea name="fmiContent" rows="5" class="form-control mb-3" placeholder="Nội dung"></textarea>
                            <div class="text-center">
                                <button id="btnContact" class="btn btn-submit-contact">Gửi liên hệ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="showMessage"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#formContact').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var btn = document.getElementById('btnContact');
                btn.disabled = true;
                btn.innerText = 'Đang xử lý...';
                $.ajax({
                    url: '{{ route('sendContact') }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false, 
                    success: function(response) {
                        var message = "";
                        var modalContact = new bootstrap.Modal(document.getElementById('modalContact'), {
                            backdrop: 'static',
                            keyboard: false
                        });
                        if(response.success == true){
                            message = "<div class='msgSuccess'><i class='fa-solid fa-check'></i><span>Gửi liên hệ thành công.</span></div>";
                            modalContact.show();
                            setTimeout(() => {
                                location.href = '{{route('index')}}';
                            }, 3000);
                        }else{
                            message = "<div class='msgError'><i class='fa-solid fa-circle-exclamation'></i><span>"+response.message+"</span></div>";
                            modalContact.show();
                            setTimeout(() => {
                                modalContact.hide();
                            }, 2000);
                        }
                        $('#showMessage').html(message);
                        btn.disabled = false;
                        btn.innerText = 'Gửi liên hệ';
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
@endsection
