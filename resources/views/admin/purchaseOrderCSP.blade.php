@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
        
          <div class="pageTopic addPro"><h2>Fill in Details</h2></div>
  </div>
  
  <div class="form addProForm row">
      
        <form method="POST" , action="{{route('addPO')}}" enctype="multipart/form-data">
        @csrf
        @foreach($supplier as $supplier)
        <input type="hidden" class="form-control" id="SupplierID" name="SupplierID" name="SupplierID" value="{{$supplier->id}}">

        <div class="form-group addProRow1">
            <label class="" for="Document No">Document No</label>
            <div class="">
                <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
            </div>
            <label class="" for="supplierName">Supplier Name</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$supplier->supplierName}}" readonly>
            </div>
        </div>
        @endforeach
        <div class="form-group addProRow2">
        
        </div>
        
        
        <div class="form-group addProRow3">
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                </tr>
            </thead>
        <tbody>
        @forelse($product as $product)
            <tr>
                <td width="50"> 
                    <input type="checkbox" name="is_po[]" value="{{$product->productID}}" onclick="cal()" >
                </td>
                <td class="link">
                    <div class="p-2">{{$product->productID}}</div>
                </td>
                <td class="link">
                <img src="{{asset('images/')}}/{{$product->image}}" alt="" width="60" height="50">
                    <div>{{$product->name}}</div>
                </td>
                <td class="link">
                    <input type="hidden" class="form-control" id="productID" name="product[]" value="{{$product->productID}}">

                    <div class="p-2">RM {{$product->unitPrice}}.00</div>
                </td>
                <td class="link">
                    <div class="p-2"><input type="number" class="form-control" id="poProductQuantity" name="poQty[]" value="0" ></div>
                </td>
            </tr>
            @empty
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    no such product
                </td>
            </tr>
            
        @endforelse
        
        </tbody>
        
        </table>

        

        </div>

        <div class="form-group addProRow4">
            <!--<label class="" for="Supplier status">Status</label>
            <div class="">
                <select name="status" class="form-control" required value="#">
                    <option value="">---Select Status---</option>
                    <option value="Available">Pending</option>
                    <option value="Unavailable">Complete</option>
                </select>
            </div>-->
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('selectSupplier') }}" class="" title="Back" data-toggle="tooltip">Back</a>
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
$(document).ready(function(){

var count = 1;

dynamic_field(count);

function dynamic_field(number){
    var html = '<tr>';
    html += '<td><input type="text" name="productName[]" /></td>';
    html += '<td><input type="text" name="unitPrice[]" /></td>';
    html += '<td><input type="text" name="quantity[]" /></td>';
    if(number > 1){
        html += '<td><button type="button" name="remove" id="remove" class="subBtn">Remove</button></td></tr>';
        $('tbody').append(html);
    }
    else{
        html += '<td><button type="button" name="add" id="add" class="subBtn">Add</button></td></tr>';
        $('tbody').html(html);
    }
}

$('#add').click(function(){
    count++;
    dynamic_field(count);
});

$(document).on('click', '#remove', function(){
    count--;
    dynamic_field(count);
});

$('#dynamic_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
        url:'{{route("addPO")}}',
        method:'post',
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
            $('save').attr('disabled','disabled');
        },
        success:function(data){
            if(data.error){
                var error_html = '';
                for(car count = 0; count < data.error.length; count++){
                    error_html += '<p>'+data.error[count]+'</p>';
                }
                $('#result').html('<div class="">'+error_html+'</div>');
            }
            else{
                dynamic_field(1);
                $('#result').html('<div class="">'+data.success+'</div>');
            }
            $('#save').attr('disabled', false);
        }
    })
});

});</script>

@endsection
