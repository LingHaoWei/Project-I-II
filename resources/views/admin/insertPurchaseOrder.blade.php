@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="pageTopic addPro"><h2>Add Product</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="{{ route('addProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="SupplierID" id="SupplierID" class="form-control">

                        <option value="">---Select Brand---</option>

                        @foreach($SupplierID as $supplier)

                        <option value="{{$supplier->supplierID}}">{{$supplier->supplierName}}</option>

                        @endforeach

                    </select>
                    </div>

                    <label class="" for="Product Name">Product Name</label>
                    <div class="">
                        <input type="text" class="form-control" id="productName" name="productName">
                    </div>
                    <label class="" for="Product Variety">Variety</label>
                    <div class="">
                        <input type="text" class="form-control" id="productVariety" name="productVariety">
                    </div>
                    <label class="" for="Product SKU">Product SKU</label>
                    <div class="">
                        <input type="text" class="form-control" id="productSKU" name="productSKU">
                    </div>
                </div>

                <div class="form-group addProRow2">
                    <label class="" for="Product Price">Price</label>
                    <div class="">
                        <input type="text" class="form-control" id="productPrice" name="productPrice">
                    </div>
                    <label class="" for="Product Quantity">Quantity</label> 
                    <div class="">
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity">
                    </div>
                    <label class="" for="Category ID">Category</label>
                    <div class="">
                    <select name="categoryID" id="categoryID" class="form-control">

                        <option value="">---Select Category---</option>

                        @foreach($categoryID as $category)

                        <option value="{{$category->categoryID}}">{{$category->name}}</option>

                        @endforeach

                    </select>
                    </div>

                    
                </div>

                <div class="form-group addProRow3">
                    <label class="" for="Product Desciption">Notes</label>
                    <div class="">
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription"></textarea>
                    </div>
                </div>

                <div class="form-group addProRow4">
                    <label class="" for="Brand status">Status</label>
                    <div class="">
                    <select name="status" class="form-control selectAvai" required>
                        <option value="">---Select Status---</option>
                        <option value="Available">Active</option>
                        <option value="Unavailable">Inactive</option>
                    </select>
                    </div>
                    <div class="">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewProduct') }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    </div>
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>

@endsection
