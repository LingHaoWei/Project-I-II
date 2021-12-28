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
  @foreach($PurchaseOrder as $po)
        <form method="POST" , action="{{ route('savePO',['id'=>$po->id]) }}" enctype="multipart/form-data" id="dynamic_form">
        @csrf
        
        <div class="addRow">
        <input hidden id="id" name="id" value="{{$po->id}}" />
            

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
            @foreach($PurchaseOrderR as $por)
                    <tr>
                    <td></td>
                    <td>{{$por->proname}}</td>
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
            <label class="" for="Document No">Invoice No:</label>
            <div class="">
                <input type="text" class="form-control" id="InvoiceNo" name="InvoiceNo" value="{{$po->invoice_no}}">
            </div>

            <label class="" for="PurchaseOrder Notes">Notes</label>
                    <div class="poNotesArea">
                        <textarea type="text" class="form-control" id="poNotes" name="poNotes" >{{$po->notes}}</textarea>
                    </div>

            <label class="" for="Supplier status">Status</label>
            <div class="">
                <select name="status" class="form-control" required value="#">
                    <option value="">---Select Status---</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Cancelled</option>
                </select>
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewPurchaseOrderDetail',['id'=>$po->id]) }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        </div>
        
        <div class="form-group printpoaddProRow5">
            
        </div>
        @endforeach
        </form>

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

document.getElementById("totalVal").innerHTML = "RM " + sumVal;
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
