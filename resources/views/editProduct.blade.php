@extends('layout')
@section('content')

<style>

  button .backToCategory {
    color: white;
    text-decoration: none;
  }

</style>

<!--Page topic-->
<!--Page topic-->

<div class="container content border" id="pwrapper1">
    <div class="row bg-light row1">
    @foreach($products as $product)
      <div class="col-sm">
          <div class="p-3 addPro"><b>{{ $product->name }}</b></div>
      </div>
    </div>

    <div class="editProForm">
        <div class="col-sm p-3">
            <form method="POST", action="{{ route('updateProduct') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control" id="id" name="id" value="{{$product->id}}">
                
                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right"></div>
                    <div class="col-md-8">
                    <img src="{{asset('images/')}}/{{$product->image}}" alt="" width="10%">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product ID">Product ID</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productID" name="productID" value="{{ $product->productID }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Name">Product Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Desciption">Description</label>
                    <div class="col-md-4">
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription" value="">{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Quantity">Quantity</label> 
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="{{ $product->quantity }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Price">Price</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Variety">Variety</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productVariety" name="productVariety" value="{{ $product->productVariety }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product SKU">Product SKU</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productSKU" name="productSKU" value="{{ $product->productSKU }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Image">Image</label>
                    <div class="col-md-4">
                        <input type="file" class="form-control" id="product-image" name="product-image" value="{{ $product->image }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Category ID">Categoty</label>
                    <div class="col-md-3">
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
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Brand ID">Brand</label>
                    <div class="col-md-3">
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
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Supplier ID">Supplier</label>
                    <div class="col-md-3">
                    <select name="SupplierID" id="SupplierID" class="form-control">

                        <option value="">---Select Brand---</option>

                        @foreach($SupplierID as $supplier)

                        <option value="{{$supplier->supplierID}}">{{$supplier->supplierName}}</option>

                        @endforeach

                        {{-- 
                            @foreach($SupplierID as $supplier)
                            <option value="{{$supplier->supplierID}}"
                            @if($product->supplierID==$supplier->supplierID)
                                selected
                            @endif
                                >{{$supplier->supplierName}}</option>
                        @endforeach
                         --}}
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="Brand status">Status</label>
                    <div class="col-md-3">
                    <select name="status" class="form-control" required>
                        <option value="">---Select Status---</option>
                        <option value="Available">Active</option>
                        <option value="Unavailable">Inactive</option>
                    </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                    <Button type="button" class="btn btn-secondary">
                        <a href="{{ route('viewProduct') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="btn btn-primary" title="Submit">Submit</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

@endsection
