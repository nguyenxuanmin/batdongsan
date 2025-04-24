@extends('admin.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">{{$titlePage}}</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm">
                    <div class="card-body">
                        <label for="background" class="form-label">Background</label>
                        <input type="file" class="form-control mb-3" name="background" id="background" accept="image/*">
                        <div class="backgroundContent mb-3">
                            <img id="backgroundContent" src="@if (count($background) && $background[0]->image != ""){{asset('storage/background/'.$tagName.'/'.$background[0]->image)}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Background preview" style="max-width: 100%; max-height: 250px;">
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            document.getElementById('background').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        const imgElement = document.getElementById('backgroundContent'); 
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
                            alert("Cập nhật thành công");
                            location.href = '{{route('admin')}}';
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
