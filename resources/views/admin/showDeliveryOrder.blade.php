@extends('layout')
@section('content')
<style>

    .alert-failed{
        padding: 10px;
        background-color: #cf4242;
        color: white;
    }

    .alert-success{
        padding: 10px;
        background-color: #2d8a39;
        color: white;
    }
    
</style>

<!--Page topic-->

<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                @foreach($PurchaseOrder as $po)
                <div class="pageTopic"><h2>Delivery Order History</h2></div>
                <br>
                <div>Purchas Order: <b>{{$po->document_no}}</b></div>
                <div>From Supplier: <b>{{$po->supname}}({{$po->supiid}})</b></div>
                @endforeach
            </div>
        </div>
        
        <div class="iq-search-bar device-search">

        </div>
    </div>

    <div class="" id="pwrapper2">
    <table class="table" id="myTable">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col" width="">Delivery Order No</th> 
                <th scope="col">Date</th>
                
                </tr>
            </thead>
        <tbody>
        
            <tr>
            @forelse($DeliveryOrder as $do)
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="{{ route('viewDeliveryOrder',['id'=>$do->delivery_order_no]) }}" style="color:blue;"><div class="p-2">{{$do->delivery_order_no}}</div></a>
                </td>
                <td class="link">
                    <a href="#"><div class="p-2">{{$do->created_at}}</div></a>
                </td>
                
            </tr>
            @empty
            <tr>
                <td width="50"> 
                </td>
                <td class="link" width="20%">
                    Do not have any delivery order for this purchase order
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
        @endforelse
        
        </tbody>
        
        </table>
        <div class="" style="margin:10px;">
        <button type="button" class="deleteBtn" >
                <a href="{{ route('viewPurchaseOrder') }}" class="backBtn" title="Back" data-toggle="tooltip">Back</a> 
            </button>

        <button type="button" class="editBtn">
                <a href="{{ route('updateDeliveryOrder',['id'=>$po->id]) }}" class="printPO" title="Approve" data-toggle="tooltip">Add DO</a> 
        </button>
        </div>
    </div>

    

@endsection

<script>

</script>