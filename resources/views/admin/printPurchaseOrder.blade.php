@extends('layout')
@section('content')

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
        @csrf
        @foreach($PurchaseOrder as $po)
        <div class="addRow">
            <input hidden value="{{$po->id}}" />
            

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
            <b>Vendor: {{$po->supname}}</b><br>
            {{$po->supadd}}, <br> 
            {{$po->supcity}}, {{$po->supzipcode}}, {{$po->supstate}}.<br>
            {{$po->supcp}} <br>
            {{$po->supcn}} <br>
            {{$po->supemail}} <br></br>
            

            </div>

        </div>
        
        
        <div class="form-group addProRow2">
            <label class="" for="Document No"><b>P.O. #:</b></label>
            <div class="">
                {{$po->document_no}}
                <br></br>
                <br>
            </div>

            <label class="" for="Document No"><b>Date Created:</b></label>
            <div class="">
                {{$po->created_at}}
                <br></br>
                <br>
            </div>

            <label class="" for="Document No"><b></b></label>
            <div class="">

                <br></br>
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
                <th scope="col" width="15%">Order Quantity</th>
                <th scope="col" width="15%">Total (RM)</th>

                </tr>
            </thead>
            
            <tbody>
            @foreach($PurchaseOrderR as $por)
                    <tr>
                    <td></td>
                    <td>{{$por->proname}} ({{$por->productID}})</td>
                    <td>{{$por->unitPrice}}</td>
                    <td>{{$por->quantity}}</td>
                    <td>{{$por->grand_total}}</td>
                    </tr>
            @endforeach
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
                {{$po->notes}}
            </div>

        </div>
        
        <div class="form-group printpoaddProRow5">
            <label class="" for="PO status"><b>Status</b></label>
            <div class="poStatus notesandstatus" id="poStatus">
                <input hidden value="{{$po->status}}" id="poVal"></input>
            </div>
        </div>
        @endforeach
        </form>

  </div>
</div>

    <div id="printBtnWrapper">
        <div class="optionButton">
            <button type="button" class="deleteBtn">
                <a href="{{ route('viewPurchaseOrder') }}" class="backBtn" title="Back" data-toggle="tooltip">Back</a> 
            </button>

            <Button type="button" class="editBtn">
                <a href="javascript:generatePDF()" id="downloadBtn" class="printPDF" title="print" data-toggle="tooltip">Print PDF</a>
            </Button>

            <button type="button" class="printPOBtn">
                <a href="{{ route('updatePurchaseOrder',['id'=>$po->id]) }}" class="printPO" title="Approve" data-toggle="tooltip">Update PO</a> 
            </button>
        </div>
    </div>


<div id="elementH"></div>



<script>


if (document.getElementById('poVal').value == 0) {
    document.getElementById("poStatus").innerHTML = '<Button type="button" class="editBtn" style="color:white;">'+"Pending"+'</Button>';
} else if (document.getElementById('poVal').value == 1){
    document.getElementById("poStatus").innerHTML = '<Button type="button" class="editBtn" style="background-color:green;color:white;">'+"Approved"+'</Button>';
} else {
    document.getElementById("poStatus").innerHTML = '<Button type="button" class="editBtn" style="background-color:red;color:white;">'+"Cancelled"+'</Button>';
}

var table = document.getElementById("myTable"), sumVal=0;

for(var i = 1; i < table.rows.length; i++){
    sumVal = sumVal + parseInt(table.rows[i].cells[4].innerHTML);
}

document.getElementById("totalVal").innerHTML = '<input value="RM '+sumVal+'" readonly name="total" style="border:none; outline: none;">';
console.log(sumVal);


async function generatePDF(){

    document.getElementById("downloadBtn").innerHTML = "Print PDF";

    var downloading = document.getElementById("pwrapper1");
    var doc = new jsPDF('l', 'pt');

    await html2canvas(downloading, {
                //allowTaint: true,
                //useCORS: true,
            }).then((canvas) => {
                //Canvas (convert to PNG)
                doc.addImage(canvas.toDataURL("image/png"), 'PNG', 5, 5, 833, 400);
            })

            doc.save("Document.pdf");

    document.getElementById("downloadBtn").innerHTML = "Print PDF";

}


</script>

@endsection
