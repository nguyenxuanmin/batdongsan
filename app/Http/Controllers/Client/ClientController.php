<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Background;
use App\Models\Company;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index(){
        $sliders = Blog::where('tag_table','slider')->get();
        $aboutUs = Blog::where('tag_table','about_us')->get();
        $services = Blog::where('tag_table','service')->get();
        $transport = Blog::where('tag_table','transport')->get();
        $bgWhyChooseUs = Background::where('tag_table','bg_why_choose_us')->first();
        $whyChooseUs = Blog::where('tag_table','why_choose_us')->get();
        $bgStatistical = Background::where('tag_table','bg_statistical')->first();
        $statistical = Blog::where('tag_table','statistical')->get();
        $news = Blog::where('tag_table','news')->get();
        $bgContact = Background::where('tag_table','bg_contact')->first();
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

    public function contact(Request $request){
        $name = trim($request->fmiName);
        $email = trim($request->fmiEmail);
        $content = trim($request->fmiContent);
        if($name == ''){
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng nhập họ và tên.'
            ]);
        }
        if($email == ''){
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng nhập email.'
            ]);
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'message' => $email. ' không phải là email hợp lệ.'
                ]);
            }
            $contactExist = Contact::where('email',$email)->first();
            if(isset($contactExist)){
                return response()->json([
                    'success' => false,
                    'message' => 'Email đã gửi liên hệ.'
                ]);
            }
        }
        if($content == ''){
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng nhập nội dung.'
            ]);
        }

        $details = [
            'name' => $name
        ];

        Mail::to($email)->send(new ContactMail($details));

        $contact = new Contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->content = $content;
        $contact->save();

        return response()->json([
            'success' => true,
            'message' => ''
        ]);
    }
}
