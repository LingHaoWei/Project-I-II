<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Supplier;
use Session;

class SupplierController extends Controller
{


    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addSupplier=Supplier::create([
            'supplierID'=>$r->SupplierID,  //'id' is database field name, categoryID is HTML input
            'supplierName'=>$r->SupplierName,
            'companyEmail'=>$r->CompanyEmail,
            'address'=>$r->SupplierAddress,
            'city'=>$r->City,
            'state'=>$r->State,
            'zipcode'=>$r->ZipCode,
            'contactPerson'=>$r->ContactPerson,
            'contactNumber'=>$r->ContactNumber,
            'emailAddress'=>$r->EmailAddress,
            'status'=>$r->status,
        ]);
        Return redirect()->route('viewSupplier');
        }

    public function supplier(){
        $supplier=Supplier::all();//apply SQL select * from categories
        Return view('admin.insertSupplier')->with('supplier',$supplier);
    }

    public function view(){
        $supplier=DB::table('suppliers')->paginate(10);//apply SQL select * from categories
        Return view('admin.showSupplier')->with('supplier',$supplier);
    }   

    public function edit($id){
        $supplier=Supplier::all()->where('id',$id);
        //select * from where id='$id'

        Return view('admin.editSupplier')->with('supplier',$supplier);
    }

    public function update(){
        $r=request();
        $supplier=Supplier::find($r->id); //retrieve the record based on id

        $supplier->supplierID=$r->SupplierID;
        $supplier->supplierName=$r->SupplierName;
        $supplier->companyEmail=$r->CompanyEmail;
        $supplier->address=$r->SupplierAddress;
        $supplier->city=$r->City;
        $supplier->state=$r->State;
        $supplier->zipcode=$r->ZipCode;
        $supplier->contactPerson=$r->ContactPerson;
        $supplier->contactNumber=$r->ContactNumber;
        $supplier->emailAddress=$r->EmailAddress;
        $supplier->status=$r->status;
        $supplier->save();
        Session::flash('success',"Supplier updated successfully!");

        Return redirect()->route('viewSupplier');
    }

    public function delete($id){
        $data=Supplier::find($id);
        $data->delete();
        Session::flash('success',"Supplier deleted successfully!");
        Return redirect()->route('viewSupplier');
    }

    public function searchSupplier(){
        $r=request();
        $keyword=$r->keyword;
        $supplier=DB::table('suppliers')
        ->where('suppliers.supplierID','like','%'.$keyword.'%') 
        ->orWhere('suppliers.supplierName','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->paginate(10);

        Return view('admin.showSupplier')->with('supplier',$supplier);
    }

}
