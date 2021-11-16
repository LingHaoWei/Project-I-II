@extends('adminPageLayout')
@section('content')

<style>

  button .backToStaff {
    color: white;
    text-decoration: none;
  }

</style>

<!--Page topic-->

<div class="container-fluid">
        <div class="row">
          <div class="col-sm">
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="{{ route('showStaff') }}" class="pageTopic"> Staff </a> 
            / <a href="#" class="currentPage"> Add Staff </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container content border">
  <div class="row bg-light row1">
      <div class="col-sm">
          <div class="p-3"><b>New Staff</b></div>
      </div>
  </div>
  
  <div class="row ">
    <div class="col-sm p-3">
        <form method="POST" , action="{{ route('addStaff') }}" enctype="multipart/form-data">
        @csrf

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="staffID">Staff ID</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="staffID" name="staffID" style="background:transparent;">
            </div>
        </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="staffImage">Staff Image</label>
            <div class="col-md-4">
                <input type="file" class="form-control" id="staffImage" name="staffImage" style=" background:transparent;" >
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="firstName">First Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="firstName" name="firstName" style=" background:transparent;">
            </div>
        </div>
        </div>
        


        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="lastName">Last Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="lastName" name="lastName" style=" background:transparent;">
            </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="ICNumber">IC Number</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ICNumber" name="ICNumber" style=" background:transparent;">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="position">Position</label>
            <div class="col-md-4">  
                <input type="text" class="form-control" id="position" name="position" style=" background:transparent;">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="livingAddress">Living Address</label>
            <div class="col-md-5">
                <input type="text" class="form-control" id="livingAddress" name="livingAddress" style=" background:transparent;">
            </div>
        </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="city">City</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="city" name="city" style=" background:transparent;">
            </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="state">State</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="state" name="state" style=" background:transparent;">
            </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="zipCode">Zip Code</label>
            <div class="col-md-2">
                <input type="text" class="form-control" id="zipCode" name="zipCode" style=" background:transparent;">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="contactNumber">Contact Number</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" style=" background:transparent;">
            </div>
        </div>
        </div>

        <div class="">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="emailAddress">Email Address</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" style=" background:transparent;">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="Supplier status">Status</label>
            <div class="col-md-4">
                <select name="status" class="form-control" required>
                    <option value="">---Select Status---</option>
                    <option value="Available">Active</option>
                    <option value="Unavailable">Inactive</option>
                </select>
            </div>
        </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
            <Button type="button" class="btn btn-secondary">
                <a href="{{ route('showStaff') }}" class="backToStaff" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="btn btn-primary" title="Submit">Submit</button>
            </div>
        </div>
        </form>

    </div>
  </div>
</div>

@endsection