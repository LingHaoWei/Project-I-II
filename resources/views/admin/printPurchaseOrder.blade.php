@extends('layout')
@section('content')

<style>
    td .prc{
        width: 200px;
    }

    .poNotesArea textarea{
        width: 100%;
        height: 100px;
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
        <div class="form-group addProRow1">
            
            <label class="" for="supplierName">Supplier Name</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$po->supname}}" readonly>
            </div>
            
            

            <label for="choose product">Product</label>

        </div>
        
        
        <div class="form-group addProRow2">
            <label class="" for="Document No">Document No</label>
            <div class="">
                <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$po->document_no}}" readonly>
                <h5><i>*This blank will Automatically Generate upon saving.</i><h5>
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
                <th scope="col" width="20%"></th>
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

        <div class="form-group addProRow4">
        <label class="" for="PurchaseOrder Notes">Notes</label>
                    <div class="poNotesArea">
                        <textarea type="text" class="form-control" id="poNotes" name="poNotes" >{{$po->notes}}</textarea>
                    </div>
            <label class="" for="Supplier status">Status</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$po->status}}" readonly>
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewPurchaseOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        </div>
        
        <div class="form-group addProRow5">
            
        </div>
        @endforeach
        </form>

  </div>
</div>

<script>



</script>

@endsection
