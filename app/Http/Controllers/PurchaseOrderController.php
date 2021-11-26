<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\Supplier;
use App\Models\purchaseOrder;
use Session;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Contracts\Session\Session as SessionSession;

class PurchaseOrderController extends Controller
{


    public function view(){

        Return view('admin.adminPurchaseOrderPage');

    }

    public function insertPurchaseOrder(){
        $docno = 'PO-'.rand();

        return view('admin.insertPurchaseOrder',compact('docno'))->with('SupplierID',Supplier::all());
    }

}
