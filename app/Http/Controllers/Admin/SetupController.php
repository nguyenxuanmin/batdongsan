<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setup;

class SetupController extends Controller
{
    public function __construct()
    {
        $this->listTagTable = ["slider","about_us","service","transport","why_choose_us","news","statistical"];
    }

    public function index(){
        return view('admin.setup.main',[
            'listTagTable' => $this->listTagTable
        ]);
    }

    public function save(Request $request){
        foreach ($this->listTagTable as $item) {
            $checkEmpty = Setup::where('tag_table',$item)->get();
            if(count($checkEmpty) == 0){
                $setup = new Setup();
            }else{
                $setup = Setup::find($checkEmpty[0]->id);
            }
            $listfill = ['n','n','n'];
            for ($i=0; $i < 3; $i++) { 
                if (isset($_POST['check_'.$item.'_'.$i+1])) {
                    $listfill[$i] = 'y';
                }
            }
            $setup->tag_table = $item;
            $setup->list_fill =implode(',', $listfill);
            $setup->save();
        }
        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
