@extends('layout')
@section('content')
<style>


    
</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Delivery Order History</h2></div>
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
                <th scope="col">Purchase Order No</th>
                <th scope="col">Date</th>
                <th scope="col">Delivery Order No</th> 
                <th scope="col">Vendor</th> 
                <th scope="col">Product</th>
                <th scope="col">Received Quantity</th>
                
                </tr>
            </thead>
        <tbody>
        @forelse($PurchaseOrder as $po)
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="#"><div class="p-2">{{$po->document_no}}</div></a>
                </td>
                <td>
                    <div class="p-2">{{$po->dodate}}</div>
                </td>
                <td class="link">
                    <a href="#"><div class="p-2">{{$po->dono}}</div></a>
                </td>
                <td class="link">
                    <div class="p-2">{{$po->supname}}</div>
                </td>
                <td>
                    <div class="p-2">{{$po->proid}}</div>
                </td>
                <td>
                    <div class="p-2">{{$po->sentqt}}</div>
                </td>
                
            </tr>
            @empty
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    Do not have such purchase order
                </td>
            </tr>
            
        @endforelse
        
        </tbody>
        
        </table>
        <Button type="button" class="backBtn" style="margin:10px;">
            <a href="{{ route('viewDeliveryOrder',['id'=>$po->id]) }}" class="" title="Back" data-toggle="tooltip">Back</a>
        </Button>
    </div>

    

@endsection

<script>

</script>