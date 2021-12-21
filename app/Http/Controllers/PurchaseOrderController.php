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

    public function createPDF($id){
        $PurchaseOrder=DB::table('purchase_orders')->where('purchase_orders.id', $id)
        ->leftJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplierID')
        ->select(
        'purchase_orders.*','suppliers.id as supid','suppliers.supplierName as supname',
        'suppliers.address as supadd','suppliers.state as supstate','suppliers.city as supcity',
        'suppliers.zipcode as supzipcode','suppliers.contactPerson as supcp',
        'suppliers.contactNumber as supcn', 'suppliers.emailAddress as supemail'
        )
        ->first();
        
        $PurchaseOrderR=DB::table('purchase_oder_r_s')->where('purchase_oder_r_s.purchase_order', $id)
        ->leftJoin('products', 'products.productID', '=', 'purchase_oder_r_s.productID')
        ->select(
            'purchase_oder_r_s.*','products.productID as proid','products.name as proname',
            )
        ->first();

        $output = '
        <style>
        
        td .prc{
            width: 200px;
        }
    
        .poNotesArea textarea{
            width: 100%;
            height: 100px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    
        .poStatus input {
            outline: none;
            border: none;
        }
    
        .addRow {
            width: 99%;
        }
    
        .notesandstatus {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        
        .printPOBtn {
            background-color: #5ab071;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
        }
    
        .addPo{
            border: 1px solid #8b8b8b;
            border-radius: 5px 5px 0px 0px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }
    
    
    </style>
    
    <!--Page topic-->
    <!--Page topic-->
    
    <div class="content" id="pwrapper1">
      <div class="">
            
            <div class="pageTopic addPo">
                <div><h2>Purchase Order</h2></div>
    
            </div>
    
      </div>
      
      <div class="form addProForm row">
          
            <form method="POST" , action="#" enctype="multipart/form-data" id="dynamic_form">

            <div class="addRow">
            </div>

            <div class="form-group addProRow1">
                
                <div class="myAddress">
                
                My Sample Company Co.
                <br>
                info@sampleco.com
                <br>
                Sample Address, 23rd St., Sample City, ####
                <br></br>
    
                </div>
    
                <div class="supAddress">
                <br>
                <b>Vendor: '.$PurchaseOrder->supname.'</b><br>
                '.$PurchaseOrder->supadd.', <br> 
                '.$PurchaseOrder->supcity.', '.$PurchaseOrder->supzipcode.', '.$PurchaseOrder->supstate.'.<br>
                '.$PurchaseOrder->supcp.' <br>
                '.$PurchaseOrder->supcn.' <br>
                '.$PurchaseOrder->supemail.' <br></br>
                
    
                </div>
    
            </div>
            
            
            <div class="form-group addProRow2">
                <label class="" for="Document No"><b>P.O. #:</b></label>
                <div class="">
                    '.$PurchaseOrder->document_no.'
                    <br></br>
                    <br>
                    
                </div>
                <label class="" for="Document No"><b>Date Created:</b></label>
                <div class="">
                '.$PurchaseOrder->created_at.'
                    <br>
                    
                </div>
            </div>
            
    
           
            <div class="form-group addProRow3">
            <table class="table" id="myTable">
            
                <thead>
                    <tr>
                    <th scope="col" width="3%"></th>
                    <th scope="col" width="25%">Product</th>
                    <th scope="col" width="25%">Unit Price (RM)</th>
                    <th scope="col" width="15%">Quantity</th>
                    <th scope="col" width="15%">Total (RM)</th>
    
                    </tr>
                </thead>
                
                <tbody>

                        <tr>
                        <td></td>
                        <td>'.$PurchaseOrderR->proname.'</td>
                        <td>'.$PurchaseOrderR->unitPrice.'</td>
                        <td>'.$PurchaseOrderR->quantity.'</td>
                        <td>'.$PurchaseOrderR->grand_total.'</td>
                        </tr>

                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b> Total <b></td>
                        <td hidden>0</td>
                        <td><span id="totalVal" style=""></span></td>
                        </tr>
                </tbody>
                
            <tfoot>
            
            </tfoot>
                
            </table>
    
            <br>
                
            </div>
    
            <div class="form-group printpoaddProRow4">
                <label class="" for="PurchaseOrder Notes"><b>Notes</b></label>
                <div class="poNotesArea notesandstatus">
                '.$PurchaseOrder->notes.'
                </div>
    
            </div>
            
            <div class="form-group printpoaddProRow5">
                <label class="" for="Supplier status"><b>Status</b></label>
                <div class="poStatus notesandstatus" id="poStatus">
                    <input hidden value="'.$PurchaseOrder->status.'" id="poVal"></input>
                </div>
            </div>

            </form>
    
      </div>
    </div>';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($output);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream();

    }

}
