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
        <h1>Exclusive Prints for Early Birds</h1>
        <p>Are you looking for a special design to hang on your wall?<br/>Brush helps you find great designs by letting designers run limited edition campaigns.</p>
        <a href="/designs" class="button" role="button">SEE ALL DESIGNS</a>
    </div>
	</header>
    <section class="details">
        <div class="container">
            <div class="triple stack cards">
                <div class="item">
                    <img src="/assets/images/icons/icon-supportive.png" />
                    <h3>Support</h3>
                    <p>We help artists to turn their work into a product. You will help them to make their campaign succeed by purchasing it.</p>
                </div>
                <div class="item">
                    <img src="/assets/images/icons/icon-distinguished.png" />
                    <h3>Be an Early Adopter!</h3>
                    <p>Each campaign is limited to a number of products. You will be the only one among your friends who has it!</p>
                </div>
                <div class="item">
                    <img src="/assets/images/icons/icon-affordable.png" />
                    <h3>Pay less</h3>
                    <p>We curate affordable art for you. In the end, you will own rare products for affordable prices.</p>
                </div>
	        </div>
        </div>
    </section>
    <section class="showcase featured">
	    <div class="artists container">
	        <h3>Featured Artists</h3>
	        <div class="quadruple stack">
	        	@foreach($artists as $artist)
	            <a class="card item" href="/artists/{{$artist->id}}">
	                <img src="{{$artist->profile_image}}" />
	                <p>{{$artist->name}}</p>
	            </a>
	            @endforeach
	        </div>
	    </div>
	    <div class="designs container">
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
    
</body>
@endsection