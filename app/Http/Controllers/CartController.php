<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use DB;
use Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use App\Models\product;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function add(Request $r){
        $r->validate([
            'productCartID'=>'required|unique:carts',
        ]);
        $addItem=Cart::create([
        'quantity'=>$r->quantity,
        'orderID'=>'',
        'productID'=>$r->productID,
        'productCartID'=>$r->productCartID,
        'userID'=>Auth::id(),
        ]);
        session()->flash('error');
        Return redirect()->route('shoppingShowProductPage');
    }

    public function showMyCart(){
        $carts=DB::table('carts')
        ->leftjoin('products','products.productID','=','carts.productID')
        ->select('products.name as cartName','carts.id as cid','carts.quantity as cartQty', 'products.*')
        ->where('carts.orderID','=','')
        ->where('carts.userID','=',Auth::id())
        ->get();
    Return view('shoppingCartPage')->with('carts',$carts);
    }

    public function delete($id){
        $data=Cart::find($id);
        $data->delete();
        Return redirect()->route('myCart');
    }
    public function update()
    {
        $r=request();
        $cart=Cart::find($r->cid);
        $cart->quantity=$r->quantity;
        $cart->save();

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('myCart');
    }
}
