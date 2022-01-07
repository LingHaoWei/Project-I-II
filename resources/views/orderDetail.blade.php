@extends('shoppingPageLayout')
@section('content')

<style>
    .tablei td {
        padding:10px;
    }

    .tableii td {
        padding:10px;
    }

    .tablei {
        border-top: solid 1px #c9c9c9;
        border-right: solid 1px #c9c9c9;
        width: 100%;
    }

    .tableii {
        border-top: solid 1px #c9c9c9;
        width: 100%;
    }

    div.tableii{
        text-align:center;
    }

    .orderdetails {
        width: 100%;
        display: flex;
        justify-content: space-around;
    }

    .ordertotal {
        font-size:16px;
    }
    
</style>

<br>

<div class="container">
    {{--<img src="{{ $ }}" class="rounded float-left" alt="...">--}}
    <table class="table " id="myTable">
        @foreach($contacts as $orderid)
        <h4>Order detail #{{$orderid->orderID}}</h4>
        @endforeach
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

    <div class="orderdetails">
        <div class="tablei">
            <table >
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td valign="top" >Email: </td>
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
        </div>

        <div class="tableii">
            <table>
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>
                            <div class="ordertotal">Total amount : <b>RM {{$contact->amount}}</b></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
