@extends('shoppingPageLayout')
@section('content')
<br>

<div class="container">
    {{--<img src="{{ $ }}" class="rounded float-left" alt="...">--}}
    <table class="table ">
        <h4>Order detail</h4>
        <br>
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Payment</th>
                <th scope="col">Order status</th>
                <th scope="col">Total</th>
                <th scope="col">Tracking Number</th>
            </tr>
        </thead>

        <tbody>
          @foreach($order as $order)
            <tr>
                  <td><a href="{{ route('orderDetail',['orderID'=>$order->orderID]) }}">#{{ $order->orderID }}</a></td>
                  <td>{{$order->paymentStatus}}</td>
                  <td>{{$order->status}}</td>
                  <td>RM{{$order->amount}}</td>
                  <td><a href="https://www.tracking.my/" target="_blank" rel="noopener noreferrer">{{$order->tracking_no}}</a></td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <br><br>
</div>
@endsection
