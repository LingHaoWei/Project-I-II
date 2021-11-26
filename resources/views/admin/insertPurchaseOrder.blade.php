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
            <form method="POST", action="#" enctype="multipart/form-data" role="form">
                @csrf

                <div class="form-group addProRow1">

                    <label class="" for="Product ID">Document No</label>

                    <div class="">
                        <input type="text" class="form-control" id="docNo" name="document_no" placeholder="Document No" value="{{ $docno }}">
                    </div>


                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="SupplierID" id="SupplierID" class="form-control select2">

                        <option value="" selected="" disable="">---Select Supplier---</option>

                        @foreach($supplier as $supplier)

                        <option value="{{$supplier->supplierID}}">{{$supplier->supplierName}}</option>

                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="form-group addProRow2">
                    
                </div>

                <div class="form-group addProRow3">
                    
                </div>

                <div class="form-group addProRow4">
                    
                    <div class="">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewPurchaseOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Next</button>
                    </div>
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){

        $("select[name=SupplierID]").change(function(e){

            var supplierID = $(this).val();
            var url = "{{ url('insertPurchaseOrder/product') }}"+'/'+supplierID;

            window.location.href = url;
        })

    })



</script>

@endsection