<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\categorie;
use App\Models\product;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    //driect user home
    public function userHome($id = null){
       // dd(request('minp'),request('maxp'));
       //dd(explode(',',request('sortingType')));

       $minp =request('minp');
       $maxp =request('maxp');
        $categories = categorie::select('id','name')->paginate(3);
        $data = product::select('categories.name as category_name','products.name','products.price','products.id','products.stock','products.description','products.photo')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->when(request('searchKey') ,function($search){
                            $search->whereAny(['products.name','products.description',],'like','%'.request('searchKey').'%');
                         })
                         ->when(request('sortingType') ,function($search){
                            $sortRule = explode(',',request('sortingType'));
                            $sortName = 'products.'.$sortRule['0'];
                            $sortBy = $sortRule['1'];
                            //dd($sortName,$sortBy);
                            $search->orderBy($sortName,$sortBy);
                         })
                        ->when($id != null ,function($search) use($id){
                            $search->where('products.category_id',$id);
                        })
                        //Both True
                        ->when($minp != null && $maxp != null ,function($searchByP) use($minp,$maxp){
                           $searchByP=$searchByP->whereBetween('products.price',[$minp,$maxp]);
                        })
                        //min true
                        ->when($minp != null && $maxp == null ,function($searchByP) use($minp){
                            $searchByP=$searchByP->where('products.price','>=' ,$minp);
                         })
                         //max true
                         ->when($minp == null && $maxp != null ,function($searchByP) use($maxp){
                            $searchByP=$searchByP->where('products.price','<=' ,$maxp);
                         })
                        //->orderBy('products.created_at','asc')
                        ->paginate(6);
        return view('user.home.list',compact('data','categories'));
    }



}
