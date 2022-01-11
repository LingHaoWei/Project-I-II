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
            <div class="addProBtn">
                <div class="p-3">
                    <Button type="button" class="addButton">
                        <a href="{{route('insertOfflineOrder')}}" class="addProduct" title="New" data-toggle="tooltip">+Add Offline Order</a>
                    </Button>
                </div>
            </div>
        </div>

        <div class="iq-search-bar device-search">
            <form method="POST" action="" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <div class="row" id="pwrapper2">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th width="12%">Order ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($OfflineOrder as $offorder)
                    <tr>
                    <td width="60">
                    </td>
                    <td class="link">
                        <a href="{{ route('viewOfflineOrderDetail',['id'=>$offorder->id]) }}" class="editOrder" title="Edit" data-toggle="tooltip"><div class="p-2">{{$offorder->order_no}}</div></a>
                    </td>
                    @if($offorder->status == 1)
                    <td>Paid</td>
                    @endif
                    <td>{{$offorder->created_at}}</td>
                    <td>
                        <button type="button" class="deleteBtn">
                            <a href="{{ route('deleteOfflineOrder',['id'=>$offorder->id]) }}" class="deleteProduct" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a>
                        </button>
                    </td>
                    
                    </tr>  
                @endforeach
                </tbody>
            </table>
    </div>

@endsection
