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
                    <th width="12%">Order ID</th>
                    <th width="12%">Payment Status</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($or as $ord)
                    <tr>
                    <td width="60">
                    </td>
                    <td class="link">
                        <a href="{{ route('editOrder',['id'=>$ord->orderID]) }}" class="editOrder" title="Edit" data-toggle="tooltip"><div class="p-2">{{$ord->orderID}}</div></a>
                    </td>
                    <td>{{$ord->paymentStatus}}</td>
                    <td>{{ $ord->username }}</td>
                    <td>{{$ord->status}}</td>
                    <td>
                        <Button type="button" class="addButton">
                        <a href="{{ route('editOrder',['id'=>$ord->orderID]) }}" class="editOrder" title="Edit" data-toggle="tooltip">Edit</a>
                        </Button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    {{$or->links()}}
@endsection
