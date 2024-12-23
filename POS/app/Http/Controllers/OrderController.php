<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //orderview
    public function orderview($order_code){
        $order = Order::where('orders.order_code',$order_code)
                ->select('products.name as pname','products.stock as pstock','products.photo as pphoto','products.price','products.id as product_id',
                         'orders.created_at' ,'orders.order_code','orders.count as ostock','orders.status')
                ->leftJoin('users','users.id','orders.user_id')
                ->leftJoin('products','products.id','orders.product_id')
                ->paginate(2);

        $payment = PaymentHistory::where('payment_histories.order_code',$order_code)
                                    ->select('payment_histories.user_name','payment_histories.phone','payment_histories.address','payment_histories.payment_method',
                                            'payment_histories.total_amt','payment_histories.payslip_img','payment_histories.created_at','payment_histories.order_code',
                                            'users.phone as uphone','users.address as uaddress')
                                    ->leftJoin('users','users.name','payment_histories.user_name')
                                    ->get();
                                    $status = [];
                                    $stc = true ;
                                      foreach($order as $item){
                                       array_push($status,$item->pstock < $item->ostock ? false : true) ;
                                      }

                                      foreach($status as $item){
                                         if($item == false){
                                             $stc = false ; break;
                                         }
                                      }
                                      //dd($stc);
        return view('admin.order.order',compact('order','payment','stc'));
    }

    //all order


    public function orderboard(){
        $order = Order::select('users.name as userid','payment_histories.address', 'payment_histories.total_amt','orders.created_at' ,'orders.order_code','orders.status')
                        ->leftJoin('payment_histories','payment_histories.order_code','orders.order_code')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->when(request('searchkey'),function($search){
                            $search->whereAny(['payment_histories.address','users.name' ,'orders.order_code','payment_histories.total_amt'],'like','%'.request('searchkey').'%');
                         })
                        ->groupBy('order_code')
                        ->orderBy('orders.created_at','desc')
                        ->paginate(5);



        return view('admin.order.orderboad',compact('order'));
    }

    //order status
    public function changest(Request $request){
        Order::where('order_code',$request['order_code'])->update([
            'status' => $request['status']
        ]);
        return response()->json([
            'status' => 'success'
        ],200);
    }

    //confirm
    public function confirm(Request $request){
       Order::where('order_code',$request[0]['order_code'])->update([
            'status' => 1
       ]);

       foreach($request->all() as $item){
        product::where('id',$item['product_id'])->decrement('stock',$item['count']);

        //$currentStock = product::where('id',$item['product_id'])->select('stock')->get();
       }

       return response()->json([
        'status' => 'success'
       ],200);
    }

    //rj order
    public function reject(Request $request){
        logger($request->all());
        Order::where('order_code',$request['order_code'])->update([
             'status' => 2
        ]);

        return response()->json([
         'status' => 'success'
        ],200);
     }
}
