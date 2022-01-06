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
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th>status</th>
            </tr>
        </thead>

        <tbody>
          @foreach($od as $ods)
            <tr>
                  <td width="200">{{ $ods->orderID }}</td>
                  <td><img src="{{ asset('images/') }}/{{$ods->image}}" alt="" width="150" name="image" class="rounded float-left"></td>
                  <td>RM{{ $ods->price }}</td>
                  <td>{{ $ods->quantity }}</td>
                  <td>{{ $ods->status }}</td>
            </tr>
            @endforeach

        </tbody>



    </table>
    <table>
         <thead>
            <tr>
                <th scope="col"style="border:none;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border:none;" width="700">
                    <p style="color:black;font-size:170%">  Delivery Address</p>
                    @foreach($contact as $ct)
                    <p style="font-size:120%">Receiver: {{ $ct->usName }}</p>
                    <p style="font-size:120%">Address: {{ $ct->address }}, {{ $ct->zipcode }}, {{ $ct->city }}, {{ $ct->state }}</p>
                    <p style="font-size:120%">Contact Number: {{ $ct->contact }}</p>
                    @endforeach
                </td>
                <td colspan="4" style='border:none;'></td>
            </tr>
        </tbody>
    </table>
    <br><br>
</div>
@endsection
