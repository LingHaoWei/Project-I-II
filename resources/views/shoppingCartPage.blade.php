@extends('shoppingPageLayout')
@section('content')
<style>
.deleteCart {
  background-color: #f44336;
  border: none;
  color: rgb(206, 206, 206);
  padding: 3px 10px;
  border-radius: 10px;
}
a{
    color: rgb(0, 0, 0);
}
</style>
<!--================Cart Area =================-->
<section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table ">
                      <thead>
                          <tr>
                              <th scope="col"></th>
                              <th scope="col">Image</th>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($carts as $cart)
                          <tr>
                            <td><input type="checkbox" name="cid[]" id="cid[]" value="{{$cart->cid}}" onclick="cal()" >
                                <input type="hidden" name="subtotal[]" id="subtotal[]" value="{{ $cart->price*$cart->cartQty }}"> </td>
                                <td><img src="{{ asset('images/') }}/{{$cart->image}}" alt="" width="100"></td>
                                <td><h5>{{$cart->name}}</h5></td>
                                <td>{{$cart->price}}</td>
                                <td>{{$cart->cartQty}}</td>
                                <td>RM{{$cart->price*$cart->cartQty}}</td>
                                <td>
                                    <button type="button" class="deleteCart">
                                        <a href="{{ route('deleteCart',['id'=>$cart->cid]) }}" class="deleteCart" title="Delete" data-toggle="tooltip">Delete</a>
                                    </button>
                                </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td colspan="4"></td>
                            <td>Total Amount</td>
                            <td>RM<input type="text" id="sub" name="sub" value="0" style="border:none; background:transparent"  readonly></td>
                        </tr>
                        <tr>
                            <td colspan="5" style='border:none;'></td>
                            <td style='border:none;'><button type="submit" class="button button--active button-review">Checkout</button></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->
  <script>
    function cal(){
        var names = document.getElementsByName('subtotal[]');
        var subtotal = 0;
        var tax = 0;
        var total = 0;
        var cboxes = document.getElementsByName('cid[]')
        var len = cboxes.length;
        for(var i=0; i<len; i++){
            if(cboxes[i].checked){
                subtotal=parseFloat(names[i].value)+parseFloat(subtotal);
            }
        }
        //document.getElementById('sub').innerHTML=subtotal.toFixed(2);
        document.getElementById('sub').value=subtotal.toFixed(2); //teacher's example
    }
</script>
@endsection
