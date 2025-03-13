<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ClientController extends Controller
{
    public function index(){
        $sliders = Blog::where('tag_table','slider')->get();
        $about_us = Blog::where('tag_table','about_us')->get();
        $services = Blog::where('tag_table','service')->get();
        return view('client.index',[
            'sliders' => $sliders,
            'about_us' => $about_us,
            'services' => $services
        ]);
    }
}
