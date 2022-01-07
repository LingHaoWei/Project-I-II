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
                <th scope="col" width="50"></th>
                <th scope="col" width="15%">Invoice No</th> 
                <th scope="col"  width="25%">Delivery Order</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                
                </tr>
            </thead>
        <tbody>
        @forelse($Invoice as $invoice)
            <tr>
                <td > 
                </td>
                <td class="link">
                    <a href="{{ route('viewInvoice',['id'=>$invoice->purchase_order]) }}" style="color:blue;"><div class="p-2">{{$invoice->invoice_no}}</div></a>
                </td>
                <td class="link">
                    <div class="link">
                    <a href="{{ route('viewDeliveryOrder',['id'=>$invoice->delivery_order]) }}" style="color:blue;" target="_blank"><div class="p-2">#{{$invoice->delivery_order}}</div></a>
                    </div>
                </td>
                <td>
                    RM {{$invoice->total_amount}}
                </td>
                <td>
                    {{$invoice->created_at}}
                </td>
                
            </tr>
            @empty
            <tr>
                <td width="50"> 
                </td>
                <td class="link" width="20%">
                    Do not have any invoice order for this purchase order
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
                <a href="{{ route('updateInvoice',['id'=>$invoice->purchase_order]) }}" class="printPO" title="Approve" data-toggle="tooltip">Add Invoice</a> 
        </button>
        </div>
    </div>

    

@endsection

<script>

</script>