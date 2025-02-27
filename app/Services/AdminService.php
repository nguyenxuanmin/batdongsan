<?php 
namespace App\Services;

class AdminService
{
    public function generate_slug($title) {
        $slug = strtolower($title);
        $slug = preg_replace('~[áàạảãâấầậẩẫăắằặẳẵ]~u', 'a', $slug);
        $slug = preg_replace('~[éèẹẻẽêếềệểễ]~u', 'e', $slug);
        $slug = preg_replace('~[íìịỉĩ]~u', 'i', $slug);
        $slug = preg_replace('~[óòọỏõôốồộổỗơớờợởỡ]~u', 'o', $slug);
        $slug = preg_replace('~[úùụủũưứừựửữ]~u', 'u', $slug);
        $slug = preg_replace('~[ýỳỵỷỹ]~u', 'y', $slug);
        $slug = preg_replace('~[đ]~u', 'd', $slug);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    public function generate_image($image,$folder) {
        $message = "";
        $target_dir = $folder;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($image['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            $message = "Tệp không phải là hình ảnh.";
            return $message;
        }
        if (file_exists($target_file)) {
            $message = "Xin lỗi, tệp này đã tồn tại.";
            return $message;
        }
        if ($image["size"] > 5000000) {
            $message = "Xin lỗi, tệp của bạn quá lớn.";
            return $message;
        }

        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "webp") {
            $message = "Xin lỗi, chỉ các tệp JPG, JPEG, PNG, GIF, WEBP được phép.";
            return $message;
        }
        
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            return $message;
        } else {
            $message = "Có lỗi xảy ra khi tải tệp lên.";
            return $message;
        }
    }
}
