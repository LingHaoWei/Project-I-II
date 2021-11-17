<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\User;

class adminSettingPageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function viewAdmin(){
        $user=User::all();
        Return view('showStaff')->with('users',$user);
    }

    public function deleteAdmin($id){
        $data=User::find($id);
        $data->delete();
        return redirect('admin.showStaff');
    }

}
