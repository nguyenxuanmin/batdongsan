<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\AdminService;

class BlogController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function index(){
        $blogs = Blog::all();
        return view('admin.blog.list',['blogs' => $blogs]);
    }

    public function main(){
        return view('admin.blog.main');
    }

    public function add(Request $request){
        $title = $request->title;
        $description = $request->description;
        $image = $_FILES["image"]["name"];
        $content = $request->content;
        $slug = $this->adminService->generate_slug($title);
        
        if ($title == "") {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề bài viết không được để trống.'
            ]);
        }

        if ($image != "") {
            $messageError = $this->adminService->generate_image($_FILES["image"],"library/blog/");
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        $blog = new Blog();
        $blog->name = $title;
        $blog->slug = $slug;
        $blog->description = $description;
        $blog->content = $content;
        $blog->image = $image;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
