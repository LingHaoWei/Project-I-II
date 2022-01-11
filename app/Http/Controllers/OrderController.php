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
use App\Models\OfflineOrder;
use App\Models\OfflineOrder_Details;
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

    public function adminSearchOrder(){
        $r=request();
        $keyword=$r->keyword;
        $or = DB::table('orders')
        ->leftjoin('users','users.id','=','orders.userID')
        ->select('orders.*','users.name as username')
        ->where('orders.orderID','like','%'.$keyword.'%')
        ->orWhere('orders.status','like','%'.$keyword.'%')
        ->orWhere('users.name','like','%'.$keyword.'%')
        ->paginate(10);

        Return view('admin.showOrder',compact('or'));
    }

    public function viewOfflineOrder(){
        
        $OfflineOrder=DB::table('offline_orders')
        ->select(
        'offline_orders.*'
        )
        ->paginate(10);

        Return view('admin.showOfflineOrder', compact('OfflineOrder'));
    }

    public function insertOfflineOrder(){

        $orVal = rand() % (1000 + 1 - 0) + 0;
        $invVal = rand() % (1000 + 1 - 0) + 0;
        $docno = 'OR-'.date('Y').$orVal;
        $invno = 'IN-'.date('Y').$invVal;
        $product = product::all();

        return view('admin.getOfflineOrderProduct',compact('docno','invno','product'));

    }

    public function storeOfflineOrder(Request $request){
        try{
            $productID = $request->product;
            $quantity = $request->poQty;

            $OrderNo = $request->OrderNo;
            $InvoiceNo = $request->InvoiceNo;
            $status = $request->status;
            $payment = $request->payment;
            $notes = $request->orderNotes;

            $id_order = OfflineOrder::insertGetId([
                'order_no' => $OrderNo,
                'status' =>  $status,
                'notes' => $notes,
                'invoice_no' => $InvoiceNo,
                'Payment' => $payment,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            foreach($quantity as $e=>$qt) {
                if($qt == 0){
                    continue;
                }

                $getQuantity = product::where(['productID'=>$productID[$e]])->first()->toArray();
                $stock = $getQuantity['quantity'] - $qt;
                product::where(['productID'=>$productID[$e]])->update([
                'quantity'=>$stock,
                ]);

                $dt_product = product::where('productID',$productID[$e])->first();
                $price = $dt_product->price;
                $grand_total = $qt * $price;

                OfflineOrder_Details::insert([
                    'orderID' => $id_order, 
                    'productID' => $productID[$e],
                    'quantity' => $qt,
                    'Price' => $price,
                    'grand_total' => $grand_total,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            
            \Session::flash('Sucess','Offline Order added');
        } catch (\Exeption $e) {
            \Session::flash('failed',$e->getMessage());
        }

        return redirect()->route('viewOfflineOrder');
    }

    public function viewOfflineOrderDetail($id){
        $OfflineOrder=DB::table('offline_orders')->where('offline_orders.id',$id)
        ->select(
        'offline_orders.*'
        )
        ->get();

        $OfflineOrderDetails=DB::table('offline_order__details')->where('offline_order__details.orderID',$id)
        ->leftJoin('products', 'products.productID', '=', 'offline_order__details.productID')
        ->select(
            'offline_order__details.*','products.productID as proid','products.name as proname',
            )
        ->get();

        Return view('admin.viewOfflineOrderDetails', compact('OfflineOrder','OfflineOrderDetails'));
        
    }

    public function searchOfflineOrder(){
        $r=request();
        $keyword=$r->keyword;
        $OfflineOrder=DB::table('offline_orders')
        ->select(
            'offline_orders.*'
        )
        ->where('offline_orders.order_no','like','%'.$keyword.'%') 
        ->orWhere('offline_orders.invoice_no','like','%'.$keyword.'%') 
        ->paginate(10);

        Return view('admin.showOfflineOrder', compact('OfflineOrder'));
    }

    public function deleteOfflineOrder($id, Request $request){       
        
        $qt=$request->quantity;
        $proID=$request->product;

            foreach($qt as $e=>$orqt){
                $getQuantity = product::where(['productID'=>$proID[$e]])->first()->toArray();
                $stock = $getQuantity['quantity'] + $orqt;
                product::where(['productID'=>$proID[$e]])->update([
                    'quantity'=>$stock,
                ]);
            }

        $data = DB::table('offline_orders')
                    ->leftJoin('offline_order__details','offline_orders.id', '=','offline_order__details.orderID')
                    ->where('offline_orders.id', $id); 
        DB::table('offline_order__details')->where('offline_order__details.orderID', $id)->delete();  
        $data->delete();
        return redirect()->route('viewOfflineOrder');
    }

}
