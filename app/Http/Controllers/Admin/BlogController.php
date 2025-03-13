<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Setup;
use App\Services\AdminService;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->listTagTable = ["slider","about_us","service","transport","why_choose_us","news"];
        $this->tagTable = $this->adminService->getTagName($this->currentUrl,$this->listTagTable);
    }

    public function index(){
        $pageName = $this->adminService->getPageName($this->tagTable);
        $blogs = Blog::where('tag_table',$this->tagTable)->OrderBy('created_at','desc')->paginate(20);
        $setupColumn = Setup::where('tag_table',$this->tagTable)->get();
        return view('admin.blog.list',[
            'blogs' => $blogs,
            'pageName' => $pageName,
            'tagName' => $this->tagTable,
            'setupColumn' => $setupColumn
        ]);
    }

    public function add(){
        $titlePage = "Thêm bài viết";
        $action = "add";
        $pageName = $this->adminService->getPageName($this->tagTable);
        $setupColumn = Setup::where('tag_table',$this->tagTable)->get();
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'pageName' => $pageName,
            'tagName' => $this->tagTable,
            'setupColumn' => $setupColumn
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa bài viết";
        $action = "edit";
        $blog = Blog::find($id);
        $pageName = $this->adminService->getPageName($this->tagTable);
        $setupColumn = Setup::where('tag_table',$this->tagTable)->get();
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'blog' => $blog,
            'pageName' => $pageName,
            'tagName' => $this->tagTable,
            'setupColumn' => $setupColumn
        ]);
    }

    public function save(Request $request){
        $title = $request->title;
        $description = $request->description;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
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
                $imagePath = $tagName.'/'.$blog->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],$tagName);
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
        $imagePath = $this->tagTable.'/'.$blog->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $blog->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
