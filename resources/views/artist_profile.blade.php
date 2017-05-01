@extends('layouts.main')

@section('content')

<body id="artists" class="artist subpage">
    <!-- <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section> -->

    @include('partials.navbar')

    <header class="blank" style="background-image: url({{$artist->highlighted_image}});"></header>
    <div class="artist_id" data-artist-id="{{$artist->id}}"></div>
	<section id="artist-profile" class="presentation" data-tab="about">
	    <div class="container">
            <div class="information">
                <div class="head">
                    <h3>{{$artist->name}}</h3>
                    <p><b>Montreal, Canada</b></p>
                    <div class="tabbing">
                        <a class="tab active" data-id="about"></a>
                    </div>
                </div>
                <div class="body">
                    <div class="about">
                        <p>{{$artist->description}}</p>
                    </div>
                </div>
            </div>
            <div class="display">
                <img class="about" src="{{$artist->profile_image}}" />
            </div>
	    </div>
	</section>
    <section class="showcase">
        <div class="container">
            <h3>From the Artist</h3>
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

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')

</body>
@endsection