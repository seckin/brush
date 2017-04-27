@extends('layouts.main')

@section('content')

<body id="checkout" class="shipping subpage">

    @include('partials.navbar')
    
    <!--<header class="blank"></header>-->
    <section class="darker" id="checkout-shipping">
        <div class="container">
            <div class="process">
                <input class="orderid hidden" name="orderid" value="{{$order->id}}">
                <span>
                    <input type="text" name="firstname" placeholder="First name">
                    <input type="text" name="lastname" placeholder="Last name">
                    <input type="text" name="telephone" placeholder="Phone Number">
                </span>
                <span>
                    <input type="text" name="street" placeholder="Street Address">
                    <input type="text" name="city" placeholder="City">
                    <div class="dropdown-wrapper">
                        <button id="countryName" class="dropdown">
                            <a data-value="" href="#">Please select...</a>
                            <a data-value="TR" href="#">Turkey</a>
                            <input type="text" name="country" value="" />
                        </button>
                    </div>
                </span>
            </div>
            @include('partials.order-summary')
        </div>
        <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        });
        $("a.button.submit").click(function() {
            if($("input[name='firstname']").val().trim() == "") {
              alert("Please enter your first name");
              return;
            }
            if($("input[name='lastname']").val().trim() == "") {
              alert("Please enter your last name");
              return;
            }
            if($("input[name='street']").val().trim() == "") {
              alert("Please enter your street address");
              return;
            }
            if($("input[name='city']").val().trim() == "") {
              alert("Please enter your city");
              return;
            }
            if($("input[name='country']").val() == "") {
              alert("Please select your country");
              return;
            }
            if($("input[name='telephone']").val().trim() == "") {
              alert("Please enter your phone number");
              return;
            }

            var email = $(".subscribe #email").val();
            $.ajax({
                url: '/api/v1/shippingInfo',
                type: 'POST',
                data: {
                  order_id: $("input[name='orderid']").val().trim(),
                  firstname: $("input[name='firstname']").val().trim(),
                  lastname: $("input[name='lastname']").val().trim(),
                  address: $("input[name='street']").val().trim(),
                  city: $("input[name='city']").val().trim(),
                  country: $("input[name='country']").val(),
                  phone_number: $("input[name='telephone']").val().trim()
                },
                error: function() {
                },
                success: function(data) {
                    window.location.href='/checkout/payment';
                }
            });
        });

        // display order summary on pageload:
        $( document ).ready(function (){
            updateOrderSummary();
        });
       </script>
    </section>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')
    
</body>
@endsection