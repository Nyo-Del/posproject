<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\View\Components\Alert;

use function PHPUnit\Framework\fileExists;

class Profilecontroller extends Controller
{
    //userprofile
    public function userprofile(){
        return view('user.profile.profile');
    }

    public function userupdate($id,Request $request){
        //dd($id,$request);
        $oldimg = auth()->user()->profile;
        //dd($oldimg);
        $this->uservali($request);
        if($request->hasFile('image')){
           if(file_exists($oldimg)){
            unlink(public_path().'/profile/'.$oldimg);
           }else{
            $imagename = uniqid().$request->file('image')->getClientOriginalname();
            $request->file('image')->move(public_path().'/profile/',$imagename);

            User::where('id',$id)->update([
                'nickname'=>$request->nickname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'profile'=>$imagename,
              ]);
           }


        }else{
            User::where('id',$id)->update([
                'nickname'=>$request->nickname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
              ]);
        }


      return back();
    }


    //validation
    private function uservali(Request $request){
        $request->validate([
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',

        ]);
    }
}
