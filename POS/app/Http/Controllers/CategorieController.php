<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\categorie;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategorieController extends Controller
{
    //category list page
    public function list(){
        $categories = Categorie::orderBy('created_at','desc')->paginate(5);

     return view('admin.category.list',compact('categories'));
    }


    //update page
    public function upatepage($id){

        //dd($id);
        $oldcategory = categorie::where('id',$id)->get();
        return view('admin.category.updatepage',compact('oldcategory'));
    }

    //update
    public function update($id,Request $request){
        //dd($id,$request['name']);
        $this->Checkvalidation($request);
        $updatedname = categorie::where('id',$id)->update([ 'name' => $request['name'],'updated_at'=> Carbon::now()]);
        Alert::success('Category Updated','Category Updated Successfully');
        return to_route('category#list');
    }


    //delete
    public function delete($id){
        //dd($id);
        categorie::destroy($id);
        Alert::success('Category Deleted','Category Deleted Successfully');
        return back();

    }
    //create
    public function create(Request $request){
        $this->Checkvalidation($request);
        Categorie::create([
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        Alert::success('Category Created','Category Created Successfully');
        return back();
    }

    //redirect
    public function back(){
        return to_route('category#list');
    }

    //validate
    private function Checkvalidation($request){
        $request->validate([
        'name'=>'required'
        ],[
        'name.required'=>'Category Name Must be fill'
        ]);
    }
}
