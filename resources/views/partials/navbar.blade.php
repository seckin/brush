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
            @if (Auth::check())
            <a href="/checkout/cart" class="js-ajax-cart-link header-button header-button--cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="">
                  <span class="hide-tablet">Cart</span>
                  <span class="header__amount js-header__amount is-hidden">(0)</span>
                </span>
            </a>
            <script>updateCart();</script>
            @endif
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