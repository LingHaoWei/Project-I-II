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
            / <a href="#" class="currentPage"> Edit Staff </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container content border">
    <div class="row bg-light row1">
    @foreach($staff as $staff)
      <div class="col-sm">
          <div class="p-3"><b>{{ $staff->firstName }} {{ $staff->lastName }}</b></div>
      </div>
    </div>

    <div class="row">
        <div class="col-sm p-3">
            <form method="POST", action="{{ route('updateStaff') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control" id="id" name="id" value="{{$staff->id}}">
                
                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right"></div>
                    <div class="col-md-8">
                    <img src="{{asset('images/')}}/{{$staff->image}}" alt="" width="50%">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product ID">Staff ID</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="staffID" name="staffID" value="{{ $staff->staffID }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Staff Image">Image</label>
                    <div class="col-md-4">
                        <input type="file" class="form-control" id="staff-image" name="staff-image" value="{{ $staff->image }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="firstName">First Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $staff->firstName }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="lastName">Last Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $staff->lastName }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="ICNumber">IC Number</label> 
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="ICNumber" name="ICNumber" value="{{ $staff->ICNumber }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="position">Position</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="position" name="position" value="{{ $staff->position }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="livingAddress">Living Address</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="livingAddress" name="livingAddress" value="{{ $staff->livingAddress }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="city">City</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="city" name="city" value="{{ $staff->city }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="state">State</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="state" name="state" value="{{ $staff->state }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="zipCode">Zip Code</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="zipCode" name="zipCode" value="{{ $staff->zipcode }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="contactNumber">Contact Number</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" value="{{ $staff->contactNumber }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="emailAddress">Email Address</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" value="{{ $staff->emailAddress }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Staff status">Status</label>
                    <div class="col-md-4">
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
                        <a href="{{ route('showStaff') }}" class="backToStaff" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="btn btn-primary" title="Submit">Submit</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

@endsection
