<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Psy\Command\WhereamiCommand;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class PaymentController extends Controller
{

        //order List
        public function orderlist($id){

            $order = Order::where('user_id',$id)
                    ->select('payment_histories.address', 'payment_histories.total_amt','orders.created_at' ,'orders.order_code','orders.status')
                    ->leftJoin('payment_histories','payment_histories.order_code','orders.order_code')
                    ->groupBy('order_code')
                    ->get();

            return view('user.home.order',compact('order'));
        }






     //order
   public function order(Request $request){
    //dd($request);
        $request->validate([
            'user_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_slip' => 'required',
            'payment_method' => 'required',
        ]);

        $imagename = uniqid().$request->file('payment_slip')->getClientOriginalname();
        $request->file('payment_slip')->move(public_path().'/payslip/',$imagename);
        //dd($imagename);
        PaymentHistory::create([
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payslip_img' => $imagename,
            'payment_method' => $request->payment_method,
            'order_code' =>$request->order_code,
            'total_amt' => $request->total_amt,
        ]);
        $cartdata = Session::get('tempcart');
           foreach($cartdata as $item){

                Order::create([
                    'user_id' => $item['user_id'],
                    'product_id' => $item['product_id'],
                    'count' => $item['count'],
                    'status' => $item['status'],
                    'order_code' =>  $item['order_code'],

                ]);

              $id = $item['user_id'];
              $ptid = $item['product_id'];
              //dd($id,$ptid);
                Cart::where('user_id',$id)
                    ->where('product_id',$ptid)
                    ->delete();
           }

       Alert::success('Success','Order Added Successfully');
        return to_route('userHome');



   }

     //payment
     public function payment(){
        $cartdata = Session::get('tempcart');
        $payment = Payment::get();
       //dd($cartdata);
        return view('user.home.payment',compact('cartdata','payment'));
    }

    public function paymentpage(){
        return view('admin.payment.payment');
    }

    public function paymentadd(Request $request){
        //dd('yess');
        $this->Checkvali($request);

        Payment::create([
            'account_name'=>$request->accountname,
            'account_number'=>$request->accountnumber,
            'account_type'=>$request->accounttype,
            'banking_name'=>$request->bankingname,

        ]);
       Alert::success('Success','Payment Added Successfully');
        return back();
    }

    //paymentlistpage
    public function allpayment(){
        $data = Payment::orderBy('created_at','asc')->paginate(5);
       return view('admin.payment.allpayment',compact('data'));
    }

    //delete
    public function paymentdelete($id){
       //dd($id);
       Payment::where('id',$id)->delete();
       return back();
    }

    //update
   public function paymentedit($id,Request $request){
    //dd($id,$request);
    $this->Checkvali($request);
    Payment::where('id',$id)->update([
        'account_name'=>$request->accountname,
        'account_number'=>$request->accountnumber,
        'account_type'=>$request->accounttype,
        'banking_name'=>$request->bankingname,
    ]);
    return to_route('page');
   }

    //updatepage
    public function paymentupdatepage($id){
        $paymentdata = Payment::where('id',$id)->get();
        return view('admin.payment.update',compact('paymentdata'));
    }



    //validation
    private function Checkvali($request){
        $request->validate([
            'accountname' => 'required',
            'accounttype' => 'required',
            'accountnumber' => 'required',
            'bankingname' => 'required',
        ]);
    }


}
