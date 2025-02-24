@extends('admin.layout.master-page')

@section('title')
    Tin tức
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tin tức</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_blog')}}" title="Thêm">Thêm</a>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="50px"></th>
                        <th scope="col" width="100px">STT</th>
                        <th scope="col" width="200px"></th>
                        <th scope="col">Tên bài viết</th>
                        <th scope="col" width="170px">Người tạo</th>
                        <th scope="col" width="170px">Ngày đăng</th>
                        <th scope="col" width="150px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td valign="middle"><input class="form-check-input" type="checkbox" value="n"></td>
                        <td valign="middle">1</td>
                        <td valign="middle"><img src="" alt="" class=""></td>
                        <td valign="middle">Mark</td>
                        <td valign="middle">Otto</td>
                        <td valign="middle">3333</td>
                        <td valign="middle">
                            <button class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-outline-danger" title="Xóa"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('admin.layout.panigation')
        </div>
    </div>
@endsection
