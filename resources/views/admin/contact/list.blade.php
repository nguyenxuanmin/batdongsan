@extends('admin.layout.master-page')

@section('title')
    {{$pageName}}
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{$pageName}}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{$pageName}}</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="100px" class="text-center">STT</th>
                        <th scope="col">Tên liên hệ</th>
                        <th scope="col" width="350px">Email</th>
                        <th scope="col" width="250px">Trạng thái</th>
                        <th scope="col" width="200px" class="text-center">Ngày liên hệ</th>
                        <th scope="col" width="150px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($contacts) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="5">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($contacts as $key => $contact)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">{{$contact->name}}</td>
                            <td valign="middle">{{$contact->email}}</td>
                            <td valign="middle">@if ($contact->status == 0) Chưa đọc @else Đã đọc @endif</td>
                            <td valign="middle" align="center">{{$contact->created_at->format('d/m/Y');}}</td>
                            <td valign="middle">
                                <a href="{{route('view_contact',[$contact->id])}}" class="btn btn-outline-info" title="Xem"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$contacts->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
