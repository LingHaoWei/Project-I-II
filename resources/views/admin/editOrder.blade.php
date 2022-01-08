@extends('layout')
@section('content')

<style>
    td .prc{
        width: 200px;
    }

    .poNotesArea textarea{
        width: 100%;
        height: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .poStatus input {
        outline: none;
        border: none;
    }

    .addRow {
        width: 99%;
    }

    .notesandstatus {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    
    .printPOBtn {
        background-color: #5ab071;
        border: none;
        padding: 10px 15px;
        border-radius: 10px;
    }

    .addPo{
        border: 1px solid #8b8b8b;
        border-radius: 5px 5px 0px 0px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
    }


</style>

<!--Page topic-->
<!--Page topic-->

<div class="content" id="pwrapper1">
  <div class="">
        
        <div class="pageTopic addPo">
            <div><h2>Order Detail</h2></div>
        </div>

  </div>
  
  <div class="form addProForm row">
  @foreach($order as $or)
        <form method="POST" , action="{{ route('updateOrder',['id'=>$or->orderID]) }}" action="emaito:{{$or->useremail}}" enctype="multipart/form-data" id="dynamic_form">
        @csrf
        
        <div class="addRow">
        <input hidden id="id" name="orderID" value="{{$or->orderID}}" />
            

        </div>
            
            
        <div class="form-group addProRow1">

            <div class="supAddress">
            <label class="" for="Document No"><b>Order Number: #{{$or->orderID}}</b></label>
            <div class="">
            <br>
            </div>

            <label class="" for="Document No"><b>Customer Name</b></label>
            <div><input type="text" class="form-control" id="CustomerName" name="CustomerName" value="{{$or->username}}" readonly /></div>
            <label class="" for="Document No"><b>Shipping Address</b></label>
            <div><input type="text" class="form-control" id="ShippingAddress" name="ShippingAddress" value="{{$or->address}}" /></div>
            

            </div>

        </div>
        
        
        <div class="form-group addProRow2">
            <div class="">
            <br>
            </div>
            <div class="">
            <br>
            </div>

            <label class="" for="Document No"><b>Email Address</b></label>
            <div><input type="text" class="form-control" id="EmailAddress" name="EmailAddress" value="{{$or->useremail}}" readonly /></div>

            <label class="" for="Document No"><b>Contact Number</b></label>
            <div><input type="text" class="form-control" id="ContactNumber" name="ContactNumber" value="{{$or->contact}}" /></div>

        </div>
        

       
        <div class="form-group addProRow3">
        <table class="table" id="myTable">
        
            <thead>
                <tr>
                <th scope="col" width="3%"></th>
                <th scope="col" width="25%">Order Product</th>
                <th scope="col" width="15%">Order Quantity</th>
                <th scope="col" width="15%">Price</th>
                <th scope="col" width="10%">Subtotal</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach($orderDetail as $ord)
                    <tr>
                    <td></td>
                    <td>{{$ord->name}} ({{$ord->productID}})</td>
                    <input type="text" id="odproid" name="odproid[]" value="{{$ord->productID}}" hidden />
                    <td>
                        {{$ord->quantity}}
                        <input type="number" id="orderqt" name="orderqt[]" value="{{$ord->quantity}}" hidden />
                    </td>
                    <td>{{$ord->price}}</td>
                    <td id="subtotal"></td>
                    </tr>
            @endforeach
                    <tr>
                    <td></td>
                    <td></td>
                    <td hidden> 0 </td>
                    <td hidden>0</td>
                    <td hidden></td>
                    <td></td>
                    <td hidden>0</td>
                    <td><b> Shipping <b></td>
                    <td><span id="shippnigVal" style="">{{$or->amount}}</span></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td hidden> 0 </td>
                    <td hidden>0</td>
                    <td hidden></td>
                    <td></td>
                    <td hidden>0</td>
                    <td><b> Total <b></td>
                    <td><span id="totalVal" style="">{{$or->amount}}</span></td>
                    </tr>
            </tbody>
        <tfoot>
        
        </tfoot>
            
        </table>

        <br>
            
        </div>

        <div class="form-group printpoaddProRow4">
        @if($or->status == 'Cancelled')
        <label class="" for="Order status"> <b>Status</b> </label>
                    <div class="">
                        <button class="deleteBtn" style="color:white;">
                            <a href="#">{{$or->status}}</a> 
                        </button>
                    </div>
        @elseif($or->status == 'Fulfilled')
        <label class="" for="Order status">Status</label>
                    <div class="">
                    <select name="status" class="form-control" required style="width: 50%;">
                        <option value="">---Select Status---</option>
                        <option value="Fulfilled" selected>Fulfill Order</option>
                        <option value="Cancelled">Cancell Order</option>
                    </select>
                    </div>
            <label class="" for="Tracking No"><b>Tracking Number:</b></label>
            <div class="">
                <input type="text" class="form-control" id="TrackingNo" name="TrackingNo" value="{{$or->tracking_no}}" style="width: 50%; ">
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
        @else
            <label class="" for="Order status">Status</label>
                    <div class="">
                    <select name="status" class="form-control" required style="width: 50%;">
                        <option value="">---Select Status---</option>
                        <option value="Fulfilled">Fulfill Order</option>
                        <option value="Cancelled">Cancell Order</option>
                    </select>
                    </div>

            <label class="" for="Tracking No"><b>Tracking Number:</b></label>
            <div class="">
                <input type="text" class="form-control" id="TrackingNo" name="TrackingNo" value="{{$or->tracking_no}}" style="width: 50%; ">
            </div>
            <div class="">
            <Button type="button" class="backBtn">
                <a href="{{ route('viewOrder') }}" class="" title="Back" data-toggle="tooltip">Back</a>
            </Button>
            <button type="submit" class="subBtn" title="Submit">Submit</button>
            </div>
            @endif
        </div>
      
        <div class="form-group printpoaddProRow5">

        </div>
        @endforeach
        </form>

  </div>
</div>


<div id="elementH"></div>



<script>

var table = document.getElementById("myTable"), sumVal=0, subtotal=0;
var total = parseFloat(document.getElementById("totalVal").innerHTML);

for(var i = 1; i < table.rows.length; i++){
    subtotal = parseFloat(table.rows[i].cells[2].innerHTML) * parseFloat(table.rows[i].cells[3].innerHTML);
    table.rows[i].cells[4].innerHTML = "RM " + subtotal;
    sumVal += subtotal;
}

document.getElementById("shippnigVal").innerHTML = "RM " + (total - sumVal);
console.log(total);

</script>

@endsection
