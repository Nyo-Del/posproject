<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
        //contact page
        public function contentpage(){
            return view('user.contentus.contentus');
        }

        //contantus
        public function contentus($id,Request $request){
            //dd($request);
            Contact::create([
                'user_id' =>$id,
                'title' =>$request->title,
                'message' =>$request->message,
            ]);
          return back();
        }
}
