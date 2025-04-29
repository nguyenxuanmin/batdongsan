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
        $news = Blog::where('tag_table','news')->paginate(6);
        $bgBreadcrumb = Background::where('tag_table',$folderName)->first();
        return view('client.news',[
            'news' => $news,
            'bgBreadcrumb' => $bgBreadcrumb,
            'folderName' => $folderName,
            'titlePage' => $titlePage
        ]);
    }

    public function detail($slug){
        $folderName = 'banner_news';
        $detail = Blog::where('tag_table','news')->where('slug',$slug)->first();
        $titlePage = $detail->name;
        $category_link = "news";
        $category = "Tin tức";
        $bgBreadcrumb = Background::where('tag_table',$folderName)->first();
        return view('client.news_detail',[
            'detail' => $detail,
            'bgBreadcrumb' => $bgBreadcrumb,
            'folderName' => $folderName,
            'titlePage' => $titlePage,
            'category' => $category,
            'category_link' => $category_link
        ]);
    }
}
