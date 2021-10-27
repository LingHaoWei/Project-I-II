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
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="{{ route('viewProduct') }}" class="pageTopic"> Product </a> 
            / <a href="{{ route('viewCategory') }}" class="pageTopic"> Category </a> / <a href="#" class="currentPage"> Add Category </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container content border">
  <div class="row bg-light row1">
      <div class="col-sm">
          <div class="p-3"><b>New Category</b></div>
      </div>
  </div>
  <div class="row">
  <div class="col-sm p-3">
    <form method="POST" , action="{{ route('addCategory') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="categoryID">Category ID</label>
        <div class="col-md-5">
          <input type="text" class="form-control" id="CategoryID" name="CategoryID" style="background:transparent;" >
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="Category Name">Name</label>
        <div class="col-md-5">
          <input type="text" class="form-control" id="CategoryName" name="CategoryName" style=" background:transparent;" >
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="Category status">Status</label>
        <div class="col-md-5">
          <select name="status" class="form-control" required>
            <option value="">---Select Status---</option>
            <option value="Available">Active</option>
            <option value="Unavailable">Inactive</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <Button type="button" class="btn btn-secondary">
            <a href="{{ route('viewCategory') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
          </Button>
          <button type="submit" class="btn btn-primary" title="Submit">Submit</button>
        </div>
      </div>
    </form>
    
  </div>
  </div>
</div>

@endsection