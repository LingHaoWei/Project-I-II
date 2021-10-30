@extends('layout')
@section('content')
<style>

</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Product Brand</h2></div>
            </div>
            <div class="addProBtn">
                <div class="p-3">
                    <Button type="button" class="addButton">
                        <a href="{{ route('insertBrand') }}" class="addProduct" title="New" data-toggle="tooltip">+Add Brand</a>
                    </Button>
                </div>
            </div>
        </div>
        
        <div class="iq-search-bar device-search">
            <form action="#" class="searchbox">
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" class="text search-input" placeholder="">
            </form>
        </div>
    </div>

    <div class="row" id="pwrapper2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th>BrandID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brand as $brand)
                <tr>
                <td width="60"> 
                </td>
                <td>{{$brand->brandID}}</td>
                <td>{{$brand->name}}</td>
                <td>{{$brand->status}}</td>
                <td>
                    <Button type="button" class="addButton">
                        <a href="{{ route('editBrand',['id'=>$brand->id]) }}" class="editBrand" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="deleteBtn">
                        <a href="{{ route('deleteBrand',['id'=>$brand->id]) }}" class="deleteBrand" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection