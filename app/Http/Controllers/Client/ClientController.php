<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ClientController extends Controller
{
    public function index(){
        $sliders = Blog::where('tag_table','slider')->get();
        $aboutUs = Blog::where('tag_table','about_us')->get();
        $services = Blog::where('tag_table','service')->get();
        $transport = Blog::where('tag_table','transport')->get();
        $whyChooseUs = Blog::where('tag_table','why_choose_us')->get();
        return view('client.index',[
            'sliders' => $sliders,
            'aboutUs' => $aboutUs,
            'services' => $services,
            'transport' => $transport,
            'whyChooseUs' => $whyChooseUs
        ]);
    }
}
