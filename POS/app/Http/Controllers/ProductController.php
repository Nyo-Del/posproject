<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\categorie;
use App\Models\product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{




    //deleteproduct
    public function Pdelete($id){
        $imgname =  product::where('id',$id)->select('photo')->first();
            unlink(public_path().'/master/'.$imgname->photo);
        product::where('id',$id)->delete();
        Alert::success('Success','Product has Been Deleted');
        return back();
    }

    //pupdated
    public function Pupdated(Request $request,$id){
        $oldimg=product::where('id',$id)->select('photo')->first();
        //dd($oldimg->photo);
        $this->updatevali($request);
        if($request->hasFile('image')){
            unlink(public_path().'/master/'.$oldimg->photo);
            $filename = uniqid().$request->file('image')->getClientOriginalname();
            $request->file('image')->move(public_path().'/master/',$filename );
            product::where('id',$id)->update([
                'name'=>$request->Productname,
                'photo'=>$filename,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'category_id'=>$request->category,
                'description'=>$request->description,
            ]);

        }else(
            product::where('id',$id)->update([
                'name'=>$request->Productname,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'category_id'=>$request->category,
                'description'=>$request->description,
            ])
        );
        Alert::success('Update Success', 'Product has been updated');
        return to_route('P#page');
    }




    //pupdatepage
    public function Pupdatepage($id){
        $data = product::where('id',$id)->select('id','name','price','photo','stock','description')->get();
        $category = categorie::select('id','name')->get();
        return view('admin.Product.Productupdate',compact('category','data'));
    }

        //seemore
        public function Pseemore($id){
            $data = product::where('products.id',$id)
                            ->select('categories.name as category_name','products.id','products.description','products.photo','products.price','products.stock','products.created_at','products.updated_at','products.name',)
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->get();
            return view ('admin.Product.seemore',compact('data'));
        }


    //productlist
    public function Plistpage($amt = 'default'){
        $product = product::select('categories.name as category_name','products.id','products.name','products.photo','products.price','products.stock')
                           ->leftJoin('categories','products.category_id','categories.id')
                           ->when(request('Itemsearchkey'),function($search){
                            $search->whereAny(['products.name','products.price','categories.name','products.stock'],'like','%'.request('Itemsearchkey').'%');
                           });
            if($amt != 'default'){
                   $product = $product->where('stock','<=',10);
            }
                          $product = $product ->orderBy('products.created_at','desc') ->paginate(4);

    return view('admin.Product.Productlist',compact('product'));
    }

    //product page
    public function Pcreatepage(){
        $category = categorie::select('id','name')->get();
       return view('admin.Product.Productcreate',compact('category'));
    }

    //product create
    public function Pcreate(Request $request){
      $this->Pvalidate($request);
      $filename = uniqid().$request->file('image')->getClientOriginalname();
      $request->file('image')->move(public_path().'/master/',$filename );
        product::create([
            'name'=>$request['Productname'],
            'stock'=>$request['stock'],
            'price'=>$request['price'],
            'category_id'=>$request['category'],
            'description'=>$request['description'],
            'photo'=>$filename,
        ]);

        Alert::success('New Product Created','Cong New Product Has Been Created');
        return back();

    }
    //updatevalidate
    private function updatevali(Request $request){
        $request->validate([
            'Productname'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);
    }


    //productvalidation
    private function Pvalidate(Request $request){
        $request->validate([
            'image'=>'required',
            'Productname'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);
    }
}
