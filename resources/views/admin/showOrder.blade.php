@extends('layout')
@section('content')
<style>
</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1">
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Order Detail</h2></div>
            </div>
        </div>
    </div>

    <div class="row" id="pwrapper2">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th>OrderID</th>
                    <th>Product Name</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($or as $ord)
                    <tr>
                    <td width="60">
                    </td>
                    <td>{{$ord->orderID}}</td>
                    <td>{{$ord->name}}</td>
                    <td>{{ $ord->productID }}</td>
                    <td>{{ $ord->quantity }}</td>
                    <td>{{$ord->status}}</td>
                    <td>
                        <Button type="button" class="addButton">
                        <a href="{{ route('editOrder',['id'=>$ord->id]) }}" class="editOrder" title="Edit" data-toggle="tooltip">Edit</a>
                        </Button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    {{$or->links()}}
@endsection
