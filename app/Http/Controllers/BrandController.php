<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\brand;
use Session;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Contracts\Session\Session as SessionSession;

class BrandController extends Controller
{


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
        Return view('admin.InsertBrand')->with('brand',$brand);
    }

    public function view(){
        $brand=DB::table('brands')->paginate(10);//apply SQL select * from categories
        Return view('admin.showBrand')->with('brand',$brand);
    }

    public function edit($id){
        $brand=brand::all()->where('id',$id);
        //select * from where id='$id'

        Return view('admin.editBrand')->with('brand',$brand);
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
        Return redirect()->route('viewBrand');
    }

    public function searchBrand(){
        $r=request();
        $keyword=$r->keyword;
        $brand=DB::table('brands')
        ->select('brands.*')
        ->where('brands.brandID','like','%'.$keyword.'%') 
        ->orWhere('brands.name','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->paginate(10);

        Return view('admin.showBrand')->with('brand',$brand);
    }

}
