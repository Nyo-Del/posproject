<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
        //usercard
        public function usercartview($cid){
            $data = Cart::where('user_id',$cid)
                        ->select('carts.id as cid','products.price as price','products.name as name','products.photo as photo','carts.qty as qty','products.id')
                        ->leftJoin('products','carts.product_id','products.id')
                        ->get();
            //dd( $data );
            $total = 0;
            foreach($data as $item){
                $total += $item->price * $item->qty;
            }


            return view('user.profile.cart',compact('data','total'));
        }


    //cart
    public function cartview($cid){
        $data = Cart::where('user_id',$cid)
                    ->select('carts.id as cid','products.price as price','products.name as name','products.photo as photo','carts.qty as qty','products.id')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->get();
        //dd( $data );
        $total = 0;
        foreach($data as $item){
            $total += $item->price * $item->qty;
        }


        return view('user.cart.cart',compact('data','total'));
    }

    //delete
    public function deletecart($id){
        Cart::where('id',$id)->delete();
        return back();
    }

}
