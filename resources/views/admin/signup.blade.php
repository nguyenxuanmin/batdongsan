<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
        <link rel="canonical" href="https://demo-basic.adminkit.io/" />
        <title>Đăng ký</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{date('dmYH', time())}}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="text-center mt-4">
                                <h1 class="h2">BẤT ĐỘNG SẢN</h1>
                                <p class="lead">
                                    Tạo mới tài khoản của bạn để đăng nhập vào hệ thống
                                </p>
                            </div>
    
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-3">
                                        <form id="formSignUp">
                                            <div class="mb-3">
                                                <label class="form-label">Tên</label>
                                                <input class="form-control form-control-lg" type="text" name="name" placeholder="Nhập tên của bạn"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" name="email" placeholder="Nhập email của bạn"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu</label>
                                                <input class="form-control form-control-lg" type="password" name="password" placeholder="Nhập mật khẩu của bạn"/>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-lg btn-primary">Đăng ký</button>
                                            </div>
                                            <div id="response" class="mt-3"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                Bạn đã có tài khoản? <a href="{{route('signup')}}">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ asset('js/main.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('#formSignUp').on('submit', function(e){
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('signup') }}',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success == true) {
                                location.href = '{{route('admin')}}';
                            }else{
                                $('#response').html('<p style="color: red; font-size:15px">' + response.message + '</p>');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                });
            });
        </script>
    </body>
</html>