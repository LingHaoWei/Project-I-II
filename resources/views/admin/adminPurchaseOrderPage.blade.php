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
                        <a href="{{route('chooseSupplier')}}" class="addProduct" title="New" data-toggle="tooltip">+Add Purchase Order</a>
                    </Button>
                </div>
            </div>
        </div>
        
        <div class="iq-search-bar device-search">
            <form method="POST" action="#" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <div class="" id="pwrapper2">
    <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Document No</th>
                <th scope="col">Vendor</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
        <tbody>
        @forelse($purchaseOrder as $po)
            <tr>
                <td width="50"> 
                </td>
                <td class="link">
                    <a href="#"><div class="p-2">{{$po->document_no}}</div></a>
                </td>
                <td class="link">
                    <a href="{{ route('viewSupplier') }}"><div class="p-2">{{$po->supplierID}}</div></a>
                </td>
                <td>
                    <Button type="button" class="editBtn">
                        <a href="#" class="editProduct" title="Edit" data-toggle="tooltip">Edit</a>
                    </Button>

                    <button type="button" class="deleteBtn">
                        <a href="#" class="deleteProduct" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                    </button>
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


    </div>

    

@endsection