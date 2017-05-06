<nav>
    <div class="navigation container">
        <a class="identity" href="/">
            <img src="/assets/images/identity/brush-logo.svg">
        </a>
        <ul class="menu">
            <li><a class="home link" href="/">HOME</a></li>
            <li><a class="artists link" href="/artists">ARTISTS</a></li>
            <li><a class="designs link" href="/designs">DESIGNS</a></li>
            <!--
            <li><a class="about link" href="/about">ABOUT</a></li>
            <li><a class="contact link" href="mailto:team@trybrush.com">CONTACT</a></li>
            -->
            <?php if(!Auth::guest()) { ?>
            <li>
                <a class="account link my-account" href="javascript: void(0)">ACCOUNT</a>
                <div class="submenu accountdetails">
                    <a href="/my-account">My Account</a>
                    <a href="/logout">Logout</a>
                </div>
            </li>
            <?php } else { ?>
            <li><a class="login link" href="/login">LOGIN</a></li>
            <li><a class="register link" href="/register">REGISTER</a></li>
            <?php }?>
            <li>
                <a class="checkout link" href="#" class="js-ajax-cart-link header-button header-button--cart">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="">
                      <span class="hide-tablet">CART</span>
                      <span class="header__amount js-header__amount is-hidden"></span>
                    </span>
                </a>
                <script>updateCart();</script>
                <div class="submenu cartdetails">
                    <a class="action button padded" href="/checkout/cart">Go to Checkout</a>
                </div>
                <div class="logindata" data-is-logged-in="<?php echo Auth::check() ? 1 : 0;?>"></div>
            </li>
        </ul>
        <a class="switch" href="#">
            <img class="menu-icon" src="/assets/images/interface/icon-menu.png">
            <img class="close-icon" src="/assets/images/interface/icon-close.png">
        </a>
    </div>
</nav>