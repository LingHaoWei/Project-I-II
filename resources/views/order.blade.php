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
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Delivery Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Total</th>
                <th>status</th>
            </tr>
        </thead>

        <tbody>
          @foreach($order as $order)
            <tr>
                  <td>{{ $order->orderID }}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->quantity}}</td>
                  @foreach($address as $ad)
                  <td>{{$ad->address }}</td>
                  @endforeach
                  @foreach($contact as $co)
                  <td>{{ $co->contact }}</td>
                  @endforeach
                  <td></td>
                  <td>processing</td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <br><br>
</div>
@endsection
