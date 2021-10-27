@extends('adminPageLayout')
@section('content')

<style>

  button .backToCategory {
    color: white;
    text-decoration: none;
  }

</style>

<!--Page topic-->

<div class="container-fluid">
        <div class="row">
          <div class="col-sm">
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="{{ route('viewSupplier') }}" class="pageTopic"> Supplier </a> 
            / <a href="#" class="currentPage"> Supplier Details </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container content border">
  <div class="row bg-light row1">
      <div class="col-sm">
        @foreach($supplier as $supplier)
          <div class="p-3"><b>{{ $supplier->supplierName }}</b></div>
      </div>
  </div>
  <div class="row ">
    <div class="col-sm p-3">
        <form method="POST" , action="{{ route('updateSupplier') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{$supplier->id}}">

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="supplierID">Supplier ID</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="SupplierID" name="SupplierID" value="{{$supplier->supplierID}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="supplierName">Company Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="SupplierName" name="SupplierName" style=" background:transparent;" value="{{$supplier->supplierName}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="CompanyEmail">Company Email</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="CompanyEmail" name="CompanyEmail" style=" background:transparent;" value="{{$supplier->companyEmail}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="supplierAddress">Address</label>
            <div class="col-md-5">
                <input type="text" class="form-control" id="SupplierAddress" name="SupplierAddress" style=" background:transparent;" value="{{$supplier->address}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="City">City</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="City" name="City" style=" background:transparent;" value="{{$supplier->city}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="State">State</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="State" name="State" style=" background:transparent;"value="{{$supplier->state}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="ZipCode">Zip Code</label>
            <div class="col-md-2">
                <input type="number" class="form-control" id="ZipCode" name="ZipCode" style=" background:transparent;" length="5" value="{{$supplier->zipcode}}">
            </div>
        </div>

        

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="contactPerson">Contact Person</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ContactPerson" name="ContactPerson" style=" background:transparent;" value="{{$supplier->contactPerson}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="contactNumber">Contact Number</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" style=" background:transparent;" value="{{$supplier->contactNumber}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="emailAddress">Email Address</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" style=" background:transparent;" value="{{$supplier->emailAddress}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="Supplier status">Status</label>
            <div class="col-md-3">
                <select name="status" class="form-control" required value="{{$supplier->status}}">
                    <option value="">---Select Status---</option>
                    <option value="Available">Active</option>
                    <option value="Unavailable">Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
            <Button type="button" class="btn btn-secondary">
                <a href="{{ route('viewSupplier') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="btn btn-primary" title="Submit">Save</button>
            </div>
        </div>
        </form>
    @endforeach
    </div>
  </div>
</div>

@endsection