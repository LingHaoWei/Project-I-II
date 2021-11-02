@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
        @foreach($supplier as $supplier)
          <div class="pageTopic addPro"><h2>{{ $supplier->supplierName }}</h2></div>
  </div>
  
  <div class="form addProForm row">
        <form method="POST" , action="{{ route('updateSupplier') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{$supplier->id}}">

        <div class="form-group addProRow1">
            <label class="" for="supplierID">Supplier ID</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierID" name="SupplierID" value="{{$supplier->supplierID}}" readonly>
            </div>
            <label class="" for="supplierName">Company Name</label>
            <div class="">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$supplier->supplierName}}">
            </div>
            <label class="" for="CompanyEmail">Company Email</label>
            <div class="">
                <input type="text" class="form-control" id="CompanyEmail" name="CompanyEmail" style=" background:transparent;" value="{{$supplier->companyEmail}}">
            </div>
        </div>

        <div class="form-group addProRow2">
            <label class="" for="contactPerson">Contact Person</label>
            <div class="">
                <input type="text" class="form-control" id="ContactPerson" name="ContactPerson" style=" background:transparent;" value="{{$supplier->contactPerson}}">
            </div>
            <label class="" for="contactNumber">Contact Number</label>
            <div class="">
                <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" style=" background:transparent;" value="{{$supplier->contactNumber}}">
            </div>
            <label class="" for="emailAddress">Contact Email</label>
            <div class="">
                <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" style=" background:transparent;" value="{{$supplier->emailAddress}}">
            </div>
        </div>

        <div class="form-group addProRow3">
            <label class="" for="supplierAddress">Address</label>
            <div class="">
                <textarea type="text" class="form-control" id="SupplierAddress" name="SupplierAddress" style=" background:transparent;" value="">{{$supplier->address}}</textarea>
            </div>
            <label class="" for="City">City</label>
            <div class="">
                <input type="text" class="form-control" id="City" name="City" style=" background:transparent;" value="{{$supplier->city}}">
            </div>
            <label class="" for="State">State</label>
            <div class="">
                <input type="text" class="form-control" id="State" name="State" style=" background:transparent;"value="{{$supplier->state}}">
            </div>
            <label class="" for="ZipCode">Zip Code</label>
            <div class="">
                <input type="number" class="form-control" id="ZipCode" name="ZipCode" style=" background:transparent;" length="5" value="{{$supplier->zipcode}}">
            </div>
        </div>

        <div class="form-group addProRow4">
            <label class="" for="Supplier status">Status</label>
            <div class="">
                <select name="status" class="form-control" required value="{{$supplier->status}}">
                    <option value="">---Select Status---</option>
                    <option value="Available">Active</option>
                    <option value="Unavailable">Inactive</option>
                </select>
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewSupplier') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Save</button>
            </div>
        </div>

        <div class="form-group addProRow5">
            
        </div>
        </form>
    @endforeach
  </div>
</div>

@endsection