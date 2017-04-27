<div class="summary">
    
    @if ($checkoutStep == 1)
    <a class="action submit button padded" href="/checkout/shipping" role="button">Continue to Shipping</a>
    @elseif ($checkoutStep == 2)
    <a class="action submit button padded" href="#" role="button">Continue to Payment</a>
    @elseif ($checkoutStep == 3)
<!--    <a class="action submit button" href="#" role="button">Place Order</a>-->
    @endif
    

    <!-- Total -->
    <div class="total">
        <h3>Order Summary</h3>
        <dl>
            <dt>Subtotal</dt>
            <dd><span></span><i class="fa fa-try" aria-hidden="true"></i></dd>
            <small>incl. tax</small>
        </dl>
        <dl>
            <dt>Shipping (MNG)</dt>
            <dd><span></span><i class="fa fa-try" aria-hidden="true"></i></dd>
        </dl>
        <dl>
            <dt>Order Total</dt>
            <dd><span></span><i class="fa fa-try" aria-hidden="true"></i></dd>
        </dl>
    </div>

    <div class="discount-code">
        <input type="text" name="discountcode" placeholder="Discount Code">
        <span class="applied hidden" style="font-size:14px;">Code: <span class="code"></span>. <span class="percentage"></span>% discount applied.</span>
        <a class="button submit-discount" href="#" role="button">Apply Code</a>
    </div>
    
    <!-- Shipping -->
    
    @if ($checkoutStep > 2)
    <div class="shipping">
        <h3 class="toggle">Shipping</h3>
        <div class="content">
            {{$shippingInfo->name}} {{$shippingInfo->last_name}}
            <br/>
            {{$shippingInfo->address}}
            <br/>
            {{$shippingInfo->city}}, {{$shippingInfo->country}}
            <br/>
            {{$shippingInfo->phone_number}}
            <br/>
            <small>Method: MNG - Home Delivery</small>
        </div>
    </div>
    
    @endif
    
    
    <!-- Items -->
    
    @if ($checkoutStep > 1)
    <div class="items">
        @if (count($cartItems) == 1)
        <h3 class="toggle">Cart ({{count($cartItems)}} Item)</h3>
        @else
        <h3 class="toggle">Cart ({{count($cartItems)}} Items)</h3>
        @endif

        <div class="content">
            @foreach ($cartItems as $cartItem)
            <div class="product clearfix">
                @if ($cartItem->productSpec->type == "tshirt")
                <img class="product-image" src="{{$cartItem->design->tshirt_image}}" alt="{{$cartItem->design->name}}">
                @endif
                @if ($cartItem->productSpec->type == "canvas")
                <img class="product-image" src="{{$cartItem->design->canvas_image}}" alt="{{$cartItem->design->name}}">
                @endif
                <span class="product-information">
                    <h3 class="product-name">{{$cartItem->design->name}}</h3>
                    <!--
                    <p class="product-type">{{$cartItem->productSpec->type}}</p>
                    -->
                    <dl>
                        @if ($cartItem->productSpec->type == "tshirt")
                        <dt>Gender</dt>
                        <dd>{{$cartItem->productSpec->gender}}</dd>
                        @endif
                        @if ($cartItem->productSpec->type == "canvas")
                        <dt>Type</dt>
                        <dd>Canvas</dd>
                        @endif
                    </dl>
                    <dl>
                        <dt>Size</dt>
                        <dd>{{$cartItem->productSpec->size}}</dd>
                    </dl>
                    <dl>
                        <dt>Quantity</dt>
                        <dd>{{$cartItem->quantity}}</dd>
                    </dl>
                    <dl>
                        <dt>Price</dt>
                        <dd>{{number_format(($cartItem->quantity * $cartItem->price_per_item)/100.0, 2, '.', '')}}<i class="fa fa-try" aria-hidden="true"></i></dd>
                    </dl>
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>


<script>
$(document).ready(function() {
    $('h3.toggle').click(function() {
        $(this).toggleClass('open');
    });
});

$(".discount-code .submit-discount").click(function() {
    $.ajax({
        url: '/api/v1/applyCode',
        type: 'POST',
        data: {
            code: $(".discount-code input[name='discountcode']").val()
        },
        error: function() {
        },
        success: function(data) {
            updateOrderSummary();
        }
    });
});
</script>