@extends('adminPageLayout')
@section('content')

<style>

    .addButton{
        border-radius: 4px;
        cursor: pointer;
    }

    .addButton:hover{
        background-color: #E1e4e5;
    }

</style>

<!--Page topic-->

<div class="container-fluid">
        <div class="row ">
          <div class="col-sm">
            <div class="p-1 pageTopic"> <a href="{{ url('adminHomePage') }}">Home</a> / <a href="#" class="currentPage">Product</a></div>
          </div>
        </div>
</div>

<!--Page topic-->

<div class="container-fluid border addAdminContent">
    <div class="row bg-light row1"> 
        <div class="col-sm-10">
            <div class="p-3"><b>Product List</b></div>
        </div>
        <div class="col-sm">
            <div class="p-3">
                <Button type="button" class="addButton">
                    <a href="{{ url('insertProduct') }}" class="addProduct" title="New" data-toggle="tooltip">New+</a>
                </Button>
            </div>

        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Product</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td> 
                    <a href=""><img src="{{asset('images/')}}/{{$product->image}}" alt="" width="66"> <div class="p-1">{{$product->name}}</div> </a>
                </td>
                <td>{{$product->supname}}</td>
                <td>
                    <button>Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    

</div>

@endsection