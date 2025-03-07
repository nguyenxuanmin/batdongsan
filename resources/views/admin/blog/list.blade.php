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
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_'.$tagName)}}" title="Thêm">Thêm bài viết</a>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="100px" class="text-center">STT</th>
                        <th scope="col" width="150px"></th>
                        <th scope="col">Tên bài viết</th>
                        <th scope="col" width="200px" class="text-center">Ngày đăng</th>
                        <th scope="col" width="150px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($blogs) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="5">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($blogs as $key => $blog)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">
                                @if (count($setupColumn) && explode(',', $setupColumn[0]->list_fill)[2] == 'y')
                                    <img src="{{asset('storage/'.$tagName.'/' . basename($blog->image))}}" alt="{{$blog->name}}" class="w-75">
                                @endif
                            </td>
                            <td valign="middle">{{$blog->name}}</td>
                            <td valign="middle" align="center">{{$blog->created_at->format('d/m/Y');}}</td>
                            <td valign="middle">
                                <a href="{{route('edit_'.$tagName,[$blog->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="delete_blog({{$blog->id}});"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$blogs->links('admin.layout.pagination')}}
        </div>
    </div>
    <script>
        function delete_blog(id){
            let result  = confirm("Bạn có muốn xóa bài viết?");
            if (result) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('delete_'.$tagName) }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        location.href = '{{route('list_'.$tagName)}}';
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            }
        }
    </script>
@endsection
