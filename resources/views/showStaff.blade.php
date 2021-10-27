@extends('adminPageLayout')
@section('content')
@if(Session::has('success'))
    <div class="alet alert-success" role="alert">
        {{Session::get('success')}}
    </div>
@endif
<style>

    .addButton{
        border-radius: 4px;
        cursor: pointer;
    }

    .addButton a{
        text-decoration: none;
        color: black;
    }

    .addButton:hover{
        background-color: #E1e4e5;
    }

</style>

<!--Page topic-->

<div class="container-fluid">
        <div class="row">
          <div class="col-sm">
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="#" class="currentPage"> Staff </a></div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container-fluid border content">
    <div class="row bg-light row1"> 
        <div class="col-sm-10">
            <div class="p-3"><b>Staff Information</b></div>
        </div>
        <div class="col-sm">
            <div class="p-3">
                <Button type="button" class="addButton">
                    <a href="{{ route('insertStaff') }}" title="New+" data-toggle="tooltip">New+</a>
                </Button>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Email</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
            <tr>
            @foreach($staff as $staff)
                <th scope="row">{{$staff->staffID}}</th>
                <td>{{$staff->firstName}} {{$staff->lastName}}</td>
                <td>{{$staff->position}}</td>
                <td>{{$staff->emailAddress}}</td>
                <td>
                    <Button type="button" class="addButton">
                        <a href="{{ route('editStaff',['id'=>$staff->id]) }}" class="editStaff" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="addButton">
                        <a href="{{ route('deleteStaff',['id'=>$staff->id]) }}" class="deleteStaff" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection