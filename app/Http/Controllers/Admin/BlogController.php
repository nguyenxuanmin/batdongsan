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
        $blogs = Blog::OrderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',['blogs' => $blogs]);
    }

    public function add(){
        $title_page = "Thêm bài viết";
        $action = "add";
        return view('admin.blog.main',[
            'title_page' => $title_page,
            'action' => $action
        ]);
    }

    public function edit($id){
        $title_page = "Sửa bài viết";
        $action = "edit";
        $blog = Blog::find($id);
        return view('admin.blog.main',[
            'title_page' => $title_page,
            'action' => $action,
            'blog' => $blog
        ]);
    }

    public function save(Request $request){
        $title = $request->title;
        $description = $request->description;
        $image = $_FILES["image"]["name"];
        $content = $request->content;
        $slug = $this->adminService->generate_slug($title);
        $action = $request->action;
        if ($title == "") {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề bài viết không được để trống.'
            ]);
        }

        if($action == "edit"){
            $blog = Blog::find($request->id);
        }else{
            $blog = new Blog();
        }

        if ($image != "") {
            if($action == "edit"){
                $imagePath = public_path('library/blog/' . $blog->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $messageError = $this->adminService->generate_image($_FILES["image"],"library/blog/");
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if($action == "edit"){
            if (!$request->hasFile('image')) {
                $image = $blog->image;
            }
        }
        
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

    public function delete(Request $request){
        $blog = Blog::find($request->id);
        $imagePath = public_path('library/blog/' . $blog->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $blog->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
