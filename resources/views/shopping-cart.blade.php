@extends('layouts.main')

@section('content')

<body id="checkout" class="cart subpage">

    @include('partials.navbar')

    <!-- <header class="blank"></header> -->
    <section class="darker" id="checkout-cart">
        <div class="container">
            <div class="process">
                @foreach($cartItems as $cartItem)
                <div class="segment" data-cart-item-id="{{$cartItem->id}}">
                    @if ($cartItem->productSpec->type == "tshirt")
                    <img class="picture" src="{{$cartItem->design->tshirt_image}}" alt="{{$cartItem->design->name}}">
                    @endif
                    @if ($cartItem->productSpec->type == "canvas")
                    <img class="picture" src="{{$cartItem->design->canvas_image}}" alt="{{$cartItem->design->name}}">
                    @endif
                    <div class="information">
                        <h3 class="product-name">{{$cartItem->design->name}}</h3>
                        <p class="product-type">{{$cartItem->productSpec->type}}</p>
                        <dl>
                            <dt>Size</dt>
                            <dd>{{$cartItem->productSpec->size}}</dd>
                        </dl>
                        @if ($cartItem->productSpec->type == "tshirt")
                        <dl>
                            <dt>Gender</dt>
                            <dd>{{$cartItem->productSpec->gender}}</dd>
                        </dl>
                        @endif
                        <dl>
                            <dt>Quantity</dt>
                            <dd>{{$cartItem->quantity}}</dd>
                        </dl>
                    </div>
                    <div class="price">
                        {{number_format((float)$cartItem->price_per_item * $cartItem->quantity / 100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i>
                    </div>
                    <div class="remove-from-cart"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                </div>
                @endforeach
            </div>
            @include('partials.order-summary')
        </div>
    </section>

    @include('partials.service-details')

    @include('partials.subscribe-to-list')

    @include('partials.footer')

    <script>
        $(".remove-from-cart").click(function(event) {
            var cartItemId = $(event.target).parents(".segment").data("cartItemId");
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            var email = $(".subscribe #email").val();
            $.ajax({
                url: '/api/v1/cartItem',
                type: 'DELETE',
                data: {
                  id: cartItemId
                },
                error: function() {
                },
                success: function(data) {
                    $(event.target).parents(".segment").fadeOut( "fast", function() {
                        $(event.target).parents(".segment").remove();
                    });
                    updateCart();
                }
            });
        });
    </script>

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