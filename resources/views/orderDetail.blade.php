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
          @foreach($od as $od)
            <tr>
                  <td width="200">{{ $od->orderID }}</td>
                  <td><img src="{{ asset('images/') }}/{{$od->image}}" alt="" width="150" name="image" class="rounded float-left"></td>
                  <td>RM{{ $od->price }}</td>
                  <td>{{ $od->quantity }}</td>
                  <td>{{ $od->status }}</td>
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
            @foreach($contact as $contact)
            <tr>
                <td style="border:none;" width="700">
                    <p style="color:black;font-size:170%">  Delivery Address</p>
                    <p style="font-size:120%">Receiver: {{ $contact->usName }}</p>
                    <p style="font-size:120%">Address: {{ $contact->address }}, {{ $contact->zipcode }}, {{ $contact->city }}, {{ $contact->state }}</p>
                    <p style="font-size:120%">Contact Number: {{ $contact->contact }}</p>

                </td>
                <td colspan="4" style='border:none;'></td>
            </tr>@endforeach
        </tbody>

    </table>
    <br><br>
</div>
@endsection
