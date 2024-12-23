<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\fileExists;

class Addnewadmin extends Controller
{
     //listpage
     public function listpage(){
            $info = User::select('id','name','email','phone','role','created_at','provider','address')
                         ->whereIn('role',['admin','superadmin'])
                         ->when(request('searchkey'),function($search){
                            $search->whereAny(['name','email','address','phone','provider','role'],'like','%'.request('searchkey').'%');
                         })
                         ->paginate(5);
        return view('admin.newadmin.alladmin',compact('info'));
     }

     //userlist
     public function Userlistpage(){
        $data = User::select('id','name','email','phone','role','created_at','provider','address')
                    ->where('role','user')
                    ->when(request('Usersearchkey'),function($search){
                        $search->whereAny(['name','email','address','phone','provider','role'],'like','%'.request('Usersearchkey').'%');
                     })
                    ->paginate(5);

        return view('admin.newadmin.alluser',compact('data'));
     }





     //banadmin
     public function delete($id){
        $img =  User::where('id',$id)->get('profile');
        if(fileExists(public_path('profile/'. $img))){
            unlink(public_path().'profile/'.$img);
        }
        User::where('id',$id)->delete();
        Alert::success('Delete Success','Target has Been Deleted');
        return back();

     }



    //newadmin add page
    public function addpage(){
     return view('admin.newadmin.addnewadmin');
    }

    public function add(Request $request){
        //dd($request);
        $this->photovalidation($request);
        $this->validation($request);

        if($request->hasFile('image')){
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            //dd($filename);
            $request->file('image')->move(public_path().'/profile/',$filename);
            User::create([
                'profile' => $filename,
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'role'=> $request->role,
                'password' => Hash::make($request->password),
            ]);
        }else{
            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'role'=> $request->role,
                'password' => Hash::make($request->password),

              ]);

        };
        Alert::success('Created Successfully','New Account has created Successfully');
        return back();

    }

    private function photovalidation($request){
        $request->validate([
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','nullable' ]
        ]);
    }





    private function validation($request){
        $request->validate([
            'name' => 'required',
            'email' => ['required','email' ,'unique:users,email'],
            'password' => ['required','max:15','min:5'],
            'phone' => ['required','min:5','max:12'],
            'role' => 'required',
        ]);
    }
}
