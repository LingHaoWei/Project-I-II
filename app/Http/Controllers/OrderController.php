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
use App\Models\OrderDetail;
use Notification;
use Stripe\Product as StripeProduct;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function paymentPost(Request $request)
    {
        try {
            $ra = rand();
            $cid = $request->cid;
            $productID = $request->id;
            $name = $request->name;
            $quantity = $request->quantity;
            $price=$request->price;
            $status = $request->status;

            foreach($cid as $e=>$value){

                OrderDetail::create([
                    'orderID'=>$ra,
                    'userID'=>Auth::id(),
                    'price'=>$price[$e],
                    'name'=>$name[$e],
                    'quantity'=>$quantity[$e],
                    'productID'=>$productID[$e],
                    'status'=>$status[$e],

                ]);
            }
        }catch(\Exception $e){

        }


	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->sub1*100,
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);
        $data = $request->all();
        $newOrder=Order::Create([
            'orderID'=>$ra,
            'paymentStatus'=>'Done',
            'userID'=>Auth::id(),
            'amount'=>$request->sub1,
            'address'=>$request->address,
            'contact'=>$request->contact,
        ]);
        /*$newOrder=Order::Create([
            'orderID'=>'',
            'userID'=>Auth::id(),
            'name'=>$request->name,
            'quantity'=>$request->quantity,
            'productID'=>$request->cid,
        ]);*/

        /*$loop = $request->get('cid');
        $deta = new orderDetail;

        foreach($data['cid'] as $i => $id){
            $deta->orderID = '';
            $deta->userID = Auth::id();
            $deta->name = $request->name;
            $deta->quantity = $request->quantity;
            $deta->productID = $value;
            $deta->save();
            $pu=Product::find($id);
            $pu=Orderdetail::Create([
                'orderID'=>'',
                'userID'=>Auth::id(),
                'name'=>$request->name,
                'quantity'=>$request->quantity,
                'productID'=>$request->id,
            ]);
        }*/
        /*foreach($data['cid'] as $key=>$value){
            $deta = new OrderDetail;
            if(in_array($value,$request->cid)){
                $dx= $request->except(['_token','_method']);
                dd($dx);
            $deta->orderID = $value;
            $deta->userID = Auth::id();
            $deta->name = implode(",",$request->name);
            $deta->quantity = implode(",",$request->quantity);
            $deta->productID = implode(",",$request->cid);
            $deta->save();
            }
        /*$insert = [
            'orderID'=>'',
            'userID'=>Auth::id(),
            'name'=>$request->name,
            'quantity'=>$request->quantity,
            'productID'=>$request->id,
        ];
        DB::table('order_details')->insert($insert);*/


        $orderID=DB::table('orders')->where('userID','=',Auth::id())->orderBy('created_at','desc')->first();

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
    public function showOrder(){
        $order = DB::table('order_details')
        ->leftjoin('users','users.id','=','order_details.userID')
        ->select('order_details.orderID','order_details.name as orderName','order_details.quantity','order_details.price','users.*','users.address as address','users.contact as contact')
        ->where('order_details.userID','=',Auth::id())
        ->get();
        $address=DB::table('users')
        ->leftjoin('carts','carts.userID','=','users.id')
        ->select('users.address as address')
        ->where('carts.userID','=',Auth::id())
        ->take(1)
        ->get();
        $contact=DB::table('users')
        ->leftjoin('carts','carts.userID','=','users.id')
        ->select('users.contact as contact')
        ->where('carts.userID','=',Auth::id())
        ->take(1)
        ->get();
        return view('order',compact('address','contact'))->with('order',$order);
    }
}
