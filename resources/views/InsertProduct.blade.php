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

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="productTopic addPro"><h2>Add Product</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="{{ route('addProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">
                    <label class="" for="Product ID">Product ID</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="productID" name="productID">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Product Name">Product Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="productName" name="productName">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Product Variety">Variety</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productVariety" name="productVariety">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Product SKU">Product SKU</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productSKU" name="productSKU">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Product Image">Image</label>
                    <div class="col-md-4">
                        <input type="file" class="form-control" id="product-image" name="product-image">
                    </div>
                </div>
                <div class="form-group row">
                </div>

                <div class="form-group addProRow2">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Price">Price</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="productPrice" name="productPrice">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Product Quantity">Quantity</label> 
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity">
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Category ID">Categoty</label>
                    <div class="col-md-3">
                    <select name="categoryID" id="categoryID" class="form-control">

                        <option value="">---Select Category---</option>

                        @foreach($categoryID as $category)

                        <option value="{{$category->categoryID}}">{{$category->name}}</option>

                        @endforeach

                    </select>
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Brand ID">Brand</label>
                    <div class="col-md-3">
                    <select name="brandID" id="brandID" class="form-control">

                        <option value="">---Select Brand---</option>

                        @foreach($brandID as $brand)

                        <option value="{{$brand->brandID}}">{{$brand->name}}</option>

                        @endforeach

                    </select>
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Supplier ID">Supplier</label>
                    <div class="col-md-3">
                    <select name="SupplierID" id="SupplierID" class="form-control">

                        <option value="">---Select Brand---</option>

                        @foreach($SupplierID as $supplier)

                        <option value="{{$supplier->supplierID}}">{{$supplier->supplierName}}</option>

                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="form-group addProRow3">
                    <label class="col-md-4 col-form-label text-md-right" for="Product Desciption">Description</label>
                    <div class="col-md-4">
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription"></textarea>
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="Brand status">Status</label>
                    <div class="col-md-3">
                    <select name="status" class="form-control" required>
                        <option value="">---Select Status---</option>
                        <option value="Available">Active</option>
                        <option value="Unavailable">Inactive</option>
                    </select>
                    </div>
                    <div class="col-md-6 offset-md-4">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewProduct') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
</div>

@endsection
