Yêu cầu:

    + Cài xampp mới nhất
    + Cài git mới nhất
    + Cài composer mới nhất
    + Cài nodejs mới nhất
    
Hướng dẫn các bước chạy chạy website:

    - Tạo database mới trên phpmyadmin : batdongsan utf8_unicode_ci
    - Bật cmd clone project về máy: git clone https://github.com/nguyenxuanmin/batdongsan.git
    - Chạy lệnh: cd batdongsan
    - Chạy lệnh: composer install
    - Chạy lệnh: cp .env.example .env
    - Chỉnh sửa file .env:
        DB_DATABASE = batdongsan
        DB_USERNAME = root
        DB_PASSWORD =
    - Chạy lệnh: php artisan key:generate
    - Chạy lệnh: php artisan storage:link
    - Chạy lệnh: php artisan migrate
    - Chạy lệnh: php artisan serve

Chúc các bạn thành công !!!
