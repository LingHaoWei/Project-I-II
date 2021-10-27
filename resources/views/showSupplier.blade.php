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
            <div class="p-1 pageTopic"> <a href="{{ route('adminHomePage') }}">Home</a> / <a href="#" class="currentPage"> Supplier </a> </div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container-fluid border content">
    <div class="row bg-light row1">
        <div class="col-sm-10">
            <div class="p-3"><b>Supplier List</b></div>
        </div>
        <div class="col-sm">
            <div class="p-3">
                <Button type="button" class="addButton">
                    <a href="{{ route('insertSupplier') }}" title="New+" data-toggle="tooltip">New+</a>
                </Button>
            </div>
        </div>
    </div>

    <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th>Supplier ID</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Status</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($supplier as $supplier)
                    <tr>
                    <td>{{$supplier->supplierID}}</td>
                    <td>
                        <a href="{{ route('editSupplier',['id'=>$supplier->id]) }}" style="color:black; text-decoration:none;">{{$supplier->supplierName}}</a>
                    </td>
                    <td>{{$supplier->contactPerson}}</td>
                    <td>{{$supplier->status}}</td>
                    <td>
                        <Button type="button" class="addButton">
                            <a href="{{ route('editSupplier',['id'=>$supplier->id]) }}" class="editCategory" title="Edit" data-toggle="tooltip">Edit</a>
                        </Button>

                        <button type="button" class="addButton">
                            <a href="{{ route('deleteSupplier',['id'=>$supplier->id]) }}" class="deleteSupplier" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                        </button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection