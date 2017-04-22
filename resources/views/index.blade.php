@extends('layouts.main')

@section('content')
<body id="home">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/styles/home.css') }}">
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

    <header>
    <div class="container">
        <h1>Design Prints for Earlybirds</h1>
        <p>Are you looking for a special design to hang on your wall? Brush helps you collect unique designs by making many great illustrations available for a limited number of people.</p>
        <a class="button" role="button">SEE ALL DESIGNS</a>
    </div>
	</header>
	<section class="featured">
	    <div class="container">
	        <h3>Featured Artists</h3>
	        <div class="quadruple stack">
	        	@foreach($artists as $artist)
	            <div class="item">
	                <img src="{{$artist->profile_image}}" />
	                <p>{{$artist->name}}</p>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>
	<section class="showcase">
	    <div class="container">
	        <h3>Popular Artworks</h3>
	        <div class="cards">
	        	@foreach($designs as $design)
	            <div class="card item">
	                <a href="/designs/{{$design->id}}">
	                    <img src="{{$design->image}}" />
	                    <p>{{$design->name}}</p>
	                </a>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>

	<div class="footer__customer-service text-center">
	    <h4 class="h1 footer--headline footer--headline-help">Need help?</h4>
	    <a class="footer__phone" href="tel:00493092033121" rel="nofollow">
	    <i class="i-phone footer__phone-icon"></i>+90 542 336 89 06
	    </a>
	    <a class="footer__email" href="mailto:service@juniqe.com" rel="nofollow">
	    <i class="i-mail footer__email-icon"></i>team@trybrush.com
	    </a>
	</div>

	<div class="footer__signs">
	    <div class="footer__payment text-center">
	        <h4 class="footer--headline h4">Secure Payment</h4>
	        <div class="footer__payment__icons">
	            <span class="footer__payment__icon sprite-icon sprite-visa"></span>
	            <span class="footer__payment__icon sprite-icon sprite-mastercard"></span>
	            <span class="footer__payment__icon sprite-icon sprite-paypal"></span>
	            <span class="footer__payment__icon sprite-icon sprite-vorkasse-en"></span>
	        </div>
	    </div>
	    <div class="footer__shipping text-center">
	        <h4 class="footer--headline h4">Fast Delivery</h4>
	        <div class="text-center">
	            <!-- <span class="logistics-icon sprite-icon sprite-dhl"></span> -->
	            <span class="logistics-icon sprite-icon sprite-ups"></span>
	            <!-- <span class="logistics-icon sprite-icon sprite-gls"></span> -->
	            <span class="show-tablet footer__shipping-links">
	            <!-- <a href="/faq#shipping">More information</a> -->
	            </span>
	        </div>
	    </div>
	    <div class="footer__shop-securely">
	        <div class="row">
	            <div class="col-xs-12">
	                <h4 class="footer--headline h4 text-center">Shop Securely</h4>
	            </div>
	            <div class="col-xs-12 col-md-3 footer__trusted-icons">
	                <div class="footer__safety-icons">
	                    <a href="#" class="sprite-icon sprite-ssl"></a>
	                </div>
	            </div>
	            <div class="col-xs-12 col-md-9 footer__safety-purchase">
	                <ul class="footer__trusted-list">
	                    <li class="footer__trusted-point">Free 100-day returns</li>
	                    <li class="footer__trusted-point">Secure with SSL encryption</li>
	                    <li class="footer__trusted-point">Buyer and data protection</li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</div>

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