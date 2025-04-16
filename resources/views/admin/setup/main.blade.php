@extends('admin.layout.master-page')

@section('title')
    Setup trường dữ liệu
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Setup trường dữ liệu</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setup trường dữ liệu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm">
                    @foreach ($listTagTable as $item)
                        @php
                            $columnFill = DB::select("
                                SELECT list_fill
                                FROM setups
                                WHERE tag_table = '".$item."'
                            ");
                        @endphp
                        <div class="card-body">
                            <label class="form-label">
                                @php
                                    switch ($item) {
                                        case 'news':
                                            echo "Tin tức";
                                            break;
                                        case 'about_us':
                                            echo "Về chúng tôi";
                                            break;
                                        case 'service':
                                            echo "Dịch vụ";
                                            break;
                                        case 'transport':
                                            echo "Vận chuyển";
                                            break;
                                        case 'why_choose_us':
                                            echo "Tại sao chọn chúng tôi";
                                            break;
                                        case 'slider':
                                            echo "Slider";
                                            break;
                                        case 'statistical':
                                            echo "Thống kê";
                                            break;
                                        default:
                                            echo "";
                                            break;
                                    }
                                @endphp
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" @if (count($columnFill) && explode(',', $columnFill[0]->list_fill)[0] == 'y') checked @endif name="check_{{$item}}_1" id="check_{{$item}}_1">
                                <label class="form-check-label" for="check_{{$item}}_1">
                                    Mô tả bài viết
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" @if (count($columnFill) && explode(',', $columnFill[0]->list_fill)[1] == 'y') checked @endif name="check_{{$item}}_2" id="check_{{$item}}_2">
                                <label class="form-check-label" for="check_{{$item}}_2">
                                    Hình ảnh
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" @if (count($columnFill) && explode(',', $columnFill[0]->list_fill)[2] == 'y') checked @endif name="check_{{$item}}_3" id="check_{{$item}}_3">
                                <label class="form-check-label" for="check_{{$item}}_3">
                                    Nội dung bài viết
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <div class="card-footer text-end">
                        <button class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#submitForm').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('save_setup') }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false, 
                    success: function(response) {
                        alert("Cập nhật thành công");
                        location.href = '{{route('admin')}}';
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
@endsection
