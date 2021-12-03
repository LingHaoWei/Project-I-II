@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="pageTopic addPro"><h2>Add Purchase Order</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="#" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">

                    <label class="" for="Document No">Document No</label>
                    <div class="">
                    <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
                    </div>
                    
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="chooseSupplier" id="chooseSupplier" class="form-control chooseSupplier" onchange="window.location.href=this.options[this.selectedIndex].value;">

                        <option selected="" disabled="">---Select Supplier---</option>

                        @foreach($supplier as $supplier)

                        <a href=""><option value="{{ route('getProduct',['id'=>$supplier->supplierID]) }}">{{$supplier->supplierName}}</option></a>

                        @endforeach

                    </select>
                    </div>

                </div>

                <div class="form-group addProRow2">
                    
                </div>

                <div class="form-group addProRow3">

                </div>

                <div class="form-group addProRow4">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewPurchaseOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>


@endsection

