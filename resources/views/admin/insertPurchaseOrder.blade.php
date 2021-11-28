@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
        @foreach($supplier as $supplier)
          <div class="pageTopic addPro"><h2>Fill in Details</h2></div>
  </div>
  
  <div class="form addProForm row">
      
        <form method="POST" , action="#" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{$supplier->id}}">

        <div class="form-group addProRow1">
            <label class="" for="Document No">Document No</label>
            <div class="">
                <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
            </div>
        </div>

        <div class="form-group addProRow2">
        <label class="" for="supplierName">Company Name</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$supplier->supplierName}}" readonly>
            </div>
        </div>
        @endforeach
        
        <div class="form-group addProRow3">
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                </tr>
            </thead>
        <tbody>
        @forelse($product as $product)
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="{{ route('editProduct',['id'=>$product->id]) }}"><div class="p-2">{{$product->productID}}</div></a>
                </td>
                <td class="link">
                <a href="{{ route('editProduct',['id'=>$product->id]) }}"><img src="{{asset('images/')}}/{{$product->image}}" alt="" width="60" height="50"></a>
                    <a href="{{ route('editProduct',['id'=>$product->id]) }}"><div class="p-2">{{$product->name}}</div></a>
                </td>
                <td class="link">
                    <div class="p-2"><input type="number" class="form-control" id="productQuantity" name="productQuantity" value="{{ $product->quantity }}"></div>
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
            <label class="" for="Supplier status">Status</label>
            <div class="">
                <select name="status" class="form-control" required value="#">
                    <option value="">---Select Status---</option>
                    <option value="Available">Avtive</option>
                    <option value="Unavailable">Complete</option>
                </select>
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('chooseSupplier') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        </div>

        <div class="form-group addProRow5">
            
        </div>
        </form>
    
  </div>
</div>

@endsection
