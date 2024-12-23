<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //Product Review
    public function userreview($id,Request $request){
        $userid = auth()->user()->id;
        $this->minivalitade($request);
    //dd($userid,$request,$id);
      Comment::create([
        'user_id' => $userid,
        'product_id' => $id,
        'message' => $request->message,
      ]);
      return back();
    }

    //minivalidate
    private function minivalitade(Request $request){
        $request->validate([
            'message' => 'required'
        ]);
    }

    //delete
    public function delete($id){
        Comment::where('id',$id)->delete();
        return back();
    }

}
