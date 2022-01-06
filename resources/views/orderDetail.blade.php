@extends('shoppingPageLayout')
@section('content')

<style>
    .tableii td {
        padding:10px;
    }

    .tableii {
        border-top: double;
        width: 100%;
    }
    
</style>

<br>

<div class="container">
    {{--<img src="{{ $ }}" class="rounded float-left" alt="...">--}}
    <table class="table " id="myTable">
        <h4>Order detail</h4>
        <br>
        <thead>
            <tr>
                <th scope="col" width="20%">Product</th>
                <th width="20%"></th>
                <th scope="col">Price (RM)</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>

        <tbody>
          @foreach($od as $ods)
            <tr>
                  <td><img src="{{ asset('images/') }}/{{$ods->image}}" alt="" width="150" name="image" class="rounded float-left"> </td>
                  <td>{{$ods->proname}} (SKU: {{$ods->productID}})</td>
                  <td>{{ $ods->price }}</td>
                  <td>{{ $ods->quantity }}</td>
            </tr>
            @endforeach

        </tbody>



    </table>

    <table class="tableii">
         <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td valign="top">Email: </td>
                <td >
                    <b>{{ $contact->useremail }}</b>
                </td>
            </tr>
            <tr>
                <td valign="top" >Shipping Address: </td>
                <td >
                    <div><b>{{ $contact->usName }}</b></div>
                    <div><b>{{ $contact->address }},</b></div>
                    <div><b>{{ $contact->city }}, {{ $contact->state }}</b></div>
                    <div><b>{{ $contact->zipcode }}</b></div>
                </td>
            </tr>
            <tr>
                <td>Tracking Number: </td>
                <td >
                    <b><a href="https://www.tracking.my/" target="_blank" rel="noopener noreferrer">{{ $contact->tracking_no }}</a></b>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <br><br>
</div>
@endsection
