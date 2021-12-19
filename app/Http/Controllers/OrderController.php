<?php

namespace App\Http\Controllers;

use Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\product;
use App\Models\Order;
use Notification;


class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function paymentPost(Request $request)
    {


	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->sub*100,
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);

        $newOrder=Order::Create([
            'orderID'=>'',
            'paymentStatus'=>'Done',
            'userID'=>Auth::id(),
            'amount'=>$request->sub,
            'address'=>$request->address,
            'contact'=>$request->contact,
        ]);

        $orderID=DB::table('orders')->where('userID','=',Auth::id())->orderBy('created_at','desc')->first();

        $data = $request->all();

        foreach ($data['cid'] as $i => $id) {

            $pur=Cart::find($id);

        $pur->delete();
        $getQuantity = product::where(['productID'=>$pur['productID']])->first()->toArray();
        $stock = $getQuantity['quantity']- $pur['quantity'];
        product::where(['productID'=>$pur['productID']])->update(['quantity'=>$stock]);
        }


        Session::flash('success','Order successfully!');

        return back();
    }
}
