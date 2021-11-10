<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\category;
use App\Models\product;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addCategory=category::create([
            'categoryID'=>$r->CategoryID,  //'id' is database field name, categoryID is HTML input
            'name'=>$r->CategoryName,
            'status'=>$r->status,
        ]);
        Return redirect()->route('viewCategory');
        }

    public function category(){
        $category=category::all();//apply SQL select * from categories
        Return view('InsertCategory')->with('category',$category);
    }

    public function view(){
        $category=category::all();//apply SQL select * from categories
        Return view('showCategory')->with('category',$category);
    }

    public function edit($id){
        $category=category::all()->where('id',$id);
        //select * from where id='$id'

        Return view('editCategory')->with('category',$category);
    }

    public function update(){
        $r=request();
        $category=category::find($r->id); //retrieve the record based on id

        $category->categoryID=$r->CategoryID;
        $category->name=$r->CategoryName;
        $category->status=$r->status;
        $category->save();

        Return redirect()->route('viewCategory');
    }

    public function delete($id){
        $data=category::find($id);
        
        $data->delete();
        Return redirect()->route('viewCategory');
    }

    public function search(){
        
    }

}
