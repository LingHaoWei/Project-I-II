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
            <form method="POST" action="{{route('search.adminProduct')}}" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <div class="" id="pwrapper2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="{{ route('editProduct',['id'=>$product->id]) }}"><div class="p-2">{{$product->productID}}</div></a>
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
                    <div class="p-2">{{$product->quantity}}</div>
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
            @empty
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    no such product
                </td>
            </tr>
            
        @endforelse
        
        </tbody>
        
        </table>

        <!--<form action="{{route('storeUpProduct')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="upload-file">Bulk upload with csv: </label>
            <input type="file" name="upload-file" class="form-control">  
        </div>
        <button type="submit" class="">UPLOAD</button>
        </form>-->
        
    </div>

    

    {{$products->links()}}

@endsection