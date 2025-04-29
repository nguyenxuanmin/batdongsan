@extends('client.layout.master-page')

@section('title')
        {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <div class="item-title-content">{{$detail->name}}</div>
        <div class="item-date-content">{{$detail->created_at->format('d/m/Y');}}</div>
        <div class="clearfix mb-4">
            @if ($detail->content != "")
                @php
                    echo nl2br($detail->content);
                @endphp
            @endif
        </div>
    </div>
@endsection