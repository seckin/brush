@extends('layouts.main')

@section('content')
<body id="home">
<!--     <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section>
 -->

     @if (session('status'))
        <div class="alert alert-success">
            <section class="status">
                <div class="container">
                    <span>{{ session('status') }}</span>
                </div>
                <span class="alert-close-icon">
                    <img src="/assets/images/interface/icon-close.png" />
                </span>
            </section>
        </div>
    @endif

    @include('partials.navbar')

    <header>
    <div class="container">
        <h1>Prints and T-shirts for Early Birds</h1>
        <p>Are you looking for a special design to hang on your wall? Brush helps you find great designs by letting designers run limited edition campaigns.</p>
        <a href="/designs" class="button" role="button">SEE ALL DESIGNS</a>
    </div>
	</header>
	<section class="featured">
	    <div class="container">
	        <h3>Featured Artists</h3>
	        <div class="quadruple stack">
	        	@foreach($artists as $artist)
	            <a class="item" href="/artists/{{$artist->id}}">
	                <img src="{{$artist->profile_image}}" />
	                <p>{{$artist->name}}</p>
	            </a>
	            @endforeach
	        </div>
	    </div>
	</section>
	<section class="showcase">
	    <div class="container">
	        <h3>Popular Designs</h3>
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

    <script>
        $(".alert-close-icon").click(function() {
            $(".alert").remove();
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