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

    public function uploadContent(Request $request)
    {
        $file = $request->file('uploaded_file');
        if ($file) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize(); //Get size of uploaded file in bytes
        //Check for file extension and size
        $this->checkUploadedFileProperties($extension, $fileSize);
        //Where uploaded file will be stored on the server 
        $location = 'uploads'; //Created an "uploads" folder for that
        // Upload file
        $file->move($location, $filename);
        // In case the uploaded file path is to be stored in the database 
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");
        $importData_arr = array(); // Read through the file and store the contents as an array
        $i = 0;
        //Read the contents of the uploaded file 
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
        $num = count($filedata);
        // Skip first row (Remove below comment if you want to skip the first row)
        if ($i == 0) {
        $i++;
        continue;
        }
        for ($c = 0; $c < $num; $c++) {
        $importData_arr[$i][] = $filedata[$c];
        }
        $i++;
        }
        fclose($file); //Close after reading
        $j = 0;
        foreach ($importData_arr as $importData) {
        
        $j++;
        try {
        DB::beginTransaction();
        product::create([
        'productID' => $importData[0],
        'name' => $importData[1],
        'description' => $importData[2],
        'quantity' => $importData[3],
        'price' => $importData[4],
        'unitPrice' => $importData[5],
        'productVariety' => $importData[6],
        'productSKU' => $importData[7],
        'image' => $importData[8],
        'categoryID' => $importData[9],
        'brandID' => $importData[10],
        'supplierID' => $importData[11],
        'status' => $importData[12],
        ]);
        
        DB::commit();
        } catch (\Exception $e) {
        //throw $th;
        DB::rollBack();
        }
        }
        Session::flash('sucess',"Products uploaded!");
        return redirect()->route('viewProduct');
        } else {
        //no file was uploaded
        throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
        if ($fileSize <= $maxFileSize) {
        } else {
        throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
        }
        } else {
        throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

}
