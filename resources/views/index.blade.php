<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta property="og:title" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:site_name" content="" />
    <title></title>
    <link rel="icon" type="image/png" href="/assets/images/identity/icon.png">
    
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/reset.css') }}">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/generic.css') }}">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/scripts/generic.js"></script>
    
</head>

<body id="" class="">
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
                <a class="home link" href="/home">HOME</a>
                <a class="projeler link" href="/artists">ARTISTS</a>
                <a class="nedir link" href="/artworks">ARTWORKS</a>
                <a class="haberler link" href="/about">ABOUT</a>
                <a class="iletisim link" href="/contact">CONTACT</a>
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
    <header class="extended">
    <div class="container">
        <h1>Limited Number of Artworks by Local Artists</h1>
        <p>Visual art is a human activity in creating visual artworks, expressing the artist's imaginative or technical skill, intended to be appreciated for their beauty or emotional power.</p>
        <a class="button" role="button">BUY ARTWORKS</a>
    </div>
	</header>
	<section class="featured">
	    <div class="container">
	        <h3>Featured Artists</h3>
	        <div class="quadruple stack">
	            <div class="item">
	                <img src="https://www.gauntletgallery.com/pub/media/catalog/category/new_images/artist/Johannah-ODonnell-profile.jpg" />
	                <p>Johannah O'Donnell</p>
	            </div>
	            <div class="item">
	                <img src="https://www.gauntletgallery.com/pub/media/catalog/category/new_images/artist/Fab-Ciraolo-profile.jpg" />
	                <p>Fab Ciraolo</p>
	            </div>
	            <div class="item">
	                <img src="https://www.gauntletgallery.com/pub/media/catalog/category/new_images/artist/Ruben-Ireland-profile.jpg" />
	                <p>Ruben Ireland</p>
	            </div>
	            <div class="item">
	                <img src="https://www.gauntletgallery.com/pub/media/catalog/category/new_images/artist/Jenny-Liz-Rome-profile.jpg" />
	                <p>Jenny Liz Rome</p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="showcase">
	    <div class="container">
	        <h3>Popular Artworks</h3>
	        <div class="cards">
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/01.png" />
	                    <p>Cool Artworkname</p>
	                </a>

	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/02.png" />
	                    <p>Cool Artworkname</p>
	                </a>
	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/03.png" />
	                    <p>Cool Artworkname</p>
	                </a>

	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/04.png" />
	                    <p>Cool Artworkname</p>
	                </a>
	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/05.png" />
	                    <p>Cool Artworkname</p>
	                </a>

	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/06.png" />
	                    <p>Cool Artworkname</p>
	                </a>
	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/07.png" />
	                    <p>Cool Artworkname</p>
	                </a>

	            </div>
	            <div class="card item">
	                <a href="/artworks/artwork">
	                    <img src="assets/content/sample/artwork/08.png" />
	                    <p>Cool Artworkname</p>
	                </a>
	            </div>
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
	            <a href="" class="button" role="button">JOIN</a>
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
</html>