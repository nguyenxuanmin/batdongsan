<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Backgroud;
use App\Models\Company;

class ClientController extends Controller
{
    public function index(){
        $sliders = Blog::where('tag_table','slider')->get();
        $aboutUs = Blog::where('tag_table','about_us')->get();
        $services = Blog::where('tag_table','service')->get();
        $transport = Blog::where('tag_table','transport')->get();
        $bgWhyChooseUs = Backgroud::where('tag_table','bg_why_choose_us')->first();
        $whyChooseUs = Blog::where('tag_table','why_choose_us')->get();
        $bgStatistical = Backgroud::where('tag_table','bg_statistical')->first();
        $statistical = Blog::where('tag_table','statistical')->get();
        $news = Blog::where('tag_table','news')->get();
        $bgContact = Backgroud::where('tag_table','bg_contact')->first();
        $contact = Company::first();
        return view('client.index',[
            'sliders' => $sliders,
            'aboutUs' => $aboutUs,
            'services' => $services,
            'transport' => $transport,
            'bgWhyChooseUs' => $bgWhyChooseUs,
            'whyChooseUs' => $whyChooseUs,
            'bgStatistical' => $bgStatistical,
            'statistical' => $statistical,
            'news' => $news,
            'bgContact' => $bgContact,
            'contact' => $contact
        ]);
    }
}
