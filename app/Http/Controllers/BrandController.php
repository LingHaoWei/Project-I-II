<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\brand;
use Session;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addBrand=brand::create([
            'brandID'=>$r->BrandID,  //'id' is database field name, categoryID is HTML input
            'name'=>$r->BrandName,
            'status'=>$r->status,
        ]);
        Return redirect()->route('viewBrand');
    }

    public function brand(){
        $brand=brand::all();//apply SQL select * from categories
        Return view('InsertBrand')->with('brand',$brand);
    }

    public function view(){
        $brand=brand::all();//apply SQL select * from categories
        Return view('showBrand')->with('brand',$brand);
    }

    public function edit($id){
        $brand=brand::all()->where('id',$id);
        //select * from where id='$id'

        Return view('editBrand')->with('brand',$brand);
    }

    public function update(){
        $r=request();
        $brand=brand::find($r->id); //retrieve the record based on id

        $brand->brandID=$r->BrandID;
        $brand->name=$r->BrandName;
        $brand->status=$r->status;
        $brand->save();
        Session::flash('success',"Brand updated successfully!");

        Return redirect()->route('viewBrand');
    }

    public function delete($id){
        $data=brand::find($id);
        $data->delete();
        Session::flash('success',"Brand deleted successfully!");
        Return redirect()->route('viewBrand');
    }

}
