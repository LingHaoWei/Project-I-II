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

        Return view('shoppingShowProductPage')->with('products',$product);

    }
    
    public function viewDetails($id){
        $products=product::all()->where('id',$id);
        //select * from where id='$id'

        Return view('shoppingShowProductDetails')->with('products',$products)
                                    ->with('categoryID',category::all())
                                    ->with('brandID',brand::all())
                                    ->with('SupplierID',Supplier::all());
    }

}
