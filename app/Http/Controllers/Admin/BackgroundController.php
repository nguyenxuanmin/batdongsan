<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Background;
use App\Services\AdminService;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->listTagTable = ["bg_about_us","bg_why_choose_us","bg_contact","bg_statistical","banner_news"];
        $this->tagTable = $this->adminService->getTagName($this->currentUrl,$this->listTagTable);
    }

    public function index(){
        $background = Background::where('tag_table',$this->tagTable)->get();
        $titlePage = $this->adminService->getPageName($this->tagTable);
        return view('admin.background.main',[
            'titlePage' => $titlePage,
            'tagName' => $this->tagTable,
            'background' => $background
        ]);
    }

    public function save(Request $request){
        if (isset($_FILES["background"])) {
            $backgroundImage = $_FILES["background"]["name"];
        }else{
            $backgroundImage = "";
        }
        
        if ($backgroundImage == "") {
            return response()->json([
                'success' => false,
                'message' => 'Background không được để trống.'
            ]);
        }

        $checkEmpty = Background::where('tag_table',$this->tagTable)->get();
        if(count($checkEmpty) == 0){
            $background = new Background();
        }else{
            $background = Background::find($checkEmpty[0]->id);
            $imagePath = 'background/'.$this->tagTable.'/'.$checkEmpty[0]->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $messageError = $this->adminService->generateImage($_FILES["background"],'background/'.$this->tagTable);
        if($messageError != ""){
            return response()->json([
                'success' => false,
                'message' => $messageError
            ]);
        }

        $background->tag_table = $this->tagTable;
        $background->image = $backgroundImage;
        $background->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
