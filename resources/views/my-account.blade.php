@extends('layouts.main')

@section('content')
<body id="my-account">
    @include('partials.navbar')

	<section class="featured">
	    <div class="container">
	        <h3>Your Orders</h3>
	        <div class="row">
            @if (count($orders) > 0)
            <table border="0" cellpadding="0" cellspacing="0" class="AnaTablo" align="center">
                <tbody>
                    <tr><td valign="top" class="IcerikOrtaTabloIcerikTd"> 
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" class="UrunListeGosterimTablo">
                    <form action="" method="POST" name="siparis_izleme"></form> 
                    <tbody>
                    <tr class="UrunListeGosterimTabloBaslikTr"> 
                    <td width="10%">Order ID</td><td width="17%">Date/Time</td>
                    <td width="18%">Payment type</td><td width="17%">Status</td><td width="14%">Shipping Tracking No</td>

                    </tr>

                    @foreach($orders as $order)
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
                            $details_str;
                        ?>
                        <tr class="UrunListeGosterimTabloListeTr1"> 
                        <td>100{{$order->id}}</td>
                        <td>{{array_shift($dates)}}</td>
                        <td>{!! $details_str !!}</td>
                        <td title="Kargoya Teslim Edildi">Your order is being prepared.</td>
                        <td title="Kargonuzun Takibi İçin Tıklayın">200{{$order->id}}</td>

                        </tr>
                    @endforeach
                    </tbody></table></td></tr></tbody>
            </table>
            @else
            <div>
                <p>You haven't ordered anything yet. Checkout cool designs <a href="/designs" style="color: blue;">here.</a></p>
            </div>
            @endif
            </div>
	    </div>
	</section>

	@include('partials.subscribe-to-list')

    @include('partials.footer')
    
</body>
@endsection