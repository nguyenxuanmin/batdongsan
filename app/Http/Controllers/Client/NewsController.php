<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class NewsController extends Controller
{
    public function index(){
        $news = Blog::where('tag_table','news')->get();
        return view('client.news',[
            'news' => $news
        ]);
    }
}
