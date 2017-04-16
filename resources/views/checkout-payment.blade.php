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

    
    <section id="checkout-shipping-info">
       <ul class="opc-progress-bar">
            <li class="opc-progress-bar-item _complete is-hidden" data-bind="css: item.isVisible() ? '_active' : ($parent.isProcessed(item) ? '_complete' : '')">
                <span data-bind="text: item.title, click: $parent.navigateTo">Shipping</span>
            </li>

            <li class="opc-progress-bar-item _active" data-bind="css: item.isVisible() ? '_active' : ($parent.isProcessed(item) ? '_complete' : '')">
                <!-- <span data-bind="text: item.title, click: $parent.navigateTo">Review &amp; Payments</span> -->
            </li>
      </ul>
    </section>
  <aside class="opc-sidebar">
    <div class="opc-block-summary" data-bind="blockLoader: isLoading">
        <span data-bind="i18n: 'Order Summary'" class="title">Order Summary</span>
        <table class="data table table-totals">
            <caption class="table-caption" data-bind="i18n: 'Order Summary'">Order Summary</caption>
            <tbody>
                <tr class="totals sub">
                    <th data-bind="text: title" class="mark" scope="row">Cart Subtotal</th>
                    <td class="amount">
                        <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Cart Subtotal">$50.00</span>
                    </td>
                </tr>
                <tr class="totals shipping excl">
                    <th class="mark" scope="row">
                        <span class="label" data-bind="text: title">Shipping</span>
                        <span class="value" data-bind="text: getShippingMethodTitle()">Federal Express - Home Delivery</span>
                    </th>
                    <td class="amount">
                        <span class="price" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Shipping">$13.39</span>
                    </td>
                </tr>
                <tr class="totals-tax">
                    <th data-bind="text: title" class="mark" scope="row">Tax</th>
                    <td data-bind="attr: {'data-th': title}" class="amount" data-th="Tax">
                        <span class="price" data-bind="text: getValue()">$4.38</span>
                    </td>
                </tr>
                <tr class="grand totals">
                    <th class="mark" scope="row">
                        <strong data-bind="text: title">Order Total</strong>
                    </th>
                    <td data-bind="attr: {'data-th': title}" class="amount" data-th="Order Total">
                        <strong><span class="price" data-bind="text: getValue()">$67.77</span></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="block items-in-cart" role="tablist">
            <div class="title" data-role="title" role="tab" aria-selected="false" aria-expanded="false" tabindex="0">
                <strong role="heading"><span data-bind="text: getItemsQty()">1</span>
                  <span>Item in Cart</span>
                </strong>
            </div>
            <div class="content minicart-items" data-role="content" role="tabpanel" aria-hidden="true">
                <div class="minicart-items-wrapper overflowed">
                    <ol class="minicart-items">
                        <li class="product-item">
                            <div class="product">
                                <span class="product-image-container" data-bind="attr: {'style': 'height: ' + getHeight($parents[1]) + 'px; width: ' + getWidth($parents[1]) + 'px;' }" style="height: 75px; width: 75px;">
                                <span class="product-image-wrapper">
                                <img data-bind="attr: {'src': getSrc($parents[1]), 'width': getWidth($parents[1]), 'height': getHeight($parents[1]), 'alt': getAlt($parents[1]) }" src="https://www.gauntletgallery.com/pub/media/catalog/product/cache/1/thumbnail/75x75/beff4985b56e3afdbeabfc89641a4582/c/o/courtesy-shuttle-scott-listfield_1.jpg" width="75" height="75" alt="Courtesy Shuttle">
                                </span>
                                </span>
                                <div class="product-item-details">
                                    <div class="product-item-inner">
                                        <div class="product-item-name-block">
                                            <strong class="product-item-name" data-bind="text: $parent.name">Courtesy Shuttle</strong>
                                            <div class="details-qty">
                                                <span class="label">Qty:</span>
                                                <span class="value" data-bind="text: $parent.qty">1</span>
                                            </div>
                                        </div>
                                        <div class="subtotal">
                                            <span class="price-excluding-tax" data-bind="attr:{'data-label': $t('Excl. Tax')}" data-label="Excl. Tax">
                                            <span class="cart-price"><span class="price" data-bind="text: getFormattedPrice(getRowDisplayPriceExclTax($parents[2]))">$50.00</span></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product options active" data-bind="mageInit: {'collapsible':{'openedState': 'active'}}" data-collapsible="true" role="tablist">
                                        <span data-role="title" class="toggle" role="tab" aria-selected="true" aria-expanded="true" tabindex="0"></span>
                                        <div data-role="content" class="content" role="tabpanel" aria-hidden="false" style="display: block;">
                                            <strong class="subtitle"></strong>
                                            <dl class="item-options">
                                                <dt class="label" data-bind="text: label">Material</dt>
                                                <dd class="values" data-bind="html: value">Cotton Rag Fine Art Print</dd>
                                                <dt class="label" data-bind="text: label">Size</dt>
                                                <dd class="values" data-bind="html: value">12X14</dd>
                                                <dt class="label" data-bind="text: label">Framing</dt>
                                                <dd class="values" data-bind="html: value">None</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
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
                Seckin Sahin<br>
                170 King St,Apt #1109<br>
                San Francisco California 94107<br>
                United States<br>
                4156919774<br>
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