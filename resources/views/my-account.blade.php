@extends('layouts.main')

@section('content')
<body id="my-account">
<!--     <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section>
 -->
    @include('partials.navbar')

	<section class="featured">
	    <div class="container">
	        <h3>Your Orders</h3>
	        <div class="row">
	        	@foreach($orders as $order)
    	            <div class="cart-item-names">
                        <?php
                            $details = array();
                            foreach($order->cartItems as $cartItem) {
                                if($cartItem->productSpec->type == "tshirt") {
                                    $name = $cartItem->design->name;
                                    $type = "T-shirt";
                                    $gender = $cartItem->productSpec->gender;
                                    $size = "Size: " . $cartItem->productSpec->size;
                                    $detail = $name . ", " . $type . ", " . $gender . ", " . $size;
                                } else if($cartItem->productSpec->type == "canvas") {
                                    $name = $cartItem->design->name;
                                    $type = "Canvas";
                                    $size = $cartItem->productSpec->size;
                                    $detail = $name . ", " . $type . ", " . $size;
                                }
                                array_push($details, $detail);
                            }
                            $details_str = join("<br>", $details);
                            echo $details_str;
                        ?>
    	            </div>
                    <div class="order-date">
                        <?php
                            echo array_shift($dates);
                        ?>
                    </div>
                    <div class="order-status">
                        Your order is being prepared.
                    </div>
	            @endforeach
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