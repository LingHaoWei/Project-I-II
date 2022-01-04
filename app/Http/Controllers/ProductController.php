<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\Supplier;
use Session;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Contracts\Session\Session as SessionSession;

class ProductController extends Controller
{


    public function store(){

        $r=request();
        $image=$r->file('product-image');
        $image->move('images',$image->getClientOriginalName());
        $imageName=$image->getClientOriginalName();

        $addProduct=product::create([

            'productID'=>$r->productID,
            'name'=>$r->productName,
            'description'=>$r->productDescription,
            'quantity'=>$r->productQuantity,
            'price'=>$r->productPrice,
            'unitPrice'=>$r->productUnitPrice,
            'productVariety'=>$r->productVariety,
            'productSKU'=>$r->productSKU,
            'image'=>$imageName,
            'categoryID'=>$r->categoryID,
            'brandID'=>$r->brandID,
            'supplierID'=>$r->SupplierID,
            'status'=>$r->status,
        ]);
        Return redirect()->route('viewProduct');
    }
    public function view(){
        
        $product=DB::table('products')

        ->leftjoin('suppliers','suppliers.supplierID','=','products.supplierID')
        ->leftjoin('categories','categories.categoryID','=','products.categoryID')
        ->leftjoin('brands','brands.brandID','=','products.brandID')
        ->select(
            'products.*','suppliers.id as supid','suppliers.supplierName as supname',
            'products.*','categories.name as catname',
            'products.*','brands.id as brandid','brands.name as brandname'
            )
        
        ->paginate(6);
        
        Return view('admin.showProduct')->with('products',$product);

    }

    public function product(){
        $product=product::all();//apply SQL select * from categories
        Return view('admin.insertProduct')->with('products',$product);
    }

    public function edit($id){
        $products=product::all()->where('id',$id);
        //select * from where id='$id'

        Return view('admin.editProduct')->with('products',$products)
                                    ->with('categoryID',category::all())
                                    ->with('brandID',brand::all())
                                    ->with('SupplierID',Supplier::all());
    }

    public function update(){
        $r=request();
        $products=product::find($r->id); //retrieve the record based on id

        if($r->file('product-image')!=''){
            $image=$r->file('product-image');
            $image->move('images',$image->getClientOriginalName());   //images is the location
            $imageName=$image->getClientOriginalName();  //upload image
            $products->image=$imageName; //update product table record
        }

        $products->productID=$r->productID;
        $products->name=$r->productName;
        $products->description=$r->productDescription;
        $products->quantity=$r->productQuantity;
        $products->price=$r->productPrice;
        $products->unitPrice=$r->productUnitPrice;
        $products->productVariety=$r->productVariety;
        $products->productSKU=$r->productSKU;
        $products->categoryID=$r->categoryID;
        $products->brandID=$r->brandID;
        $products->supplierID=$r->SupplierID;
        $products->status=$r->status;
        $products->save();
        Session::flash('success',"Product updated successfully!");

        Return redirect()->route('viewProduct');
    }

    public function delete($id){
        $data=product::find($id);
        $data->delete();
        Return redirect()->route('viewProduct');
    }

    public function adminSearchProduct(){
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
        ->where('products.productSKU','like','%'.$keyword.'%') 
        ->orWhere('products.name','like','%'.$keyword.'%')
        ->orWhere('categories.name','like','%'.$keyword.'%')
        ->orWhere('brands.name','like','%'.$keyword.'%')
        ->orWhere('suppliers.supplierName','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->paginate(6);

        Return view('admin.showProduct')->with('products',$product)
                                              ->with('categoryID',category::all())
                                              ->with('brandID',brand::all())
                                              ->with('SupplierID',Supplier::all());
    }

    public function storeUpload(Request $request){
        //get file 
        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        //read
        $file=fopen($filePath, 'r');

        $header= fgetcsv($file);

        //dd($header);
        $escapedHeader=[];
        //validate
        foreach($header as $key => $value){
            array_push($escapedHeader, $value);
        }

        //looping through other columns
        while($columns=fgetcsv($file)){
            if($columns[0]==""){
                continue;
            }
            //trim data
            foreach($columns as $key => &$value){
                $value=preg_replace('/\D/','',$value);
            }
            
            $data=array_combine($escapedHeader, $columns);

            //Tabel update
            $productID=$data['productID'];
            $name=$data['name'];
            $description=$data['description'];
            $quantity=$data['quantity'];
            $price=$data['price'];
            $unitPrice=$data['unitPrice'];
            $productVariety=$data['productVariety'];
            $productSKU=$data['productSKU'];
            $image=$data['image'];
            $categoryID=$data['categoryID'];
            $brandID=$data['brandID'];
            $supplierID=$data['supplierID'];
            $status=$data['status'];

            $products=product::fisrtOrNew([
                'productID'=>$productID,
                'name'=>$name,
                'description'=>$description,
                'quantity'=>$quantity,
                'price'=>$price,
                'unitPrice'=>$unitPrice,
                'productVariety'=>$productVariety,
                'productSKU'=>$productSKU,
                'image'=>$image,
                'categoryID'=>$categoryID,
                'brandID'=>$brandID,
                'supplierID'=>$supplierID,
                'status'=>$status,
            ]);
            $products->save();

        }
    }

}
