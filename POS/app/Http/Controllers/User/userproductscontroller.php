<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\product;
use App\Models\categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\actionlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userproductscontroller extends Controller
{
        //user order dash board
    public function order($id){
        $order = Order::where('user_id',$id)
                    ->select('payment_histories.address', 'payment_histories.total_amt','orders.created_at' ,'orders.order_code','orders.status')
                    ->leftJoin('payment_histories','payment_histories.order_code','orders.order_code')
                    ->groupBy('order_code')
                    ->get();

            return view('user.profile.order',compact('order'));
    }

    //userproductdetails Related Product Categories
   public function userpdetails($id){
    $category = categorie::select('id','name')->paginate(5);

    $review = Comment::where('comments.product_id',$id)
            ->select('users.name as username','users.profile as userprofile','comments.product_id','comments.message','comments.created_at','comments.user_id','comments.id')
            ->leftJoin('users','users.id','comments.user_id')
            ->paginate(6);
    //dd($review);

    $details=product::where('products.id',$id)
                    ->select('categories.name as category_name','products.id','products.description','products.photo','products.price','products.stock','products.created_at','products.updated_at','products.name',)
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->get();

    $pcategory = product::where('products.id',$id)->select('products.category_id')->first();
    $category_id =$pcategory->category_id;
    $realted = product::where('products.category_id',$category_id )
            ->select('categories.name as category_name','products.id','products.photo','products.price','products.name','ratings.count')
            ->leftJoin('categories','products.category_id','categories.id')
            ->leftJoin('ratings','ratings.product_id','products.id')
            ->paginate(7);
    //dd($realted);

    $rating = Rating::where('product_id',$id)->avg('count');

    $userRt = Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->first('count');
    $userRt = $userRt == null ? 0 : $userRt['count']  ;

        actionlog::updateOrcreate([
            'user_id' => Auth::user()->id,
        ],[
            'product_id' => $id,
            'action' => 1 ,
        ]);
    $viewcount =actionlog::where('product_id',$id)->where('action', 1 )->get();
        return view ('user.Products.detail',compact('details','realted','category','review','rating','userRt','viewcount'));
   }





    //addtocard
    public function addtoCart($id,Request $request){
       if($request->qty){ $qty =$request->qty; }else{ $qty = 1; };
        Cart::create([
            'user_id' =>auth()->user()->id,
            'product_id' =>$id,
            'qty' =>$qty,
        ]);
        return to_route("userHome");
    }

         //cart temp
         public function carttemp(Request $request){
            $order = [];

         foreach($request->all() as $item){
            array_push($order,[
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['count'],
                'order_code' => $item['order_code'],
                'total_amt' => $item['total_amt'],

                'status' => 0,
            ]);

         }
            Session::put('tempcart',$order);

            return response()->json([
                'status' => 'success'
            ],200);
        }






}
