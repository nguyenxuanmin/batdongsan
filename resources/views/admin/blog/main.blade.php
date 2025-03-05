@extends('admin.layout.master-page')

@section('title')
    {{$title_page}}
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{$title_page}}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('list_'.$tagName)}}">{{$pageName}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title_page}}</li>
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
                                    <label for="title" class="form-label">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" name="title" value="@if (isset($blog)){{$blog->name}}@endif">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả bài viết</label>
                                    <textarea class="form-control" name="description" rows="4">@if (isset($blog)){{$blog->description}}@endif</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Hình ảnh bài viết (<span class="text-danger">Kích thước: 360x225px</span>)</label>
                                    <input type="file" class="form-control mb-3" name="image" id="image" accept="image/*">
                                    <div class="imageContent">
                                        <img id="imageContent" src="@if (isset($blog) && $blog->image != ""){{asset('library/'.$tagName.'/'.$blog->image)}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Image preview" style="max-width: 100%; max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6"></div>
                            <div class="col-12 mb-3">
                                <label for="content" class="form-label">Nội dung bài viết</label>
                                <textarea name="content" id="content">@if (isset($blog)){{$blog->content}}@endif</textarea>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                <button class="btn btn-primary">{{$title_page}}</button>
                                <a href="{{route('list_'.$tagName)}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($blog)){{$blog->id}}@endif">
                    <input type="hidden" name="tagName" value="{{$tagName}}">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300
            });

            document.getElementById('image').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        const imgElement = document.getElementById('imageContent'); 
                        imgElement.src = imageUrl; 
                        imgElement.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#submitForm').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('save_'.$tagName) }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false, 
                    success: function(response) {
                        if (response.success == true) {
                            location.href = '{{route('list_'.$tagName)}}';
                        }else{
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
@endsection
