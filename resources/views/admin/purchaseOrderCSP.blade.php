@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div id="pwrapper1">
        <div class="productRow1"> 
            <div class="">
                <div class="pageTopic"><h2>Choose Supplier</h2></div>
            </div>
        </div>
        
        <div class="iq-search-bar device-search">
            <form action="#" class="searchbox">
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" class="text search-input" placeholder="">
            </form>
        </div>
    </div>

    <div class="row" id="pwrapper2">
            <table class="table">
                <thead>
                    <tr>
                    <th></th>
                    <th>Supplier ID</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Status</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($supplier as $supplier)
                    <tr>
                    <td width="60"> 
                    </td>
                    <td>{{$supplier->supplierID}}</td>
                    <td>
                        <a href="{{ route('editSupplier',['id'=>$supplier->id]) }}" style="color:black; text-decoration:none;">{{$supplier->supplierName}}</a>
                    </td>
                    <td>{{$supplier->contactPerson}}</td>
                    <td>{{$supplier->status}}</td>
                    <td>
                        <Button type="button" class="addButton">
                            <a href="{{ route('getProduct',['id'=>$supplier->supplierID]) }}" class="selectSp" title="select" data-toggle="tooltip">Select</a>
                        </Button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>

@endsection
