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
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                </tr>
            </thead>
        <tbody>
        
            <tr>
                <td width="50"> 
                
                </td>
                <td > 
                    
                </td>
                <td class="link">
                    
                </td>
                <td class="link">
                
                </td>
                <td class="link">
                    

                    
                </td>
                <td class="link">
                    
                </td>
            </tr>
        
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

@endsection
