@extends('admin.layout.master-page')

@section('title')
    Thêm tin tức
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Thêm tin tức</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="{{route('list_blog')}}">Tin tức</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Thêm tin tức</li>
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
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả bài viết</label>
                                    <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Hình ảnh bài viết</label>
                                    <input type="file" class="form-control mb-3" name="image" id="image" accept="image/*"/>
                                    <div class="imageContent">
                                        <img id="imageContent" src="{{asset('library/admin/default-image.png')}}" alt="Image preview" style="max-width: 100%; max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6"></div>
                            <div class="col-12 mb-3">
                                <label for="content" class="form-label">Nội dung bài viết</label>
                                <textarea name="content" id="content"></textarea>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                <button class="btn btn-primary">Thêm bài viết</button>
                                <a href="{{route('list_blog')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
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
                    url: '{{ route('add_blog') }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false, 
                    success: function(response) {
                        if (response.success == true) {
                            location.href = '{{route('list_blog')}}';
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
