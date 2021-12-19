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

        $data=Cart::find($request->cid);
        $data->delete();


        $getQuantity = product::where(['productID'=>$data['productID']])->first();
        $stock = $getQuantity['quantity']- $data['quantity'];
        product::where(['productID'=>$data['productID']])->update(['quantity'=>$stock]);

        Session::flash('success','Order successfully!');

        return back();
    }
}
