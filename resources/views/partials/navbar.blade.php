<nav>
    <div class="navigation container">
        <a class="identity" href="#">
            <img src="/assets/images/identity/logo.png">
        </a>
        <div class="menu">
            <a class="home link" href="/">HOME</a>
            <a class="artists link" href="/artists">ARTISTS</a>
            <a class="designs link" href="/designs">DESIGNS</a>
            <!-- <a class="about link" href="/about">ABOUT</a>
            <a class="contact link" href="mailto:team@trybrush.com">CONTACT</a>
            -->
            @if (Auth::check())
            <a class="cart link" href="#" class="js-ajax-cart-link header-button header-button--cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="">
                  <span class="hide-tablet">CART</span>
                  <span class="header__amount js-header__amount is-hidden">(0)</span>
                </span>
            </a>
            <script>updateCart();</script>
            @endif
            <div class="cartdetails">
                <div>
                    <img class="product-image-photo" src="/assets/content/sample/tshirt/01.png" alt="design name">
                    <span>
                    <b>{{"design name"}}</b>
                        <p>{{"tshirt"}}</p>
                    </span>
                </div>
                <a class="button" href="/checkout/cart">Go to Checkout</a>
            </div>
            <div class="logindata" data-is-logged-in="<?php echo Auth::check() ? 1 : 0;?>"></div>
        </div>
        <a class="switch" href="#">
            <img class="menu-icon" src="/assets/images/interface/icon-menu.png">
            <img class="close-icon" src="/assets/images/interface/icon-close.png">
        </a>
    </div>
</nav>