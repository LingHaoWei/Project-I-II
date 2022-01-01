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
            <form method="POST" action="{{route('search.brand')}}" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
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
                @foreach($brand as $brands)
                <tr>
                <td width="60"> 
                </td>
                <td>{{$brands->brandID}}</td>
                <td>{{$brands->name}}</td>
                <td>{{$brands->status}}</td>
                <td>
                    <Button type="button" class="addButton">
                        <a href="{{ route('editBrand',['id'=>$brands->id]) }}" class="editBrand" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="deleteBtn">
                        <a href="{{ route('deleteBrand',['id'=>$brands->id]) }}" class="deleteBrand" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$brand->links()}}
@endsection