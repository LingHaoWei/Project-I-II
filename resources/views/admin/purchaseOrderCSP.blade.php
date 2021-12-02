@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="pageTopic addPro"><h2>Add Product</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="{{ route('addProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">
                    <label class="" for="Document No">Document No</label>
                    <div class="">
                    <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
                    </div>
                </div>

                <div class="form-group addProRow2">
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="SupplierID" id="SupplierID" class="form-control">

                        <option value="">---Select Supplier---</option>

                        @foreach($supplier as $supplier)

                        <option value="{{$supplier->supplierID}}">{{$supplier->supplierName}}</option>

                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="form-group addProRow3">

                </div>

                <div class="form-group addProRow4">
                    <label class="" for="Brand status">Status</label>
                    <div class="">
                    <select name="status" class="form-control selectAvai" required>
                        <option value="">---Select Status---</option>
                        <option value="Available">Pending</option>
                        <option value="Unavailable">Fulfilled</option>
                    </select>
                    </div>
                    <div class="">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewPurchaseOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    </div>
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>

@endsection
