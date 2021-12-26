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
        
          <div class="pageTopic addPro"><h2>Fill in Details</h2></div>
  </div>
  
  <div class="form addProForm row">
      
        <form method="POST" , action="{{route('addPO')}}" enctype="multipart/form-data" id="dynamic_form">
        @csrf
        <div class="form-group addProRow1">
            
            @foreach($supplier as $supplier)
            <input type="hidden" class="form-control" id="SupplierID" name="SupplierID" name="SupplierID" value="{{$supplier->id}}">
            <label class="" for="supplierName">Supplier Name</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$supplier->supplierName}}" readonly>
            </div>
            @endforeach
            
            <label for="choose product">Product</label>
            
        </div>
        
        
        <div class="form-group addProRow2">
            <label class="" for="Document No">Document No</label>
            <div class="">
                <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="" readonly>
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
                <th scope="col" width="20%">Option</th>
                </tr>
            </thead>
        <tbody>
                    <tr>
                    <td></td>
                    <td>
                    <select name="chooseProduct" id="chooseProduct" class="form-control chooseProduct" onchange="this.options[this.selectedIndex];">
                        <option selected="" disabled="">---Select Product---</option>
                        @foreach($product as $product)
                        <a href=""><option value="{{$product->productID}}" data-name="{{$product->name}}" data-price="{{$product->unitPrice}}">{{$product->name}} ({{$product->productID}})</option></a>
                        @endforeach
                    </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="subBtn" onclick="myFunction(this)">Add</button></td>
                    </tr>
        </tbody>
        <tfoot>

        </tfoot>
        
        </table>

            
        </div>

        <div class="form-group addProRow4">
        <label class="" for="PurchaseOrder Notes">Notes</label>
                    <div class="poNotesArea">
                        <textarea type="text" class="form-control" id="poNotes" name="poNotes" ></textarea>
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
                <a href="{{ route('insertPO') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        </div>

        <div class="form-group addProRow5">
            
        </div>
        </form>
    
  </div>
</div>

<script>

function myFunction(r) {
    var i = r.parentNode.parentNode.rowIndex;
    var productID = $('#chooseProduct').find(":selected").val();
    var productUP = $('#chooseProduct').find(':selected').data('price');
    var productName = $('#chooseProduct').find(':selected').data('name');
    var productNum = $('#chooseProduct').find(':selected').data('no');
    var table = document.getElementById("myTable");
    var row = table.insertRow(r.parentNode.parentNode.rowIndex);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML = '<input type="checkbox" name="is_po[]" value="{{$product->productID}}" onclick="cal()" hidden>'+i;
    cell2.innerHTML = '<input type="hidden" class="form-control" id="productID" name="product[]" value="'+productID+'">' + productName + ' (' + productID + ') ' + '</div>';
    cell3.innerHTML = '<div class="p-2">RM '+ productUP + '</div>';
    cell4.innerHTML = '<input type="number" class="form-control prc" id="poProductQuantity" name="poQty[]" value="0" />';
    cell5.innerHTML = '<output id="total">RM</output>';
    cell6.innerHTML = '<button type="button" class="deleteBtn" onclick="deleteRow(this)"><a href="#" class="deletePOProduct" title="Delete" data-toggle="tooltip"">X</a></button>';

    $(row).on('input','.prc',function(){
    var totalSum = 0;
    $('.form-group .prc').each(function(){
        var inputVal = $(this).val();
        if($.isNumeric(inputVal)){
            totalSum = parseFloat(inputVal * productUP);
        }
    });
    $(cell5).text('RM '+totalSum);
    });
}

function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("myTable").deleteRow(i);
}



</script>

@endsection
