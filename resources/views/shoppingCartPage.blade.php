@extends('shoppingPageLayout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
.deleteCart {
  background-color: #f44336;
  border: none;
  color: rgb(206, 206, 206);
  padding: 3px 10px;
  border-radius: 10px;
}
.btn1 {
  background-color: #00ff15;
  border: none;
  color: rgb(48, 72, 104);
  padding: 3px 10px;
  border-radius: 10px;
}
a{
    color: rgb(0, 0, 0);
}
</style>
<!--================Cart Area =================-->
@if(Session::has('success'))

    <div class="alert alert-success" role="alert">

        {{Session::get('success')}}

    </div>

@endif
<section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <form action="{{ route('payment.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf

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
                            <td><input type="checkbox" class="form-check-input" name="cid[]" id="cid[]" value="{{$cart->cid}}" onclick="cal()" required>
                                <input type="hidden" name="subtotal[]" id="subtotal[]" value="{{ $cart->price*$cart->cartQty }}"> </td>
                                <td><img src="{{ asset('images/') }}/{{$cart->image}}" alt="" width="100" name="image"></td>
                                <td><h5>{{$cart->name}}</h5></td>
                                <td>{{$cart->price}}</td>
                                <input type="hidden" class="form-check-input" name="id[]" id="id[]" value="{{ $cart->productID }}" onclick="cal()">
                                <input type="hidden" class="form-check-input" name="name[]" id="name[]" value="{{ $cart->name }}" onclick="cal()">
                                <input type="hidden" name="price[]" id="price[]" value="{{ $cart->price }}">
                                <input type="hidden" name="image[]" id="image[]" value="{{ $cart->image }}">
                                <input type="hidden" name="status[]" id="status[]" value="Processing">
                                <td>
                                    <input type="hidden" name="cid1" id="cid1" value="{{ $cart->cid }}">
                                    <input type="number" name="quantity[]" id="quantity[]" size="2" maxlength="12" value="{{ $cart->cartQty }}"  class="input-text qty" max="{{ $cart->quantity }}" min="1">
                                    </td>

                                <td>RM{{$cart->price*$cart->cartQty}}</td>
                                <td>
                                    <button type="button" class="deleteCart">
                                        <a href="{{ route('deleteCart',['id'=>$cart->cid]) }}" class="deleteCart" title="Delete" data-toggle="tooltip" value="update">Delete</a>
                                    </button>
                                </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td colspan="4"></td>
                            <td>Total Amount</td>
                            <td>RM<input type="text" id="sub" name="sub" value="0" style="border:none; background:transparent"  readonly></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td>
                                @foreach($address as $ad)
                            @if($ad->state == 'Sarawak' ||$ad->state == 'Sabah')
                              <p><b>Shipping fee</b></p>
                              <input type="radio" name="shipping" id="shipping" value="5" onclick="cal()" checked disabled>
                              <label for="1">East Malaysia: RM5.00</label><br>
                              <input type="radio" name="shipping" id="shipping" value="0" onclick="cal()" disabled >
                              <label for="1">Free Shipping</label><br>
                              <input type="radio" name="shipping" id="shipping" value="2" onclick="cal()" disabled>
                              <label for="1">West Malaysia: RM2.00</label>
                            {{--@elseif (var subtotal > 100)
                            <p><b>Shipping fee</b></p>
                              <input type="radio" name="shipping" id="shipping" value="5" onclick="cal()" disabled>
                              <label for="1">East Malaysia: RM5.00</label><br>
                              <input type="radio" name="shipping" id="shipping" value="0" onclick="cal()" checked disabled >
                              <label for="1">Free Shipping</label><br>
                              <input type="radio" name="shipping" id="shipping" value="2" onclick="cal()" disabled>
                              <label for="1">West Malaysia: RM2.00</label>--}}
                            @else
                            <p><b>Shipping fee</b></p>
                            <input type="radio" name="shipping" id="shipping" value="5" onclick="cal()" disabled>
                            <label for="1">East Malaysia: RM5.00</label><br>
                            <input type="radio" name="shipping" id="shipping" value="0" onclick="cal()" disabled >
                            <label for="1">Free Shipping</label><br>
                            <input type="radio" name="shipping" id="shipping" value="2" onclick="cal()" checked disabled>
                            <label for="1">West Malaysia: RM2.00</label>
                            @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                            <td colspan="4"  style="border:0;"></td>
                            <td  style="border:0;">Total Payment</td>
                            <td  style="border:0;">RM<input type="text" id="sub1" name="sub1" value="0" style="border:none; background:transparent"  readonly></td>
                        <tr>
                            <td colspan="5">
                                <div class="panel panel-default credit-card-box">
                                <p><b>Billing Details</b></p><br>

                                <div class='form-row '>
                                <div class="col-md-6 form-group">
                                <label class='control-label'>Name on Card</label>
                                <input class='form-control' size='4' type='text'>
                                </div>

                                <div class="col-md-6 form-group">
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                                </div>

                                <div class='form-row '>
                                <div class="col-md-4 form-group">
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>

                                <div class="col-md-4 form-group">
                                <label class='control-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>

                                <div class="col-md-4 form-group">
                                <label class='control-label'>Expiration Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                                </div>

                                @foreach($address as $ad)
                                <div class='form-row '>
                                <div class="col-md-12 form-group">
                                <p>Delivery Address</p>

                                <textarea class="form-control" name="address" id="address" rows="5" value="{{$ad->address }}">{{ $ad->address }}</textarea>
                                </div>
                                </div>

                                <div class='form-row '>
                                    <div class="col-md-4 form-group">
                                        <p>State</p>
                                        <select name="state" class="form-control">
                                            <option value="">{{ $ad->state }}</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelatan">Kelatan</option>
                                            <option value="Melaka">Melaka</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Putrajaya">Putrajaya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <p>Zipcode</p>
                                        <input class='form-control' type="text" name="zipcode" id="zipcode" value="{{ $ad->zipcode }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <p>City</p>
                                        <input class='form-control' type="text" name="city" id="city" value="{{ $ad->city }}">
                                    </div>
                                </div>
                                <div class='form-row '>
                                <div class="col-md-12 form-group">
                                <p>Contact Number</p>
                                <input class='form-control' type="text" name="contact" id="contact" value="{{ $ad->contact }}">

                                </div>
                            </div>
                                @endforeach
                                <br>
                                <button type="submit" class="button button--active button-review">Pay Now</button>
                            </div></td>
                            <td>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" style='border:none;'></td>
                        </tr>
                      </tbody>

                  </table>
                </form>
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
        var shipping = document.getElementsByName('shipping');
        var cboxes = document.getElementsByName('cid[]');
        var cboxes1 = document.getElementsByName('id[]');
        var cboxes2 = document.getElementsByName('name[]');
        var cboxes3 = document.getElementsByName('quantity[]');
        var len = cboxes.length;
        for(var i=0; i<len; i++){
            if(cboxes[i].checked){
                subtotal=parseFloat(names[i].value)+parseFloat(subtotal);
            }
        }
        //var e = $("input:radio[name ='shipping']:checked").val(shipping);
        for (var i = 0, length = shipping.length; i < length; i++) {
        if (shipping[i].checked) {
            subtotal1 = parseFloat(shipping[i].value) + parseFloat(subtotal);
            }
        }
        //document.getElementById('sub').innerHTML=subtotal.toFixed(2);
        document.getElementById('sub').value=subtotal.toFixed(2); //teacher's example
        document.getElementById('sub1').value=subtotal1.toFixed(2);
    }
</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
  var $form = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
    $inputs = $form.find('.required').find(inputSelector),
    $errorMessage = $form.find('div.error'),
    valid = true;
    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
      if (response.error) {
          $('.error')
              .removeClass('hide')
              .find('.alert')
              .text(response.error.message);
      } else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
      }
  }
});

</script>
@endsection
