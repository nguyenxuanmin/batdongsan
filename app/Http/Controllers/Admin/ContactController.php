<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        $pageName = "Liên hệ";
        $contacts = Contact::OrderBy('status','asc')->OrderBy('created_at','desc')->paginate(20);
        return view('admin.contact.list',[
            'contacts' => $contacts,
            'pageName' => $pageName
        ]);
    }

    public function view($id){
        $contact = Contact::Where('id',$id)->OrderBy('created_at','desc')->first();
        if($contact->status != 1){
            $contactUpdate = Contact::find($id);
            $contactUpdate->status = 1;
            $contactUpdate->save();
        }
        return view('admin.contact.main',[
            'contact' => $contact
        ]);
    }
}
