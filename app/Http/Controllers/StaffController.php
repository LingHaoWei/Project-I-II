<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Session;
use DB;

class StaffController extends Controller
{


    public function viewStaff(){
        $staff=Staff::all();
        Return view('showStaff')->with('staff',$staff);
    }

    public function staff(){
        $staff=Staff::all();//apply SQL select * from categories
        Return view('insertStaff')->with('staff',$staff);
    }

    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addStaff=Staff::create([
            'staffID'=>$r->staffID,  //'id' is database field name, categoryID is HTML input
            'image'=>$r->staffImage,
            'firstName'=>$r->firstName,
            'lastName'=>$r->lastName,
            'ICNumber'=>$r->ICNumber,
            'position'=>$r->position,
            'livingAddress'=>$r->livingAddress,
            'city'=>$r->city,
            'state'=>$r->state,
            'zipcode'=>$r->zipCode,
            'contactNumber'=>$r->ContactNumber,
            'emailAddress'=>$r->EmailAddress,
            'status'=>$r->status,
        ]);
        Return redirect()->route('showStaff');
    }

    public function edit($id){
        $staff=Staff::all()->where('id',$id);
        //select * from where id='$id'

        Return view('editStaff')->with('staff',$staff);
    }

    public function update(){
        $r=request();
        $staff=Staff::find($r->id); //retrieve the record based on id

        if($r->file('staff-image')!=''){
            $image=$r->file('staff-image');
            $image->move('images',$image->getClientOriginalName());   //images is the location
            $imageName=$image->getClientOriginalName();  //upload image
            $staff->image=$imageName; //update product table record
        }

        $staff->staffID=$r->staffID;
        $staff->firstName=$r->firstName;
        $staff->lastName=$r->lastName;
        $staff->ICNumber=$r->ICNumber;
        $staff->position=$r->position;
        $staff->livingAddress=$r->livingAddress;
        $staff->city=$r->city;
        $staff->state=$r->state;
        $staff->zipCode=$r->zipCode;
        $staff->contactNumber=$r->ContactNumber;
        $staff->emailAddress=$r->EmailAddress;
        $staff->status=$r->status;
        $staff->save();
        Session::flash('success',"Staff updated successfully!");

        Return redirect()->route('showStaff');
    }

    public function delete($id){
        $data=Staff::find($id);
        $data->delete();
        Session::flash('success',"Staff deleted successfully!");
        Return redirect()->route('showStaff');
    }

}
