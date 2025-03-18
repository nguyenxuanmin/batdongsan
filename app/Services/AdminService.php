<?php 
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function generateSlug($title) {
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

    public function generateImage($image,$folder) {
        $message = "";
        $uploadOk = 1;
        $targetFile = $folder.'/'. basename($image['name']);
        $uploadDir = storage_path('app/public/'.$folder.'/');
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($image["tmp_name"]);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if ($check === false) {
            $message = "Tệp không phải là hình ảnh.";
            return $message;
        }
        if (Storage::exists($targetFile)) {
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
        if (move_uploaded_file($image["tmp_name"], $uploadDir . basename($image['name']))) {
            return $message;
        } else {
            $message = "Có lỗi xảy ra khi tải tệp lên.";
            return $message;
        }
    }

    public function getTagName($url,$list) {
        $result = "";
        foreach ($list as $item) {
            if (strpos($url, $item) !== false) {
                $result = $item;
                break;
            }
        }
        return $result;
    }

    public function getPageName($tagTable) {
        switch ($tagTable) {
            case 'about_us':
                $pageName = "Về chúng tôi";
                break;
            case 'service':
                $pageName = "Dịch vụ";
                break;
            case 'transport':
                $pageName = "Vận chuyển";
                break;
            case 'why_choose_us':
                $pageName = "Tại sao chọn chúng tôi";
                break;
            case 'news':
                $pageName = "Tin tức";
                break;
            case 'slider':
                $pageName = "Slider";
                break;
            case 'bg_about_us':
                $pageName = "Backgroud về chúng tôi";
                break;
            case 'bg_why_choose_us':
                $pageName = "Backgroud tại sao chọn chúng tôi";
                break;
            case 'bg_contact':
                $pageName = "Backgroud liên hệ";
                break;
            default:
                $pageName = "";
                break;
        }
        return $pageName;
    }
}
