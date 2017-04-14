@extends('layouts.main')

@section('content')
<body id="home">
    <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section>
    <nav>
        <div class="navigation container">
            <a class="identity" href="#">
                <img src="/assets/images/identity/logo.png">
            </a>
            <div class="menu">
                <a class="home link" href="/">HOME</a>
                <a class="artists link" href="/artists">ARTISTS</a>
                <a class="designs link" href="/designs">DESIGNS</a>
                <a class="about link" href="/about">ABOUT</a>
                <a class="contact link" href="mailto:team@trybrush.com">CONTACT</a>

                <!--
                <div class="submenu">
                    <div class="arrow"> </div>
                    <a href="'.$root.'/'.$user.'/profil">Firma Profili</a>
                    <a href="'.$root.'/'.$user.'/projeler">Yayınlanan Projeler</a>
                    <a href="'.$root.'/'.$user.'/oneriler">Çözüm Önerileri</a>
                    <a href="'.$root.'/'.$user.'/yeni">Yeni Proje</a>
                    <a href="'.$root.'">Çıkış Yap</a>
                </div>
                -->
            </div>
            <a class="switch" href="#">
                <img class="menu-icon" src="/assets/images/interface/icon-menu.png">
                <img class="close-icon" src="/assets/images/interface/icon-close.png">
            </a>
        </div>
    </nav>
    <header>
    <div class="container">
        <h1>Limited Number of Designs by Local Artists</h1>
        <p>Visual art is a human activity in creating visual artworks, expressing the artist's imaginative or technical skill, intended to be appreciated for their beauty or emotional power.</p>
        <a class="button" role="button">BUY ARTWORKS</a>
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
	<section class="action">
	    <div class="container">
	        <div class="circular">
	            <h3>Stay in the loop</h3>
	            <p>Subscribe to our email newsletter</p>
	        </div>
	        <div class="subscribe">
	            <input id="email" type="email" name="email" size="30" placeholder="Enter your email address">
	            <a href="javascript:void(0)" class="button" role="button">JOIN</a>
	            <div class="email-saved" style="display:none;color: white;text-align: center;margin-top: 5px;">Email saved!</div>
	        </div>
	    </div>
	</section>
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