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
use Stripe\OrderItem;
use Stripe\Product as StripeProduct;
use App\Mail\FulfillMail;
use Illuminate\Support\Facades\Mail;

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
            $image = $request->image;

            foreach($cid as $e=>$value){

                OrderDetail::create([
                    'orderID'=>$ra,
                    'userID'=>Auth::id(),
                    'image'=>$image[$e],
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
            'status'=>'Processing',
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
        $order= DB::table('orders')
        ->leftjoin('users','users.id','=','orders.userID')
        ->select('orders.*',)
        ->where('orders.userID','=',Auth::id())
        ->get();
        /*$order = DB::table('order_details')
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
        ->get();*/
        return view('order')->with('order',$order);
    }
    public function viewOrder($orderID){
        $od=DB::table('order_details')
        ->leftjoin('users','users.id','=','order_details.userID')
        ->leftjoin('products','products.productID','=','order_details.productID')
        ->select(
            'order_details.*','users.*','users.address as address',
            'users.contact as contact','products.name as proname',
            'products.productVariety as provariety',
        )
        ->where('order_details.userID','=',Auth::id())
        ->where('orderID',$orderID)
        ->get();

        $contacts=DB::table('orders',)
        ->leftjoin('users','users.id','=','orders.userID')
        ->select('orders.*','users.contact as contact','users.name as usName',
        'users.zipcode as zipcode','users.city as city',
        'users.state as state','users.address as address',
        'users.email as useremail',
        )
        ->where('orders.userID','=',Auth::id())
        ->where('orders.orderID', '=', $orderID)
        ->get();
        //select * from where id='$id'

        Return view('orderDetail',compact('contacts','od'));

    }

    public function view(){
        $or=DB::table('orders')
        ->leftjoin('users','users.id','=','orders.userID')
        ->select('orders.*','users.name as username')
        ->paginate(10);
        Return view('admin.showOrder')->with('or',$or);
    }

    public function edit($id){
        $order=DB::table('orders')->where('orders.orderID', $id)
        ->leftjoin('users','users.id','=','orders.userID')
        ->select(
        'orders.*','orders.*','users.name as username',
        'users.email as useremail',
        )
        ->get();
        
        $orderDetail=DB::table('order_details')->where('order_details.orderID', $id)
        ->leftJoin('products', 'products.productID', '=', 'order_details.productID')
        ->select(
            'order_details.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.editOrder',compact('order','orderDetail'));
    }

    public function update($id, Request $request){

        $shippingAddress = $request->ShippingAddress;
        $contactNumber = $request->ContactNumber;
        $email = $request->EmailAddress;
        $status = $request->status;
        $trackingNumber = $request->TrackingNo;
        $orderNumber = $request->orderID;

        Order::where('orderID',$id)->update([
            'status'=> $status,
            'address'=> $shippingAddress,
            'contact'=> $contactNumber,
            'tracking_no' =>  $trackingNumber,
        ]);

        $ordProID = $request->odproid;
        $ordQuantity = $request->orderqt;

        if($status == 'Fulfilled'){
            Mail::to($email)->send(new FulfillMail());
        }else{
            foreach($ordQuantity as $e=>$orqt){
                $getQuantity = product::where(['productID'=>$ordProID[$e]])->first()->toArray();
                $stock = $getQuantity['quantity'] + $orqt;
                product::where(['productID'=>$ordProID[$e]])->update([
                    'quantity'=>$stock,
                ]);
            }
            product::all();
        }

        return redirect()->route('viewOrder');
    }
}
