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
        @foreach($OfflineOrder as $offorder)
        <div class="addRow">
            <input hidden value="{{$offorder->id}}" />
            

        </div>
            
            
        <div class="form-group addProRow1">
            
            <label class="" for="Document No"><b>Order No</b> </label>
            <div class="">
                {{$offorder->order_no}}
            </div>

        </div>
        
        
        <div class="form-group addProRow2">
        <label class="" for="Document No"><b>Invoice No</b> </label>
            <div class="">
                {{$offorder->invoice_no}}
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
            @foreach($OfflineOrderDetails as $offorderd)
                    <tr>
                    <td></td>
                    <td>{{$offorderd->proname}} ({{$offorderd->productID}})</td>
                    <td>{{$offorderd->Price}}</td>
                    <td>{{$offorderd->quantity}}</td>
                    <td>{{$offorderd->grand_total}}</td>
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
                {{$offorder->notes}}
            </div>

        </div>
        
        <div class="form-group printpoaddProRow5">
            <label class="" for="PO status"><b>Status</b></label>
            <div class="poStatus notesandstatus" id="poStatus">
                <input hidden value="{{$offorder->status}}" id="poVal"></input>
            </div>
        </div>
        @endforeach
        </form>

  </div>
</div>

    <div id="printBtnWrapper">
        <div class="optionButton">
            <button type="button" class="deleteBtn">
                <a href="{{ route('viewOfflineOrder') }}" class="backBtn" title="Back" data-toggle="tooltip">Back</a> 
            </button>

            <Button type="button" class="editBtn">
                <a href="javascript:generatePDF()" id="downloadBtn" class="printPDF" title="print" data-toggle="tooltip">Print PDF</a>
            </Button>
        </div>
    </div>


<div id="elementH"></div>



<script>


if (document.getElementById('poVal').value == 1){
    document.getElementById("poStatus").innerHTML = '<Button type="button" class="editBtn" style="background-color:green;color:white;">'+"Paid"+'</Button>';
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
