<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>
    <body class="register-page bg-body-secondary">
        <div class="login-box">
            <div class="login-logo">
                <b>BẤT ĐỘNG SẢN</b>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Đăng ký tài khoản mới</p>
                    <form id="formSignUp">
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn" />
                            <div class="input-group-text"><span class="bi bi-person"></span></div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" />
                            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu của bạn" />
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>
                    <p id="response" class="mb-1"></p>
                    <p class="mb-0">Bạn đã có tài khoản? <a href="{{route('login')}}" class="text-center">Đăng nhập</a></p>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
                                $('#response').html('<p style="color: red; font-size:16px">' + response.message + '</p>');
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