@extends('layout')
@section('content')
<style>

</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Product List</h2></div>
            </div>
            <div class="addProBtn">
                <div class="p-3">
                    <Button type="button" class="addButton">
                        <a href="{{ route('insertProduct') }}" class="addProduct" title="New" data-toggle="tooltip">+Add Product</a>
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

    <div class="" id="pwrapper2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Product</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td width="60"> 
                </td>
                <td class="link">
                <a href="{{ route('editProduct',['id'=>$product->id]) }}"><img src="{{asset('images/')}}/{{$product->image}}" alt="" width="60" height="50"></a>
                    <a href="{{ route('editProduct',['id'=>$product->id]) }}"><div class="p-2">{{$product->name}}</div></a>
                </td>
                <td class="link">
                    <a href="{{ route('viewBrand') }}"><div class="p-2">{{$product->brandname}}</div></a>
                </td>
                <td class="link">
                    <a href="{{ route('viewCategory') }}"><div class="p-2">{{$product->catname}}</div></a>
                </td>
                <td class="link">
                    <a href="{{ route('viewSupplier') }}"><div class="p-2">{{$product->supname}}</div></a>
                </td>
                <td>
                    <Button type="button" class="editBtn">
                        <a href="{{ route('editProduct',['id'=>$product->id]) }}" class="editProduct" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="deleteBtn">
                        <a href="{{ route('deleteProduct',['id'=>$product->id]) }}" class="deleteProduct" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>

@endsection