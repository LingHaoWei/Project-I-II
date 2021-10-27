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
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="{{ route('viewProduct') }}" class="pageTopic"> Product </a> / <a href="#" class="currentPage"> Brand </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container-fluid border content">
    <div class="row bg-light row1"> 
        <div class="col-sm-10">
            <div class="p-3"><b>Product Brand</b></div>
        </div>
        <div class="col-sm">
            <div class="p-3">
                <Button type="button" class="addButton">
                    <a href="{{ route('insertBrand') }}" title="New+" data-toggle="tooltip">New+</a>
                </Button>
            </div>

        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                <th>BrandID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brand as $brand)
                <tr>
                <td>{{$brand->brandID}}</td>
                <td>{{$brand->name}}</td>
                <td>{{$brand->status}}</td>
                <td>
                    <Button type="button" class="addButton">
                        <a href="{{ route('editBrand',['id'=>$brand->id]) }}" class="editBrand" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="addButton">
                        <a href="{{ route('deleteBrand',['id'=>$brand->id]) }}" class="deleteBrand" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection