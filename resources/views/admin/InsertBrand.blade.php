@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="" id="pwrapper1">
  <div class="">
      <div class="">
        <div class="pageTopic addPro"><h2>New Brand</h2></div>
      </div>
  </div>
  <div class="row editProForm">
  <div class="">
    <form method="POST" , action="{{ route('addBrand') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-group addProRow1">
        <label class="" for="brandID">Brand ID</label>
        <div class="">
          <input type="text" class="form-control" id="BrandID" name="BrandID" style="background:transparent;">
        </div>
        <label class="" for="Brand Name">Name</label>
        <div class="">
          <input type="text" class="form-control" id="BrandName" name="BrandName" style=" background:transparent;">
        </div>
        <label class="" for="Category status">Status</label>
        <div class="">
          <select name="status" class="form-control" required>
            <option value="">---Select Status---</option>
            <option value="Available">Active</option>
            <option value="Unavailable">Inactive</option>
          </select>
        </div>
        <div class="">
          <Button type="button" class="backBtn">
            <a href="{{ route('viewBrand') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
          </Button>
          <button type="submit" class="subBtn" title="Submit">Submit</button>
        </div>
      </div>
    </form>
  </div>
  </div>
</div>

@endsection