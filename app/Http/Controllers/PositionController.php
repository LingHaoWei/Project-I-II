<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{



    public function insert(){

        $r=request();  //request  means  received  the form data  by method get or post
        $addPosition=Position::create([
            'position_ID'=>$r->position_ID,  //'id' is database field name, categoryID is HTML input
            'position_name'=>$r->position_name,
        ]);
        Return redirect()->route('viewAdminPage');
    }

}
