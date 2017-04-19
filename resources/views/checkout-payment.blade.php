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

    <script>
        var stripe = Stripe('pk_live_rT8HEb47PxJvbZHme4C14NT6');
        var elements = stripe.elements();
    </script>

    <section id="checkout-payment">
       <ul class="opc-progress-bar">
            <li class="opc-progress-bar-item _complete is-hidden" data-bind="css: item.isVisible() ? '_active' : ($parent.isProcessed(item) ? '_complete' : '')">
                <span data-bind="text: item.title, click: $parent.navigateTo">Shipping</span>
            </li>

            <li class="opc-progress-bar-item _active" data-bind="css: item.isVisible() ? '_active' : ($parent.isProcessed(item) ? '_complete' : '')">
                <!-- <span data-bind="text: item.title, click: $parent.navigateTo">Review &amp; Payments</span> -->
            </li>
      </ul>
      <div class="opc-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment</div>

                    <div class="panel-body">
                        <form action="/charge" method="post" id="payment-form">
                          <div class="form-row">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors -->
                            <div id="card-errors"></div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>

                          <button>Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <aside class="opc-sidebar">
        <div class="opc-block-summary" data-bind="blockLoader: isLoading">
            <span data-bind="i18n: 'Order Summary'" class="title">Order Summary</span>
            <table class="data table table-totals">
                <caption class="table-caption" data-bind="i18n: 'Order Summary'">Order Summary</caption>
                <tbody>
                    <?php
                        $total_price = 0;
                        $shipping_cost = 0;
                        foreach($cartItems as $cartItem) {
                            $total_price += $cartItem->quantity * $cartItem->price_per_item;
                            $shipping_cost += $cartItem->shipping_cost;
                        }
                        $total_amount = $total_price + $shipping_cost;
                    ?>
                    <tr class="totals sub">
                        <th data-bind="text: title" class="mark" scope="row">Cart Subtotal</th>
                        <td class="amount">
                            <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Cart Subtotal">{{number_format($total_price/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span>
                        </td>
                    </tr>
                    <tr class="totals shipping excl">
                        <th class="mark" scope="row">
                            <span class="label" data-bind="text: title">Shipping</span>
                            <span class="value" data-bind="text: getShippingMethodTitle()">MNG - Home Delivery</span>
                        </th>
                        <td class="amount">
                            <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Shipping">{{number_format($shipping_cost/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span>
                        </td>
                    </tr>
                    <!-- <tr class="totals-tax">
                        <th data-bind="text: title" class="mark" scope="row">Tax</th>
                        <td data-bind="attr: {'data-th': title}" class="amount" data-th="Tax">
                            <span class="price" data-bind="text: getValue()">$4.38</span>
                        </td>
                    </tr> -->
                    <tr class="grand totals">
                        <th class="mark" scope="row">
                            <strong data-bind="text: title">Order Total</strong>
                        </th>
                        <td data-bind="attr: {'data-th': title}" class="amount" data-th="Order Total">
                            <strong><span class="price" data-bind="text: getValue()">{{number_format($total_amount/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="block items-in-cart" role="tablist">
                <div class="title" data-role="title" role="tab" aria-selected="false" aria-expanded="false" tabindex="0">
                    <strong role="heading"><span data-bind="text: getItemsQty()">{{count($cartItems)}}</span>
                        @if (count($cartItems) == 1)
                            <span>Item in Cart</span>
                        @else
                            <span>Items in Cart</span>
                        @endif
                    </strong>
                </div>
                <div class="content minicart-items" data-role="content" role="tabpanel" aria-hidden="true">
                    <div class="minicart-items-wrapper overflowed">
                        <ol class="minicart-items">
                            @foreach ($cartItems as $cartItem)
                            <li class="product-item">
                                <div class="product">
                                    <span class="product-image-container" style="height: 75px; width: 75px;">
                                        <span class="product-image-wrapper">
                                            @if ($cartItem->productSpec->type == "tshirt")
                                                <img src="{{$cartItem->design->tshirt_image}}" width="75" height="75" alt="{{$cartItem->design->name}}">
                                            @endif
                                            @if ($cartItem->productSpec->type == "canvas")
                                                <img src="{{$cartItem->design->canvas_image}}" width="75" height="75" alt="{{$cartItem->design->name}}">
                                            @endif
                                        </span>
                                    </span>
                                    <div class="product-item-details">
                                        <div class="product-item-inner">
                                            <div class="product-item-name-block">
                                                <strong class="product-item-name" data-bind="text: $parent.name">{{$cartItem->design->name}}</strong>
                                                <div class="details-qty">
                                                    <span class="label">Qty:</span>
                                                    <span class="value" data-bind="text: $parent.qty">{{$cartItem->quantity}}</span>
                                                </div>
                                            </div>
                                            <div class="subtotal">
                                                <span class="price-excluding-tax" data-bind="attr:{'data-label': $t('Excl. Tax')}" data-label="Excl. Tax">
                                                <span class="cart-price"><span class="price" data-bind="text: getFormattedPrice(getRowDisplayPriceExclTax($parents[2]))">{{number_format(($cartItem->quantity * $cartItem->price_per_item)/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></span></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="product options active" data-bind="mageInit: {'collapsible':{'openedState': 'active'}}" data-collapsible="true" role="tablist">
                                            <span data-role="title" class="toggle" role="tab" aria-selected="true" aria-expanded="true" tabindex="0"></span>
                                            <div data-role="content" class="content" role="tabpanel" aria-hidden="false" style="display: block;">
                                                <strong class="subtitle"></strong>
                                                <dl class="item-options">
                                                    <dt class="label" data-bind="text: label">Size</dt>
                                                    <dd class="values" data-bind="html: value">{{$cartItem->productSpec->size}}</dd>
                                                    @if ($cartItem->productSpec->type == "tshirt")
                                                    <dt class="label" data-bind="text: label">Gender</dt>
                                                    <dd class="values" data-bind="html: value">{{$cartItem->productSpec->gender}}</dd>
                                                    @endif
                                                    @if ($cartItem->productSpec->type == "canvas")
                                                    <dt class="label" data-bind="text: label">Framing</dt>
                                                    <dd class="values" data-bind="html: value">None</dd>
                                                    @endif
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="opc-block-shipping-information">
          <div class="shipping-information">
              <div class="ship-to">
                  <div class="shipping-information-title">
                      <span data-bind="i18n: 'Ship To:'">Ship To:</span>
                      <!-- <button class="action action-edit" data-bind="click: back">
                          <span data-bind="i18n: 'edit'">edit</span>
                      </button> -->
                  </div>
                  <div class="shipping-information-content">
                    {{$order->shippingInfo->name}} {{$order->shippingInfo->last_name}}<br>
                    {{$order->shippingInfo->address}}<br>
                    {{$order->shippingInfo->city}}<br>
                    {{$order->shippingInfo->country}}<br>
                    {{$order->shippingInfo->phone_number}}<br>
                  </div>
              </div>
              <div class="ship-via">
                  <div class="shipping-information-title">
                      <span data-bind="i18n: 'Shipping Method:'">Shipping Method:</span>
                      <!-- <button class="action action-edit" data-bind="click: backToShippingMethod">
                          <span data-bind="i18n: 'edit'">edit</span>
                      </button> -->
                  </div>
                  <div class="shipping-information-content">
                      <span class="value" data-bind="text: getShippingMethodTitle()">MNG - Home Delivery</span>
                  </div>
              </div>
          </div>
        </div>
      </aside>
    </section>
<script>
    $(".items-in-cart").click(function() {
        $(".items-in-cart").toggleClass("active");
    });
</script>
  
<script>
    // Custom styling can be passed to options when creating an Element.
    var style = {
      base: {
        // Add your base input styles here. For example:
        fontSize: '16px',
        lineHeight: '24px'
      }
    };

    // Create an instance of the card Element
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });


    // Create a token or display an error the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
    }

</script>


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