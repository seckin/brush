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
    
    @include('partials.service-details')
    
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