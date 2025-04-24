@extends('client.layout.master-page')

@section('title')
    Tin Tức
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <div class="row">
            @foreach ($news as $item)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="item-news">
                        <div class="item-news-image">
                            <a href="" title="{{$item->name}}">
                                <img src="{{asset('storage/news/'.$item->image)}}" alt="{{$item->name}}" class="object-fix w-100">
                            </a>
                        </div>
                        <div class="item-news-date">
                            <span>{{$item->created_at->format('d/m/Y');}}</span>
                        </div>
                        <h3 class="item-news-title">
                            <a href="">{{$item->name}}</a>
                        </h3>
                        <div class="item-news-content">
                            {{$item->description}}
                        </div>
                        <a class="tag-view-more" href="" title="Xem thêm">Xem thêm <i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection