@extends('layouts.main')

@section('content')
<body id="artists">
    
    @include('partials.navbar')

	<section class="featured">
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