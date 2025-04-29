@extends('admin.layout.master-page')

@section('title')
    Nội dung liên hệ
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Nội dung liên hệ</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('list_contact')}}">Liên hệ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nội dung liên hệ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên liên hệ</label>
                                    <input type="text" class="form-control" name="name" value="{{$contact->name}}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email liên hệ</label>
                                    <input type="text" class="form-control" name="email" value="{{$contact->email}}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Nội dung</label>
                                    <textarea class="form-control" name="contact" rows="4" readonly>{{$contact->content}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6"></div>
                            <div class="col-12 mb-3 text-end">
                                <a href="{{route('list_contact')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
