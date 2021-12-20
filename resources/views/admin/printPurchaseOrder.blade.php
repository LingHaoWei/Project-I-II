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
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
        
          <div class="pageTopic addPro"><h2>Purchase Order Details</h2></div>
  </div>
  
  <div class="form addProForm row">
      
        <form method="POST" , action="{{route('addPO')}}" enctype="multipart/form-data" id="dynamic_form">
        @csrf
        @foreach($PurchaseOrder as $po)
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
            <b>Vendor: {{$po->supname}}</b><br>
            {{$po->supadd}}, <br> 
            {{$po->supcity}}, {{$po->supzipcode}}, {{$po->supstate}}.<br>
            {{$po->supcp}} <br>
            {{$po->supcn}} <br>
            {{$po->supemail}} <br></br>
            

            </div>

        </div>
        
        
        <div class="form-group addProRow2">
            <label class="" for="Document No"><b>P.O. No:</b></label>
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
                <th scope="col" width="20%">Product</th>
                <th scope="col" width="20%">Unit Price</th>
                <th scope="col" width="20%">Quantity</th>
                <th scope="col" width="20%">Total</th>
                <th scope="col" width="20%">Grand Total</th>
                </tr>
            </thead>
            @foreach($PurchaseOrderR as $por)
            <tbody>
                    <tr>
                    <td></td>
                    <td>{{$por->proname}}</td>
                    <td>RM {{$por->unitPrice}}</td>
                    <td>{{$por->quantity}}</td>
                    <td>RM {{$por->grand_total}}</td>
                    <td></td>
                    </tr>
            </tbody>
            @endforeach
        <tfoot>

        </tfoot>
        
        </table>

            
        </div>

        <div class="form-group printpoaddProRow4">
        <label class="" for="PurchaseOrder Notes">Notes</label>
                    <div class="poNotesArea notesandstatus">
                        {{$po->notes}}
                    </div>
            
        </div>
        
        <div class="form-group printpoaddProRow5">
            <label class="" for="Supplier status">Status</label>
            <div class="poStatus notesandstatus" id="poStatus">
                <input hidden value="{{$po->status}}" id="poVal"></input>
                
            </div>

        </div>
        @endforeach
        </form>

  </div>
</div>

<script>


var statusNum = document.getElementById("poVal");
if (statusNum = 0) {
    document.getElementById("poStatus").innerHTML = "Pending";
} else if (statusNum = 1){
    document.getElementById("poStatus").innerHTML = "Partially Fulfilled";
} else {
    document.getElementById("poStatus").innerHTML = "Fulfilled";
}


</script>

@endsection
