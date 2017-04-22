@extends('layouts.main')

@section('content')

<body id="designs" class="design subpage">
    <!-- <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section> -->

    @include('partials.navbar')

    <header class="blank"></header>
    <div class="artist_id" data-artist-id="{{$artist->id}}"></div>
    <section id="artist-profile" data-tab="artists">
    	<img width="250" height="250" style="width:250px !important;" class="highlighted_image" src="{{$artist->highlighted_image}}"/>
    	<img width="250" height="250" style="width:250px !important;" class="profile_image" src="{{$artist->profile_image}}"/>
    	<p>{{$artist->name}}</p>
    	<p>{{$artist->description}}</p>
    </section>

    @include('partials.subscribe-to-list')

</body>
@endsection