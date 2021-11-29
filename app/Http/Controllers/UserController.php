<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\User;

class UserController extends Controller
{
    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addUser=User::create([
            'id'=>$r->ID,  //'id' is database field name, categoryID is HTML input
            'name'=>$r->Name,
            'email'=>$r->Email,
            'contact'=>$r->ContactNumber,
            'address'=>$r->Address,
        ]);
        Return redirect()->route('viewUser');
    }

    public function viewUser(){
        $user=User::all();//apply SQL select * from categories
        Return view('admin.showUser')->with('user',$user);
    }

    public function delete($id){
        $data=User::find($id);
        $data->delete();
        Session::flash('success',"Supplier deleted successfully!");
        Return redirect()->route('viewUser');
    }

    public function searchSupplier(){
        $r=request();
        $keyword=$r->keyword;
        $user=DB::table('users')
        ->where('users.id','like','%'.$keyword.'%') 
        ->orWhere('users.name','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->get();

        Return view('admin.showUser')->with('user',$user);
    }
}
