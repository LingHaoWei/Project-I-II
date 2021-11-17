<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\Supplier;
use Session;
use DB;

class shoppingPageController extends Controller
{
    public function view(){

        $product=DB::table('products')

        ->leftjoin('suppliers','suppliers.supplierID','=','products.SupplierID')
        ->leftjoin('categories','categories.categoryID','=','products.categoryID')
        ->leftjoin('brands','brands.brandID','=','products.brandID')
        ->select(
            'products.*','suppliers.id as supid','suppliers.supplierName as supname',
            'products.*','categories.name as catname',
            'products.*','brands.id as brandid','brands.name as brandname'
            )

        ->get();

        Return view('shoppingShowProductPage')->with('products',$product)
                                              ->with('categoryID',category::all())
                                              ->with('brandID',brand::all());

    }
    
    public function viewDetails($id){
        $products=product::all()->where('id',$id);
        //select * from where id='$id'

        Return view('shoppingShowProductDetails')->with('products',$products)
                                                 ->with('categoryID',category::all())
                                                 ->with('brandID',brand::all())
                                                 ->with('SupplierID',Supplier::all());
    }

    public function searchProduct(){
        $r=request();
        $keyword=$r->keyword;
        $product=DB::table('products')
        ->leftjoin('suppliers','suppliers.supplierID','=','products.SupplierID')
        ->leftjoin('categories','categories.categoryID','=','products.categoryID')
        ->leftjoin('brands','brands.brandID','=','products.brandID')
        ->select(
            'products.*','suppliers.id as supid','suppliers.supplierName as supname',
            'products.*','categories.id as catid','categories.name as catname',
            'products.*','brands.id as brandid','brands.name as brandname'
            )
        ->where('products.productID','like','%'.$keyword.'%') 
        ->orWhere('products.name','like','%'.$keyword.'%')
        ->orWhere('products.categoryID','like','%'.$keyword.'%')
        ->orWhere('products.brandID','like','%'.$keyword.'%')
        ->orWhere('products.supplierID','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->get();

        Return view('shoppingShowProductPage')->with('products',$product)
                                              ->with('categoryID',category::all())
                                              ->with('brandID',brand::all())
                                              ->with('SupplierID',Supplier::all());
    }

}
