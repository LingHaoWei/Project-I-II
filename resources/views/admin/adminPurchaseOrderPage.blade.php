@extends('layout')
@section('content')
<style>


    
</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Purchase Order List</h2></div>
            </div>
            <div class="addProBtn">
                <div class="p-3">
                    <Button type="button" class="addButton">
                        <a href="{{route('insertPO')}}" class="addProduct" title="New" data-toggle="tooltip">+Add Purchase Order</a>
                    </Button>
                </div>
            </div>
        </div>
        
        <div class="iq-search-bar device-search">
            <form method="POST" action="{{ route('searchPurchaseOrder') }}" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <div class="" id="pwrapper2">
    <table class="table" id="myTable">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col" >Purchase Order No</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
        @foreach($purchaseOrder as $po)
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="{{ route('viewPurchaseOrderDetail',['id'=>$po->id]) }}"><div class="p-2">{{$po->document_no}}</div></a>
                </td>
                <td class="link">
                    <div class="p-2">{{$po->supname}}</div>
                </td>
                <td>
                    <Button type="button" class="editBtn">
                        <a href="{{ route('viewDOHistory',['id'=>$po->id]) }}" class="" title="Edit" data-toggle="tooltip">Delivery Order</a>
                    </Button>

                    <Button type="button" class="printPOBtn">
                        <a href="{{ route('viewINHistory',['id'=>$po->id]) }}" class="" title="Edit" data-toggle="tooltip">Invoice</a>
                    </Button>
                    @if($po->status == 1)
                            
                    @else
                        <button type="button" class="deleteBtn">
                            <a href="{{ route('deletePurchaseOrder',['id'=>$po->id]) }}" class="deleteProduct" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                        </button>
                    @endif
                    
                </td>
            </tr>          
        @endforeach
        
        </tbody>
        
        </table>


    </div>
    {{$purchaseOrder->links()}}
    

    

@endsection

<script>



</script>