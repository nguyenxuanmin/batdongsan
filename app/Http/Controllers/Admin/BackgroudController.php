<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backgroud;
use App\Services\AdminService;
use Illuminate\Support\Facades\Storage;

class BackgroudController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
        $this->currentUrl = $_SERVER['REQUEST_URI'];
        $this->listTagTable = ["bg_about_us","bg_why_choose_us","bg_contact"];
        $this->tagTable = $this->adminService->getTagName($this->currentUrl,$this->listTagTable);
    }

    public function index(){
        $backgroud = Backgroud::where('tag_table',$this->tagTable)->get();
        $titlePage = $this->adminService->getPageName($this->tagTable);
        return view('admin.backgroud.main',[
            'titlePage' => $titlePage,
            'tagName' => $this->tagTable,
            'backgroud' => $backgroud
        ]);
    }

    public function save(Request $request){
        if (isset($_FILES["backgroud"])) {
            $backgroudImage = $_FILES["backgroud"]["name"];
        }else{
            $backgroudImage = "";
        }
        
        if ($backgroudImage == "") {
            return response()->json([
                'success' => false,
                'message' => 'Backgroud không được để trống.'
            ]);
        }

        $checkEmpty = Backgroud::where('tag_table',$this->tagTable)->get();
        if(count($checkEmpty) == 0){
            $backgroud = new Backgroud();
        }else{
            $backgroud = Backgroud::find($checkEmpty[0]->id);
            $imagePath = 'backgroud/'.$this->tagTable.'/'.$checkEmpty[0]->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $messageError = $this->adminService->generateImage($_FILES["backgroud"],'backgroud/'.$this->tagTable);
        if($messageError != ""){
            return response()->json([
                'success' => false,
                'message' => $messageError
            ]);
        }

        $backgroud->tag_table = $this->tagTable;
        $backgroud->image = $backgroudImage;
        $backgroud->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
