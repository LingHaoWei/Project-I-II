@extends('layout')
@section('content')

<style>
</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
      <div class="col-sm">
          <div class="pageTopic addPro"><h2>Add Invoice</h2></div>
      </div>

        <div class="form addProForm">
            <form method="POST", action="#" enctype="multipart/form-data">
                @csrf

                <div class="form-group addProRow1">

                    <label class="" for="DeliveryOrder ID">Delivery Order</label>
                    <div class="">
                    <select name="chooseDeliveryOrder" id="chooseDeliveryOrder" class="form-control chooseDeliveryOrder" onchange="window.location.href=this.options[this.selectedIndex].value;">

                        <option selected="" disabled="">---Select Delivery Order---</option>

                        @foreach($DeliveryOrder as $do)

                        <a href=""><option value="{{ route('updateInvoice',['id'=>$do->delivery_order_no]) }}">{{$do->delivery_order_no}}</option></a>

                        @endforeach

                    </select>
                    </div>

                </div>

                <div class="form-group addProRow3">
                    
                </div>

                <div class="form-group addProRow4">
                    <Button type="button" class="backBtn">
                        <a href="{{ route('viewINHistory',['id'=>$po->id]) }}" class="" title="Back" data-toggle="tooltip">Back</a>
                    </Button>
                    <button type="submit" class="subBtn" title="Submit">Submit</button>
                    
                </div>

                <div class="form-group addProRow5"></div>
                
            </form>
        </div>
</div>


<script>


</script>

@endsection

