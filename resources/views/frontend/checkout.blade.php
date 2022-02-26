@extends('layouts.front')

@section('title')
    Check out
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{url('/place-order')}}" method="post">
            <div class="row">
                @csrf
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <span hidden class="h6 fw-bold float-end text-danger error">*All fields required</span>
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6 col-sm-6">
                                    <label for="first_n" class="form-label">First Name</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->name}}" name="fname" id="fname">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="last_n" class="form-label">Last Name</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->lname}}" name="lname"  id="lname">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input required type="email" class="form-control" value="{{Auth::user()->email}}" name="email" id="email">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input required type="phone" class="form-control" value="{{Auth::user()->phone}}" name="phone" id="phone">
                                </div>
                                <div class="col-md-6">
                                    <label for="addresse1" class="form-label">Address 1</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->address1}}" name="address1" id="address1">
                                </div>
                                <div class="col-md-6">
                                    <label for="addresse2" class="form-label">Address 2</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->address2}}" name="address2" id="address2">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="city" class="form-label">City</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->city}}" name="city" id="city">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->country}}" name="country" id="country">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="pin" class="form-label">Pin Code</label>
                                    <input required type="text" class="form-control" value="{{Auth::user()->pin_code}}" name="pin_code" id="pin">
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Product</td>
                                        <td>Qty</td>
                                        <td>Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total=0
                                    @endphp
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->prod_qty}}</td>
                                        <td>{{$item->prod_qty*$item->product->selling_price.' Dh'}}</td>
                                        @php
                                            $total+=$item->prod_qty*$item->product->selling_price
                                        @endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <span>{{$total}}</span>
                            </div>
                            <div class="row justify-content-end px-3">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-primary mb-2">Order Now</button><br>
                                <div id="paypal-button-container"></div>
                                {{-- <button type="submit" class="btn btn-outline-success razorpay_btn">Pay with Razorpay</button>    --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
{{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> --}}
{{-- <script src="{{ asset('frontend/js/checkout.js') }}"></script> --}}
<script src="https://www.paypal.com/sdk/js?client-id=ASOClJ7vm6FN_09-RU96k3I2KjivAOWifnFK6VusSlPIOF-im1nKjHyDFuHIrfoJ-bMA5YNlenkwRC1z&currency=USD"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    paypal.Buttons({

// Sets up the transaction when a payment button is clicked
createOrder: function(data, actions) {
  return actions.order.create({
    purchase_units: [{
      amount: {
        value: '{{$total}}' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
      }
    }]
  });
},

// Finalize the transaction after payer approval
onApprove: function(data, actions) {
  return actions.order.capture().then(function(orderData) {
    // Successful capture! For dev/demo purposes:
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        var transaction = orderData.purchase_units[0].payments.captures[0];
        alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
        var l_name=$('#lname').val();
        var f_name=$('#fname').val();
        var email=$('#email').val();
        var phone=$('#phone').val();
        var addr1=$('#address1').val();
        var addr2=$('#address2').val();
        var city=$('#city').val();
        var country=$('#country').val();
        var pin=$('#pin').val();
        
        $.ajax({
            type: "POST",
            url: "/place-order",
            data: {
                'lname':l_name,
                'fname':f_name,
                'email':email,
                'phone':phone,
                'address1':addr1,
                'address2':addr2,
                'city':city,
                'country':country,
                'pin_code':pin,
                'payment_mode':'Paid by Paypal',
                'payment_id':orderData.id
            },
            success: function (response) {
                swal.fire(response.status);
                window.location.href='/my-orders';
            }
        });
    // When ready to go live, remove the alert and show a success message within this page. For example:
    // var element = document.getElementById('paypal-button-container');
    // element.innerHTML = '';
    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
    // Or go to another URL:  actions.redirect('thank_you.html');
  });
}
}).render('#paypal-button-container');
</script>
@endsection