<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class password extends Controller
{
    //change password pg
    public function changepasswordpg(){
        return view('user.profile.changepassword');
    }

    public function changepassword($id,Request $request){
        $this->passwordValidation($request);
           $currentpassword =auth()->user()->password;
            //dd($currentpassword);
           // dd($request['oldpassword'],$request['newpassword']);
         if (Hash::check($request->oldpassword, $currentpassword)) {

        if (Hash::check($request->newpassword, $currentpassword)) {

            return back();
        } else {
            User::where('id', $id)->update(['password' => Hash::make($request->newpassword)]);

            return to_route('userHome');
        }

        } else {
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
