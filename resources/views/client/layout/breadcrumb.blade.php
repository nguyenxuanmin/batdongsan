<div class="item-breadcrumb" @if (isset($bgBreadcrumb)) style="background-image: url({{asset('storage/background/'.$folderName.'/'.$bgBreadcrumb->image)}});" @endif>
        <div class="container">
                <div class="item-breadcrumb-content">
                        <h2 class="item-title-breadcrumb">{{$titlePage}}</h2>
                        <div class="item-list-breadcrumb">
                                <a href="{{route('index')}}">Trang chủ</a> / @if (isset($category)) <a href="{{route($category_link)}}">{{$category}}</a> / @endif <span>{{$titlePage}}</span>
                        </div>
                </div>
        </div>
</div>