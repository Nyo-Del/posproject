<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //rating
    public function rating($id,Request $request){
        //dd($request->productRating,$request->user_id);
        Rating::updateOrCreate([
            'user_id'=>$request->user_id,
            'product_id'=>$id,

        ],[
            'count'=>$request->productRating,
        ]);
        return back();
    }
}
