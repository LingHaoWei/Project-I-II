<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\product;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function add(){
        $r=request();
        $addItem=myCart::create([
            'quantity'=>$r->quantity,
            'orderID'=>'',
            'productID'=>$r->id,
            'userID'=>Auth::id(),
        ]);
        Return redirect()->route('shoppingShowProductPage');
    }

    public function showMyCart(){
        $carts=DB::table('carts')
        ->leftjoin('products','products.productID','=','carts.productID')
        ->select('products.name as cartName','carts.id as cid', 'products.*')
        ->where('carts.orderID','=','')
        ->where('carts.userID','=',Auth::id())
        ->get();
    Return view('shoppingCartPage')->with('carts',$carts);
    }

}
