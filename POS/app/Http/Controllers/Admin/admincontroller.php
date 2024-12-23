<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\product;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    // //driect user home
    public function adminHome(){
       $tsell = PaymentHistory::sum('total_amt');
       $tstock = Order::sum('count');
       $success = Order::where('status',1)->get();
       $pend = Order::where('status',0)->get();

        $review = Contact::select('users.name as username','contacts.title','contacts.message','contacts.created_at')
                        ->leftJoin('users','users.id','contacts.user_id')
                        ->get();
        $product = product::where('stock','<=',10)->paginate(3);

        return view('admin.home.list',compact('tsell','tstock','success','pend','review','product'));
    }
}
