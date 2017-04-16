@extends('layouts.main')

@section('content')

<body id="designs" class="design subpage">
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
            <div class="cart-container">
                @foreach($cartItems as $cartItem)
                <div class="cart-element">
                    <span class="product-image-container" style="width:165px;">
                    <span class="product-image-wrapper" style="padding-bottom: 100%;">
                        @if ($cartItem->productSpec->type == "tshirt")
                        <img class="product-image-photo" src="{{$cartItem->design->tshirt_image}}" width="165" height="165" alt="{{$cartItem->design->name}}"></span>
                        @endif
                        @if ($cartItem->productSpec->type == "canvas")
                        <img class="product-image-photo" src="{{$cartItem->design->canvas_image}}" width="165" height="165" alt="{{$cartItem->design->name}}"></span>
                        @endif
                    </span>
                    <div class="custom_options">
                        <dl class="item-options">
                            <!-- <dt>Material</dt>Cotton Rag Fine Art Print</dd> -->
                            <dt>Size</dt>{{$cartItem->productSpec->size}}</dd>
                            @if ($cartItem->productSpec->type == "tshirt")
                            <dt>Gender</dt>{{$cartItem->productSpec->gender}}</dd>
                            @endif
                        </dl>
                    </div>
                    <label for="qty" class="label quantity-l"><span>Quantity</span></label>
                    <div>{{$cartItem->quantity}}</div>
                </div>
                @endforeach

                <div class="cart-summary">
                    <div id="cart-totals" class="cart-totals" data-bind="scope:'block-totals'">
                        <div class="table-wrapper" data-bind="blockLoader: isLoading">
                            <table class="data table totals">
                                <caption class="table-caption" data-bind="text: $t('Total')">Total</caption>
                                <tbody>
                                    <?php
                                        $total_price = 0;
                                        $shipping_cost = 0;
                                        foreach($cartItems as $cartItem) {
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
        </div>
    </section>

    @include('partials.subscribe-to-list')

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