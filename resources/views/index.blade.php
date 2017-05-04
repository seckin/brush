@extends('layouts.main')

@section('content')
<body id="home">

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
        <h1>Exclusive Prints for Early-backers</h1>
        <p>Are you looking for a special design to hang on your wall?</p>
        <!--<p>Brush helps you find great designs by letting designers run limited edition campaigns.</p>-->
        <p>You can have one of the limited availability prints by backing these campaigns.</p>
        <a href="/designs" class="button" role="button">SEE ALL CAMPAIGNS</a>
    </div>
	</header>
    <section class="featured">
	    <div class="artists container">
	        <h3>Featured Artists</h3>
	        <div class="sixpack">
	        	@foreach($artists as $artist)
	            <a class="card item" href="/artists/{{$artist->id}}">
	                <img src="{{$artist->profile_image}}" />
	                <p>{{$artist->name}}</p>
	            </a>
	            @endforeach
	        </div>
	    </div>
    </section>
    <section class="showcase">
	    <div class="designs container">
	        <h3>Popular Designs</h3>
	        <div class="cards">
	        	@foreach($designs as $design)
	            <div class="card item">
	                <a href="/designs/{{$design->id}}">
	                    <img src="{{$design->image}}" />
	                    <!--<p>{{$design->name}}</p>-->
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
    
</body>
@endsection