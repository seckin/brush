<nav>
    <div class="navigation container">
        <a class="identity" href="/">
            <img src="/assets/images/identity/brush-logo.svg">
        </a>
        <div class="menu">
            <a class="home link" href="/">HOME</a>
            <a class="artists link" href="/artists">ARTISTS</a>
            <a class="designs link" href="/designs">DESIGNS</a>
            <!-- <a class="about link" href="/about">ABOUT</a>
            <a class="contact link" href="mailto:team@trybrush.com">CONTACT</a>
            -->
            <?php if(!Auth::guest()) { ?>
            <a class="account link" href="javascript: void(0)">ACCOUNT</a>
            <div class="accountdetails">
                <a class="button" href="/my-account">My Account</a>
                <a class="button" href="/logout">Logout</a>
            </div>
            <?php } else { ?>
            <a class="login link" href="/login">LOGIN</a>
            <a class="register link" href="/register">REGISTER</a>
            <?php }?>
            <a class="checkout link" href="#" class="js-ajax-cart-link header-button header-button--cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="">
                  <span class="hide-tablet">CART</span>
                  <span class="header__amount js-header__amount is-hidden"></span>
                </span>
            </a>
            <script>updateCart();</script>
            <div class="cartdetails">
                <a class="action button padded" href="/checkout/cart">Go to Checkout</a>
            </div>
            <div class="logindata" data-is-logged-in="<?php echo Auth::check() ? 1 : 0;?>"></div>
        </div>
        <a class="switch" href="#">
            <img class="menu-icon" src="/assets/images/interface/icon-menu.png">
            <img class="close-icon" src="/assets/images/interface/icon-close.png">
        </a>
    </div>
</nav>