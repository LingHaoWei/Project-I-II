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
use App\Models\DeliveryOrder;
use App\Models\Invoice;
use Validator;
use Session;
use DB;
use PDF;
use Dompdf\Dompdf;
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
            $status = $request->status;
            $notes = $request->poNotes;

            $id_po = purchaseOrder::insertGetId([
                'document_no' => $document_no,
                'supplierID' => $SupplierID,
                'status' =>  $status,
                'notes' => $notes,
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
                    'received_quantity' => "0",
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

    public function previewPrint($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.printPurchaseOrder',compact('PurchaseOrder','PurchaseOrderR'));
    }

    public function updatePO($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.updatePurchaseOrder',compact('PurchaseOrder','PurchaseOrderR'));
    }

    public function savePO($id, Request $request){

        $notes = $request->poNotes;
        $status = $request->status;

        purchaseOrder::where('id',$id)->update([
            'notes'=> $notes,
            'status' => $status,
        ]);

        return redirect()->route('viewPurchaseOrderDetail',$id);
    }

    // *** Delivery Order Controller *** //

    public function viewDOList($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail',
        'suppliers.supplierID as supiid',
        )
        ->get();

        $DeliveryOrder=DB::table('delivery_orders')->where('delivery_orders.purchase_order', $id)
        ->select(
            'delivery_orders.*',
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.showDeliveryOrder',compact('PurchaseOrder','PurchaseOrderR','DeliveryOrder'));
    }

    public function previewDO($id){
        $DeliveryOrderID = DB::table('delivery_orders')->where('delivery_order_no',$id)
        ->leftjoin('purchase_orders', 'purchase_orders.id', '=', 'delivery_orders.purchase_order')
        ->leftjoin('suppliers','suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
            'delivery_orders.*','purchase_orders.document_no as podocno','purchase_orders.notes as note',
            'suppliers.supplierName as supname','suppliers.address as supadd',
            'suppliers.state as supstate','suppliers.city as supcity',
            'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
            'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail',
            'suppliers.supplierID as supiid',
        )
        ->take(1)
        ->get();

        $DeliveryOrder=DB::table('delivery_orders')->where('delivery_orders.delivery_order_no', $id)
        ->leftJoin('products', 'products.productID', '=', 'delivery_orders.productID')
        ->select(
            'delivery_orders.*','products.name as proname',
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.poDeliveryOrder',compact('PurchaseOrderR','DeliveryOrder','DeliveryOrderID'));
    }

    public function updateDO($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.updateDeliveryOrder',compact('PurchaseOrder','PurchaseOrderR'));
    }

    public function saveDO($id, Request $request){

        $purchaseId = $request->id;
        $notes = $request->poNotes;
        $deliveryOrderNo = $request->DeliveryOrderNo;
        $date = $request->date;

        $proID = $request->productID;
        $rquantity = $request->receivedQuantity;

        purchaseOrder::where('id',$id)->update([
            'notes'=> $notes,
            'delivery_order' => $deliveryOrderNo,
        ]);

        foreach($rquantity as $e=>$rqt) {
            
            $getQuantity = purchaseOderR::where('purchase_order',$id)->where(['productID'=>$proID[$e]])->first()->toArray();
            $rrqtl[$e] = $getQuantity['quantity'];
            $rqtl[$e] = $getQuantity['received_quantity'] + $rqt;

            if($rqtl[$e] > $rrqtl[$e]){
                Session::flash('failed',"Quantity inserted exceed your order quantity!");
                break;
            } else {
                purchaseOderR::where('purchase_order',$id)->where('productID',$proID[$e])->update([
                    'received_quantity' => $rqtl[$e],
                ]);
                $getQuantity = product::where(['productID'=>$proID[$e]])->first()->toArray();
                $stock = $getQuantity['quantity'] + $rqt;
                product::where(['productID'=>$proID[$e]])->update([
                'quantity'=>$stock,
                'status'=>'Available'
            ]);

                DeliveryOrder::insert([
                    'purchase_order' => $purchaseId, 
                    'delivery_order_no' => $deliveryOrderNo,
                    'productID' => $proID[$e],
                    'sent_quantity' => $rqt,
                    'created_at' => $date 
                ]);
                Session::flash('sucess',"Delivery Order added!");
            }
            
        }

        return redirect()->route('viewDOHistory',$id);
    }

    // *** Invoice Controller *** //

    public function previewInvoice($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.poInvoice',compact('PurchaseOrder','PurchaseOrderR'));
    }

    public function updateINV($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->get();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->get();
        
        //select * from where id='$id'

        return view('admin.updateInvoice',compact('PurchaseOrder','PurchaseOrderR'));
    }

    public function saveINV($id, Request $request){

        $notes = $request->poNotes;
        $InvoiceNo = $request->InvoiceNo;

        purchaseOrder::where('id',$id)->update([
            'notes'=> $notes,
            'invoice_no' => $InvoiceNo
        ]);

        Invoice::insert([
            'purchase_order' => $id, 
            'invoice_no' => $InvoiceNo,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('sucess',"Invoice updated!");

        return redirect()->route('viewInvoice',$id);
    }

    public function searchPO(){
        $r=request();
        $keyword=$r->keyword;
        $purchaseOrder = DB::table('purchase_orders')

        ->leftjoin('suppliers','suppliers.id','=','purchase_orders.supplierID')
        ->select(
            'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
            )
        ->where('purchase_orders.document_no','like','%'.$keyword.'%')
        ->orWhere('suppliers.supplierName','like','%'.$keyword.'%')
        ->paginate(10);

        Return view('admin.adminPurchaseOrderPage',compact('purchaseOrder'));
    }

    public function deletePO($id){       
        $data =DB::table('purchase_orders')
                    ->leftJoin('purchase_oder_r_s','purchase_orders.id', '=','purchase_oder_r_s.purchase_order')
                    ->where('purchase_orders.id', $id); 
        DB::table('purchase_oder_r_s')->where('purchase_order', $id)->delete();                           
        $data->delete();
        return redirect()->route('viewPurchaseOrder')->with('success', 'Data Deleted');
    }

}
