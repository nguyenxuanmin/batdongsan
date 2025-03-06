<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\AdminService;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->listTagTable = ["news","about_us","service"];
        $this->tagTable = $this->adminService->getTagName($this->currentUrl,$this->listTagTable);
    }

    public function index(){
        switch ($this->tagTable) {
            case 'news':
                $pageName = "Tin tức";
                break;
            case 'about_us':
                $pageName = "Về chúng tôi";
                break;
            case 'service':
                $pageName = "Dịch vụ";
                break;
            default:
                $pageName = "";
                break;
        }
        $blogs = Blog::Where('tag_table',$this->tagTable)->OrderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',[
            'blogs' => $blogs,
            'pageName' => $pageName,
            'tagName' => $this->tagTable
        ]);
    }

    public function add(){
        $title_page = "Thêm bài viết";
        $action = "add";
        switch ($this->tagTable) {
            case 'news':
                $pageName = "Tin tức";
                break;
            case 'about_us':
                $pageName = "Về chúng tôi";
                break;
            case 'service':
                $pageName = "Dịch vụ";
                break;
            default:
                $pageName = "";
                break;
        }
        return view('admin.blog.main',[
            'title_page' => $title_page,
            'action' => $action,
            'pageName' => $pageName,
            'tagName' => $this->tagTable
        ]);
    }

    public function edit($id){
        $title_page = "Sửa bài viết";
        $action = "edit";
        $blog = Blog::find($id);
        switch ($this->tagTable) {
            case 'news':
                $pageName = "Tin tức";
                break;
            case 'about_us':
                $pageName = "Về chúng tôi";
                break;
            case 'service':
                $pageName = "Dịch vụ";
                break;
            default:
                $pageName = "";
                break;
        }
        return view('admin.blog.main',[
            'title_page' => $title_page,
            'action' => $action,
            'blog' => $blog,
            'pageName' => $pageName,
            'tagName' => $this->tagTable
        ]);
    }

    public function save(Request $request){
        $title = $request->title;
        $description = $request->description;
        $image = $_FILES["image"]["name"];
        $content = $request->content;
        $slug = $this->adminService->generateSlug($title);
        $action = $request->action;
        $tagName = $request->tagName;
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
                $imagePath = public_path('library/'.$tagName.'/' . $blog->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],"library/$tagName/");
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
        $blog->tag_table = $tagName;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $blog = Blog::find($request->id);
        $imagePath = public_path('library/'.$this->tagTable.'/' . $blog->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $blog->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
