@extends('shoppingPageLayout')
@section('content')
@if(Session::has('success'))

    <div class="alert alert-success" role="alert">

        {{Session::get('success')}}

    </div>

@endif
<style>
.acc {
    height: 800px;
}

.card {
    border: none
}

h3{
    font-family: 'Times New Roman', Times, serif;
    text-align: left;
}



.inputs label {
    display: flex;
    margin-left: 3px;
    font-weight: 500;
    font-size: 13px;
    margin-bottom: 10px
}

.inputs input {
    font-size: 14px;
    height: 40px;
    border: 2px solid #ced4da
}

.inputs input:focus {
    box-shadow: none;
    border: 2px solid blue
}

.about-inputs label {
    display: flex;
    margin-left: 3px;
    font-weight: 500;
    font-size: 13px;
    margin-bottom: 4px
}

.about-inputs textarea {
    font-size: 14px;
    height: 100px;
    border: 2px solid #ced4da;
    resize: none
}

.about-inputs textarea:focus {
    box-shadow: none
}

.btn {
    font-weight: 600
}

.btn:focus {
    box-shadow: none
}
</style>
<br><br><br>

<div class="container mt-3 acc">
    <div class="card p-3 text-center">

        <h3>User Profile</h3>
        <br>
        <form method="POST" action="{{ route('update.User') }}" enctype="multipart/form-data">
            @csrf
        @foreach($users as $users)
        <input class="form-control" type="hidden" id="id" name="id" value="{{ $users->id }}">
        <div class="row">
            <div class="col-md-9">
                <div class="inputs"> <label>Name</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ $users->name }}"> </div>
            </div><br>

            <div class="col-md-9">
                <div class="inputs"> <label>Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ $users->email }}" readonly> </div>
            </div>

            <div class="col-md-9">
                <div class="inputs"> <label>Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{$users->contact}}" readonly> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="about-inputs"> <label>Address</label>
                    <textarea type="text" class="form-control" id="address" name="address" value="">{{$users->address}}</textarea> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 ">
                <div class="inputs"> <label>State</label>
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
                    </select> </div>
            </div><br>
            <div class="col-md-3">
                <div class="inputs"> <label>Zipcode</label>
                    <input class='form-control' type="text" name="zipcode" id="zipcode" value="{{ $users->zipcode }}"> </div>
            </div>
            <div class="col-md-3">
                <div class="inputs"> <label>City</label>
                    <input class='form-control' type="text" name="city" id="city" value="{{ $users->city }}"> </div>
            </div>
        </div>
        <div class="mt-3 gap-2 d-flex justify-content-left">
            <button class="px-3 btn btn-sm btn-outline-primary">
                <a href="{{ url('/shoppingHomePage') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="px-3 btn btn-sm btn-primary">Save</button>
        </div>
        @endforeach
    </form>
    </div>
</div>
@endsection
