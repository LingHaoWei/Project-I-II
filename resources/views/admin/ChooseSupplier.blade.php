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
            <form method="POST", action="{{ route('addProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">

                    <label class="" for="Document No">Document No</label>
                    <div class="">
                    <input type="text" class="form-control" id="DocumentNo" name="DocumentNo" value="{{$docno}}" readonly>
                    </div>
                    
                    <label class="" for="Supplier ID">Supplier</label>
                    <div class="">
                    <select name="supplier" id="supplier" class="form-control selectSupplier" >

                        <option selected="" disabled="">---Select Supplier---</option>

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

                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>

<script>
    $(document).ready(function(){

        $("select[name='supplier']").change(function(e){
        var id_supplier = $(this).val();
        var url = "{{ url('admin/insertPurchaseOrder') }}"+'/'+id_supplier;

        window.location.heref = url;
        })

    })
</script>

@endsection