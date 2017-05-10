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

    <header class="display" style="background-image: url({{$artist->highlighted_image}});"></header>
    <div class="artist_id" data-artist-id="{{$artist->id}}"></div>
	<section id="artist-profile" class="display" data-tab="about">
	    <div class="container">
            <div class="title">
                <h3>{{$artist->name}}</h3>
                <p><b>{{$artist->location}}</b></p>
            </div>
            <div class="visual">
                <img class="about" src="{{$artist->profile_image}}" />
            </div>
            <div class="tabbing">
                <a class="tab active" data-id="about"></a>
            </div>
            <div class="information">
                <div class="about">
                    <p>{{$artist->description}}</p>
                </div>
            </div>
	    </div>
	</section>
    @if (count($designs))
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
    @endif

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')

</body>
@endsection