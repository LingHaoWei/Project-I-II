@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
          <div class="pageTopic addPro"><h2>User Detail</h2></div>
  </div>

  <div class="form addProForm row">
        <form method="POST" , action="{{ route('updateUser') }}" enctype="multipart/form-data">
        @csrf
        @foreach($users as $users)
        <input type="hidden" class="form-control" id="id" name="id" value="{{$users->id}}">

        <div class="form-group addProRow1">
            <label class="" for="supplierName">User Name</label>
            <div class="">
                <input type="text" class="form-control" id="name" name="name" style=" background:transparent;" value="{{$users->name}}">
            </div>
            <label class="" for="CompanyEmail">Contact Number</label>
            <div class="">
                <input type="text" class="form-control" id="contact" name="contact" style=" background:transparent;" value="{{$users->contact}}">
            </div>
        </div>

        <div class="form-group addProRow2">
            <label class="" for="contactPerson">Email</label>
            <div class="">
                <input type="text" class="form-control" id="email" name="email" style=" background:transparent;" value="{{$users->email}}">
            </div>

        </div>

        <div class="form-group addProRow3">
            <label class="" for="supplierAddress">Address</label>
            <div class="">
                <textarea type="text" class="form-control" id="address" name="address" style=" background:transparent;" value="">{{$users->address}}</textarea>
            </div>
            <div class="col-md-4 form-group">
                <p>State</p>
                <select id="state" name="state" class="form-control">
                    <option value="">{{ $users->state }}</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelatan">Kelatan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Putrajaya">Putrajaya</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <p>Zipcode</p>
                <input class='form-control' type="text" name="zipcode" id="zipcode" value="{{ $users->zipcode }}">
            </div>
            <div class="col-md-4 form-group">
                <p>City</p>
                <input class='form-control' type="text" name="city" id="city" value="{{ $users->city }}">
            </div>
        </div>

        <div class="form-group addProRow4">
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewUser') }}" class="" title="Back" data-toggle="tooltip">Back</a>
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
