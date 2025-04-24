<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Background;

class NewsController extends Controller
{
    public function index(){
        $folderName = 'banner_news';
        $titlePage = 'Tin tức';
        $news = Blog::where('tag_table','news')->get();
        $bgBreadcrumb = Background::where('tag_table',$folderName)->first();
        return view('client.news',[
            'news' => $news,
            'bgBreadcrumb' => $bgBreadcrumb,
            'folderName' => $folderName,
            'titlePage' => $titlePage
        ]);
    }
}
