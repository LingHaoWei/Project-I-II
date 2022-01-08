<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\User;
use Auth;
use Session;


class UserController extends Controller
{
    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $r->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $addUser=User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'contact'=>$r->contact,
            'address'=>$r->address,
            'state'=>$r->state,
            'zipcode'=>$r->zipcode,
            'city'=>$r->city,
            'password'=>$r->password,
        ]);


        Return redirect()->route('viewUser');
    }

    public function user(){
        $users=User::all();//apply SQL select * from categories
        Return view('admin.insertUser')->with('users',$users);
    }

    public function viewUser(){
        $user=User::all();//apply SQL select * from categories
        Return view('admin.showUser')->with('user',$user);
    }

    public function delete($id){
        $data=User::find($id);
        $data->delete();
        Session::flash('success',"User deleted successfully!");
        Return redirect()->route('viewUser');
    }

    public function searchUser(){
        $r=request();
        $keyword=$r->keyword;
        $user=DB::table('users')
        ->where('users.id','like','%'.$keyword.'%')
        ->orWhere('users.name','like','%'.$keyword.'%')
        //select * from products where name like '%$keyword%'
        ->get();

        Return view('admin.showUser')->with('user',$user);
    }

    public function edit($id){
        $users=DB::table('users')->where('id',$id)->get();
        //select * from where id='$id'

        Return view('admin.editUser')->with('users',$users);
    }

    public function update(){
        $r=request();
        $users=User::find($r->id);

        $users->name=$r->name;
        $users->email=$r->email;
        $users->contact=$r->contact;
        $users->address=$r->address;
        $users->state=$r->state;
        $users->zipcode=$r->zipcode;
        $users->city=$r->city;
        $users->save();

        Return redirect()->route('viewUser');
    }

    public function acc(){
        $users= DB::table('users')
        ->select('users.*')
        ->where('users.id','=',Auth::id())
        ->get();

        return view('account')->with('users',$users);
    }

    public function updateUser(){
        $r=request();
        $users=User::find($r->id);

        $users->name=$r->name;
        $users->email=$r->email;
        $users->contact=$r->contact;
        $users->address=$r->address;
        $users->state=$r->state;
        $users->zipcode=$r->zipcode;
        $users->city=$r->city;
        $users->save();

        session()->flash('success', 'Settings Updated Successfully !');
        return redirect()->route('myAccount');
    }
}
