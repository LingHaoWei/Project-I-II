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
                <th scope="col">Payment status</th>
                <th scope="col">Total</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>

        <tbody>
          @foreach($order as $order)
            <tr>
                  <td><a href="{{ route('orderDetail',['orderID'=>$order->orderID]) }}">{{ $order->orderID }}</a></td>
                  <td>{{$order->paymentStatus}}</td>
                  <td>RM{{$order->amount}}</td>
                  <td>{{ $order->created_at }}
            </tr>
            @endforeach
        </tbody>

    </table>
    <br><br>
</div>
@endsection
