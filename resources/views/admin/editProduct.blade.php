@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="" id="pwrapper1">
    @foreach($products as $product)
      <div class="">
          <div class="pageTopic addPro"><h2>{{ $product->name }}</h2></div>
      </div>

    <div class="form editProForm">
            <form method="POST", action="{{ route('updateProduct') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control" id="id" name="id" value="{{$product->id}}">

                <div class="form-group addProRow3">
                    <div class=""></div>
                    <div class="">
                    <img src="{{asset('images/')}}/{{$product->image}}" alt="" width="10%">
                    </div>
                </div>

                <div class="form-group addProRow1">
                    <label class="" for="Product ID">Product ID</label>
                    <div class="">
                        <input type="text" class="form-control" id="productID" name="productID" value="{{ $product->productID }}" readonly>
                    </div>
                    <label class="" for="Product Name">Product Name</label>
                    <div class="">
                        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name }}">
                    </div>
                    <label class="" for="Product Variety">Variety</label>
                    <div class="">
                        <input type="text" class="form-control" id="productVariety" name="productVariety" value="{{ $product->productVariety }}">
                    </div>
                    <label class="" for="Product SKU">Product SKU</label>
                    <div class="">
                        <input type="text" class="form-control" id="productSKU" name="productSKU" value="{{ $product->productSKU }}">
                    </div>
                    <label class="" for="Product Image">Image</label>
                    <div class="">
                        <input type="file" class="form-control" id="product-image" name="product-image" value="{{ $product->image }}">
                    </div>
                </div>

                <div class="form-group addProRow2">
                    <label class="" for="Product Price">Price</label>
                    <div class="">
                        <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $product->price }}">
                    </div>
                    <label class="" for="Product unitPrice">Unit Price</label>
                    <div class="">
                        <input type="text" class="form-control" id="productUnitPrice" name="productUnitPrice" value="{{ $product->unitPrice }}">
                    </div>
                    <label class="" for="Product Quantity">Quantity</label>
                    <div class="">
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="{{ $product->quantity }}" readonly>
                    </div>
                    <label class="" for="Category ID">Categoty</label>
                    <div class="">
                    <select name="categoryID" id="categoryID" class="form-control">

                        @foreach($categoryID as $category)
                            <option value="{{$category->categoryID}}"
                            @if($product->categoryID==$category->categroyID)
                                selected
                            @endif
                                >{{$category->name}}</option>
                        @endforeach

                    </select>
                    </div>
                    <label class="" for="Brand ID">Brand</label>
                    <div class="">
                    <select name="brandID" id="brandID" class="form-control">

                        @foreach($brandID as $brand)
                            <option value="{{$brand->brandID}}"
                            @if($product->brandID==$brand->brandID)
                                selected
                            @endif
                                >{{$brand->name}}</option>
                        @endforeach

                    </select>
                    </div>
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="SupplierID" id="SupplierID" class="form-control">


                            @foreach($SupplierID as $supplier)
                            <option value="{{$supplier->supplierID}}"
                            @if($product->supplierID==$supplier->supplierID)
                                selected
                            @endif
                                >{{$supplier->supplierName}}</option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="form-group addProRow3">
                    <label class="" for="Product Desciption">Description</label>
                    <div class="">
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription" value="">{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="form-group addProRow4">
                    <label class="" for="Brand status">Status</label>
                    <div class="">
                    <select name="status" class="form-control" required>
                        <option value="">---Select Status---</option>
                        <option value="Available">Active</option>
                        <option value="Unavailable">Inactive</option>
                    </select>
                    </div>
                    <div class="">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewProduct') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    </div>
                </div>

                <div class="form-group addProRow5"></div>

            </form>
            @endforeach
    </div>
</div>

@endsection
