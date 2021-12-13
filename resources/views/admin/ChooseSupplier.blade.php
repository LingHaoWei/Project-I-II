@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="pageTopic addPro"><h2>Add Purchase Order</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="{{route('addPO')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">

                    
                    
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="chooseSupplier" id="chooseSupplier" class="form-control chooseSupplier">

                        <option selected="" disabled="">---Select Supplier---</option>

                        @foreach($supplier as $supplier)

                        <a href=""><option value="{{ $supplier->supplierID }}">{{$supplier->supplierName}}</option></a>

                        @endforeach

                    </select>
                    </div>

                </div>

                <div class="form-group addProRow2">
                    <label class="" for="Document No">Document No</label>
                    <div class="">
                    <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
                    </div>
                </div>

                <div class="form-group addProRow3">
                <table class="table" id="myTable">
            <thead>
                <tr>
                <th scope="col" width="2%"></th>
                <th scope="col" width="30%">Product</th>
                <th scope="col">Unit Price</th>
                <th scope="col" width="30%">Quantity</th>
                <th scope="col" width="30%">Option</th>
                </tr>
            </thead>
        <tbody>
                    <tr>
                    <td> 
                    </td>

                    <td>
                    <select name="chooseProduct" id="chooseProduct" class="form-control chooseProduct" onchange="this.options[this.selectedIndex];">
                        <option selected="" disabled="">---Select Product---</option>
                        @foreach($product as $product)
                        <a href=""><option value="{{$product->productID}}">{{$product->productID}}</option></a>
                        @endforeach
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                    <button type="button" class="subBtn" onclick="myFunction()">Add</button>
                    </td>
                    </tr>
        </tbody>
        <tfoot>

        </tfoot>
        
        </table>
                </div>

                <div class="form-group addProRow4">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewPurchaseOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>


<script>

function myFunction() {
    var count = 0;
    var productID = $('#chooseProduct').find(":selected").val();
  var table = document.getElementById("myTable");
  var row = table.insertRow(count+1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  cell1.innerHTML = '<input type="checkbox" name="is_po[]" value="{{$product->productID}}" onclick="cal()" >';
  cell2.innerHTML = '<input type="hidden" class="form-control" id="productID" name="product[]" value="'+productID+'">' + productID + '</div>';
  cell3.innerHTML = '<div class="p-2"><input /> </div>';
  cell4.innerHTML = '<td><input type="text" name="quantity[]"  /></td>';
  cell5.innerHTML = '<button type="button" class="deleteBtn" onclick="deleteRow(this)"><a href="#" class="deletePOProduct" title="Delete" >Delete</a></button>';
}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);
}


</script>

@endsection

