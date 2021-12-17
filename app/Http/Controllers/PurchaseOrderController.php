<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\Supplier;
use App\Models\purchaseOrder;
use App\Models\purchaseOderR;
use Validator;
use Session;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Contracts\Session\Session as SessionSession;

class PurchaseOrderController extends Controller
{


    public function view(){

        $purchaseOrder = DB::table('purchase_orders')

        ->leftjoin('suppliers','suppliers.id','=','purchase_orders.supplierID')
        ->select(
            'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
            )
        ->paginate(10);

        Return view('admin.adminPurchaseOrderPage',compact('purchaseOrder'));

    }

    public function insertPO(){

        $docno = null;

        $supplier = Supplier::orderBy('supplierName','asc')->get();
        $product = product::orderBy('name','asc')->get();

        return view('admin.insertPurchaseOrder',compact('docno','supplier','product'));
    }

    public function getProduct($id){

        $poVal = '0001';
        $docno = 'PO-'.date('Y').$poVal;
        $latestOrder = purchaseOrder::orderBy('created_at','DESC')->first();
        $supplier = Supplier::where('supplierID',$id)->get();
        $product = product::where('supplierID',$id)->get();

        return view('admin.insertPO',compact('docno','supplier','product'));
    }

    public function store(Request $request){
        try{
            $productID = $request->product;
            $quantity = $request->poQty;

            $document_no = Helper::IDGenerator(new purchaseOrder, 'document_no', 4, 'PO'.date('Y'));
            $SupplierID = $request->SupplierID;

            $id_po = purchaseOrder::insertGetId([
                'document_no' => $document_no,
                'supplierID' => $SupplierID,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            foreach($quantity as $e=>$qt) {
                if($qt == 0){
                    continue;
                }

                $dt_product = product::where('productID',$productID[$e])->first();
                $unitPrice = $dt_product->unitPrice;
                $grand_total = $qt * $unitPrice;

                purchaseOderR::insert([
                    'purchase_order' => $id_po, 
                    'productID' => $productID[$e],
                    'quantity' => $qt,
                    'unitPrice' => $unitPrice,
                    'grand_total' => $grand_total
                ]);
            }
            
            \Session::flash('Sucess','Purchase Order been placed');
        } catch (\Exeption $e) {
            \Session::flash('failed',$e->getMessage());
        }
        Return redirect()->route('viewPurchaseOrder');
    }

}
