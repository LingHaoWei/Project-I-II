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

        $purchaseOrder = purchaseOrder::all();

        Return view('admin.adminPurchaseOrderPage',compact('purchaseOrder'));

    }

    public function chooseSupplier(){

        $supplier = Supplier::orderBy('supplierName','asc')->get();

        return view('admin.purchaseOrderCSP',compact('supplier'));
    }

    public function getProduct($id){
        $docno = 'PO-'.rand();
        $supplier = Supplier::where('supplierID',$id)->get();
        $product = product::where('supplierID',$id)->get();

        return view('admin.insertPurchaseOrder',compact('docno','supplier','product'));
    }

    public function store(Request $request){
        try{
            $data = $request->except(['_token,_method']);
            dd($data);
        } catch (\Exeption $e) {
            \Session::flash('failed',$e->getMessage());
        }
    }

}
