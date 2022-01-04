@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="" id="pwrapper1">
    @foreach($or as $or)
      <div class="">
          <div class="pageTopic addPro"><h2>{{ $or->OrderID }}</h2></div>
      </div>

    <div class="form editProForm">
            <form method="POST", action="{{ route('updateOrder') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control" id="id" name="id" value="{{$or->id}}">

                <div class="form-group addProRow3">
                    <div class=""></div>
                    <div class="">
                    <img src="{{asset('images/')}}/{{$or->image}}" alt="" width="20%">
                    </div>
                </div>

                <div class="form-group addProRow1">
                    <label class="" for="Product ID">Product ID</label>
                    <div class="">
                        <input type="text" class="form-control" id="productID" name="productID" value="{{ $or->productID }}" readonly>
                    </div>
                    <label class="" for="Product Name">Product Name</label>
                    <div class="">
                        <input type="text" class="form-control" id="productName" name="productName" value="{{ $or->name }}" readonly>
                    </div>
                </div>

                <div class="form-group addProRow2">
                    <label class="" for="Product Price">Price</label>
                    <div class="">
                        <input type="text" class="form-control" id="productPrice" name="productPrice" value="RM{{ $or->price }}" readonly>
                    </div>
                    <label class="" for="Product Quantity">Quantity</label>
                    <div class="">
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="{{ $or->quantity }}" readonly>
                    </div>
                </div>

                <div class="form-group addProRow4">
                    <label class="" for="Brand status">Status</label>
                    <div class="">
                    <select name="status" class="form-control" required>
                        <option value="">---Select Status---</option>
                        <option value="Processing">Processing</option>
                        <option value="Arrived at Sortation Center">Arrived at Sortation Center</option>
                        <option value="Arrived at Distribution Center">Arrived at Distribution Center</option>
                        <option value="Preparing for Delivery">Preparing for Delivery</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    </div>
                    <div class="">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewOrder') }}" class="backToCategory" title="Back" data-toggle="tooltip">Back</a>
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
