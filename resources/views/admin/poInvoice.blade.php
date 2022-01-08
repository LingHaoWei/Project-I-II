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
            <div><h2>Invoice</h2></div>
        </div>

  </div>
  
  <div class="form addProForm row">
        @foreach($SupplierInfo as $supinfo)
        <form method="POST" , action="{{ route('saveInvoice',['id'=>$supinfo->purchase_order]) }}" enctype="multipart/form-data" id="dynamic_form">
        @csrf
        
        <div class="addRow">
        <input hidden id="id" name="id" value="{{$supinfo->purchase_order}}" />
            

        </div>
            
            
        <div class="form-group addProRow1">
            <label class="" for="Document No"><b>Invoice No: {{$supinfo->invoiceno}}</b></label>
            
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
            <b>Vendor: {{$supinfo->supname}}</b><br>
            Jalan mewar, Taman dato onn <br> 
            Jb, 80200, Johor.<br>
            Lucas <br>
            0119987265 <br>
            example@gmail.com<br></br>
            
            
            </div>

        </div>
        
        
        <div class="form-group addProRow2">

            <label class="" for="Document No"><b>Delivery Order No:</b></label>
            <div class="">
                #{{$supinfo->delivery_order_no}}
                <br></br>
                <br>
            </div>

            <label class="" for="Document No"><b>P.O. #:</b></label>
            <div class="">
                {{$supinfo->docno}}
                <br></br>
                <br>

                
                
            </div>
            <label class="" for="Document No"><b>Date Created:</b></label>
            <div class="">
                {{$supinfo->invoicedate}}
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
                <th scope="col" width="15%">Quantity</th>
                <th scope="col" width="15%">Total (RM)</th>

                </tr>
            </thead>
            
            <tbody>
            @foreach($DeliveryOrder as $do)
                    <tr>
                    <td></td>
                    <td>{{$do->proname}} ({{$do->productID}})</td>
                    <td>{{$do->proup}}</td>
                    <td>{{$do->sent_quantity}}</td>
                    <td></td>
                    </tr>
            @endforeach
                    <tr>
                    <td></td>
                    <td></td>
                    <td hidden>0</td>
                    <td hidden>0</td>
                    <td hidden></td>
                    <td></td>
                    <td><b>Total </b></td>
                    <td><span id="totalVal" style=""></span></td>
                    
                    </tr>
            </tbody>
            
        <tfoot>
        
        </tfoot>
            
        </table>

        <br>
            
        </div>

        <div class="form-group printpoaddProRow4">

            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewINHistory',['id'=>$supinfo->purchase_order]) }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        </div>
        
        <div class="form-group printpoaddProRow5">

        </div>

        </form>
        @endforeach
  </div>
</div>


<div id="elementH"></div>



<script>

var table = document.getElementById("myTable"), sumVal=0, subtotal=0;

for(var i = 1; i < table.rows.length; i++){
    subtotal = parseFloat(table.rows[i].cells[2].innerHTML) * parseFloat(table.rows[i].cells[3].innerHTML);
    table.rows[i].cells[4].innerHTML = subtotal;
    sumVal = subtotal + sumVal;
}

document.getElementById("totalVal").innerHTML = sumVal;
console.log(subtotal);



</script>

@endsection
