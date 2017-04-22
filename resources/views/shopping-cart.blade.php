@extends('layouts.main')

@section('content')

<body id="cart" class="design subpage">
    <!-- <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section> -->

    @include('partials.navbar')

    <!-- <header class="blank"></header> -->
    <section id="shopping-cart">
        <div class="container">
            <div class="products">
                @foreach($cartItems as $cartItem)
                <div class="segment" data-cart-item-id="{{$cartItem->id}}">
                    @if ($cartItem->productSpec->type == "tshirt")
                    <img class="picture" src="{{$cartItem->design->tshirt_image}}" alt="{{$cartItem->design->name}}">
                    @endif
                    @if ($cartItem->productSpec->type == "canvas")
                    <img class="picture" src="{{$cartItem->design->canvas_image}}" alt="{{$cartItem->design->name}}">
                    @endif
                    <div class="information">
                        <h3>{{$cartItem->design->name}}</h3>
                        @if ($cartItem->productSpec->type == "canvas")
                        <dl>
                            <dt>Type</dt><dd>Canvas</dd>
                        </dl>
                        @endif
                        @if ($cartItem->productSpec->type == "tshirt")
                        <dl>
                            <dt>Type</dt><dd>Tshirt</dd>
                        </dl>
                        @endif
                        <dl>
                            <dt>Size</dt><dd>{{$cartItem->productSpec->size}}</dd>
                        </dl>
                        @if ($cartItem->productSpec->type == "tshirt")
                        <dl>
                            <dt>Gender</dt><dd>{{$cartItem->productSpec->gender}}</dd>
                        </dl>
                        @endif
                        <div class="remove-from-cart" style="width:20px; height:20px;"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="summary">
                <div id="cart-totals" class="cart-totals" data-bind="scope:'block-totals'">
                    <div class="table-wrapper" data-bind="blockLoader: isLoading">
                        <table class="data table totals">
                            <caption class="table-caption" data-bind="text: $t('Total')">Total</caption>
                            <tbody>
                                <?php
                                    $total_price = 0;
                                    $shipping_cost = 0;
                                    foreach($cartItems as $cartItem) {
                                        // echo "cartitem id : " . $cartItem->id . "         ";
                                        $total_price += $cartItem->quantity * $cartItem->price_per_item;
                                        $shipping_cost += $cartItem->shipping_cost;
                                    }
                                    $total_count = $total_price + $shipping_cost;
                                ?>
                                <tr class="totals sub">
                                    <th data-bind="text: title" class="mark" scope="row">Subtotal</th>
                                    <td class="amount">
                                        <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Subtotal">{{number_format($total_price/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span>
                                    </td>
                                </tr>
                                    <tr class="totals shipping excl">
                                        <th class="mark" scope="row">
                                            <span class="label" data-bind="text: title">Shipping</span>
                                            <span class="value" data-bind="text: getShippingMethodTitle()">(MNG)</span>
                                        </th>
                                        <td class="amount">
                                            <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Shipping">{{number_format($shipping_cost/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span>
                                        </td>
                                    </tr>
                                <tr class="grand totals">
                                    <th class="mark" scope="row">
                                        <strong data-bind="text: title">Order Total</strong>
                                    </th>
                                    <td data-bind="attr: {'data-th': title}" class="amount" data-th="Order Total">
                                        <strong><span class="price" data-bind="text: getValue()">{{number_format($total_count/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" title="Go to Checkout" class="action primary checkout" onclick="window.location.href='/checkout';">
                    <span>Go to Checkout</span>
                </button>
            </div>
        </div>
    </section>

    @include('partials.subscribe-to-list')

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
    <footer>
        <div class="container">
            
        </div>
    </footer>
-->
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