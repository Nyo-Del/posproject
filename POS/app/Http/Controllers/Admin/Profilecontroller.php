<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class Profilecontroller extends Controller
{
    //profileinfo
    public function profilepage(){
        return view('admin.Profile.profile');
    }

    //photoupload
    public function upload(Request $request){
      //dd($request->imageloc);
        $oldfile =   Auth::user()->profile;
        $this->filecheck($request);
        $filename = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/profile/',$filename);

      if($request->hasFile('image')){

           if( $oldfile == null  ){
            User::where('id',Auth::user()->id)->update(['profile'=> $filename] );
           }else{
             unlink(public_path('profile/'.$oldfile));
             User::where('id',Auth::user()->id)->update(['profile'=> $filename] );
           }


        }else{
         Alert::error('Oops' , 'An Error');}
         return back();


    }

    private function filecheck($request){
        $request->validate([
         'image' => 'required'
        ]);
    }

    //editinfo
   public function editpage(){
    return view('admin.Profile.editinfo');
   }

   public function edit(Request $request){
       //dd($request);
       $this->checkvali($request);
       $this->upload($request);
       $userid = Auth::user()->id;
       User::where('id',$userid)->update([
        'name' => $request->name,
        'nickname' => $request->nickname,
        'address' => $request->address,
        'phone' => $request->phone,
        'email' => $request->email,
       ]);
       return to_route('profile');
   }

    private function checkvali($request){

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

    }














    //changepasswordpage
    public function changepassword(){
     return view('admin.Profile.changepassword');
    }

    //changepassword
    public function changep(Request $request){
        //dd($request['oldpassword'],$request['newpassword'],$request['newpassword']);
        $this->passwordValidation($request);
       //dd( auth()->user()->password );
       $currentuser =  auth()->user()->id;
       $currentpassword =   auth()->user()->password ;

        if (Hash::check($request['oldpassword'], $currentpassword)) {

        if (Hash::check($request['newpassword'], $currentpassword)) {
            Alert::error('Error Password', "Old password cannot be the new password");
            return back();
        } else {
            User::where('id', $currentuser)->update(['password' => Hash::make($request->newpassword)]);
            Alert::success('Password Change', 'Password Changed Successfully');

            return to_route('adminHome');


        }

        } else {
            Alert::error('Wrong Password', "Oops, the old password does not match");
            return back();
        }

    }

    //passwordValidation
    private function passwordValidation($request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|max:15',
            'confirmpassword' => 'required|same:newpassword|min:6|max:15'
        ]);

    }
}
