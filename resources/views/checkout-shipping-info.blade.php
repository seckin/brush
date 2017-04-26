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
        $("button[type='submit']").click(function() {

            var email = $(".subscribe #email").val();
            $.ajax({
                url: '/api/v1/shippingInfo',
                type: 'POST',
                data: {
                  order_id: $("input[name='orderid']").val(),
                  firstname: $("input[name='firstname']").val(),
                  lastname: $("input[name='lastname']").val(),
                  address: $("input[name='street']").val(),
                  city: $("input[name='city']").val(),
                  country: $("input[name='country']").val(),
                  phone_number: $("input[name='telephone']").val()
                },
                error: function() {
                },
                success: function(data) {
//                    window.location.href='/checkout/payment';
                }
            });
        });
       </script>
    </section>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')
    
    <!--
    <section class="modal">
        <div class="container">
            <div class="box">
                <div class="head">
                    <b>ONAY GEREKİYOR</b>
                </div>
                <div class="body">
                    <p>Taslağı silmek istediğinizden emin misiniz?</p>
                    <a class="button">TAMAM</a>
                    <a class="button reject">İPTAL</a>
                </div>
            </div>
        </div>
    </section>
    -->
</body>
@endsection