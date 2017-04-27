$(document).ready(function() {
    /* GENERIC FUNCTIONS */
    //Display Active Menu Item
    var main = $('body').attr('id');
    $('.menu > a').removeClass('active');
    $('.menu > a.' + main).addClass('active');
    //Manage Viewport Height
    var viewportHeight;
    viewportHeight = $(window).height();
    $('body').css('min-height', viewportHeight + 'px');
    //Prevent Scroll to Top
    $('a[href="#"]').click(function(e){
        e.preventDefault();
    });
    //Open Cart Preview
    $('.menu > a.checkout').on('click', function(e) {
        e.stopPropagation();
        $('.cartdetails').toggleClass('open');

        // close accountdetails if it is open
        $('.accountdetails').removeClass('open');
    });
    //Open Account
    $('.menu > a.account').on('click', function(e) {
        e.stopPropagation();
        $('.accountdetails').toggleClass('open');

        // close cartdetails if it is open
        $('.cartdetails').removeClass('open');
    });
    //Close Status Bar on Request
    $('section.status > a').click(function(){
        $('section.status').remove();
    });
    //Close Modal Box on Request
    $('section.modal .reject').click(function(){
        $('section.modal').remove();
    });
    //Activate Navigation Bar Shadow on Scroll
    if($(window).scrollTop() <= 0) {
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, 0), 0 1px 3px rgba(0, 0, 0, 0)');
    } else if ($(window).scrollTop() > 0 && $(window).scrollTop() <= 100) {
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, ' + $(window).scrollTop() / 1000 + '), 0 1px 3px rgba(0, 0, 0, ' + $(window).scrollTop() / 500 + ')');
    } else {
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, .1), 0 1px 3px rgba(0, 0, 0, .2)');
    }
    /* MODULES */
    //Dropdown Selector
    $('.dropdown a').on('click', function(e) {
        var dropdown = $(this).parent('.dropdown');
        if(dropdown.hasClass('open')) {
            if($(this).data('value') != 0) {
                dropdown.children('a[data-value=""]').remove();
                $(this).prependTo(dropdown);
                var value = $(this).data('value');
                dropdown.children('input').attr('value', value);
                $(dropdown.children('input')).change();
                dropdown.removeClass('open');
            } else {
                dropdown.removeClass('open');
            }
        } else {
            dropdown.addClass('open');
        }
    });
    //Close popovers when clicked on somewhere else in the page
    $(document).on('click', function(e) {
        if(!$(e.target).parents(".cartdetails.open").length) {
            $(".open.cartdetails").removeClass("open");
        }

        if(!$(e.target).parents(".accountdetails.open").length) {
            $(".open.accountdetails").removeClass("open");
        }

        if(!$(e.target).parent('.dropdown').length) {
            $('.dropdown.open').removeClass('open');
        } else if ($(e.target).parent('.dropdown').length) {
            // clicked inside a dropdown, but there are other dropdowns we need to close
            var $dropdowns = $(".dropdown");
            for(var i=0; i < $dropdowns.length; i++) {
                if($dropdowns.eq(i)[0] != $(e.target).parent('.dropdown')[0]) {
                    $dropdowns.eq(i).removeClass('open');
                }
            }
        }
    });
    /* OTHER FUNCTIONS */
    //Navigate Design Detail Module with Tabs
    $('#design-detail .tabbing a').click(function(){
        $('#design-detail .tabbing a').removeClass('active');
        var tab = $(this).data('id');
        $('#design-detail').attr('data-tab', tab);
        $(this).addClass('active');
    });
});

$(window).resize(function() {
    //Manage Viewport Height
    var viewportHeight;
    viewportHeight = $(window).height();
    $('body').css('min-height', viewportHeight + 'px');
    $('section.modal').css('height', viewportHeight + 'px');
});

$(window).scroll(function() {
    //Activate Navigation Bar Shadow on Scroll
    if($(window).scrollTop() <= 0){
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, 0), 0 1px 3px rgba(0, 0, 0, 0)');
    } else if ($(window).scrollTop() > 0 && $(window).scrollTop() <= 100) {
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, ' + $(window).scrollTop() / 1000 + '), 0 1px 3px rgba(0, 0, 0, ' + $(window).scrollTop() / 500 + ')');
    } else {
        $('nav').css('box-shadow', '0 1px 5px rgba(0, 0, 0, .1), 0 1px 3px rgba(0, 0, 0, .2)');
    }
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $(".subscribe .button").click(function() {
        var email = $(".subscribe #email").val();
        $.ajax({
            url: '/api/v1/emails',
            type: 'POST',
            data: {
              email: email
            },
            error: function() {
              $('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
                //$(".subscribe .email-saved").css({"display": "block"});
                $(".subscribe .button").text('Joining');
                setTimeout(function(){
                    $(".subscribe .button").text('Joined!');
                }, 1000);
                setTimeout(function(){
                    $(".subscribe #email").val('');
                    $(".subscribe .button").text('Join');
                }, 5000);
            }
        });
    });
});

function updateCart() {
    $.ajax({
        url: '/api/v1/cartInfo',
        type: 'GET',
        data: {
        },
        error: function() {
        },
        success: function(data) {
            if(data.cartItems.length) {
                $(".header__amount").removeClass("is-hidden");
                $(".header__amount").text("(" + data.cartItems.length + ")");
            } else {
                $(".header__amount").addClass("is-hidden");
                // $(".header__amount").text("(" + data.cartItems.length + ")");
                $(".cartdetails").prepend('<div><span>No items in cart yet!</span></div>');
            }
            if($(".cartdetails") && data.cartItems.length) {
                $(".cartdetails").children("div").remove();
                console.log("cart details: updating");
                for(var i=data.cartItems.length-1; i>=0; i--) {
                    console.log("cart details inside");
                    $(".cartdetails").prepend('<div><img class="product-image-photo" src="' + data.cartItems[i].design.image + '" alt="design name"><span><b>' + data.cartItems[i].design.name + '</b><span>' + (data.cartItems[i].product_spec.type == 'tshirt' ? 'Tshirt' : 'Canvas') + '</span><span class="cartitem-price">' + (data.cartItems[i].price_per_item / 100.0).toFixed(2) + '<i class="fa fa-try" aria-hidden="true"></i></span><span class="cartitem-quantity">Qty: ' + data.cartItems[i].quantity + '</span> </span></div>');
                }
            }
        }
    });
}

function updateOrderSummary() {
    $.ajax({
        url: '/api/v1/orderSummary',
        type: 'GET',
        data: {
        },
        error: function() {
        },
        success: function(data) {
            $(".total dd > span").eq(0).html((data.items_price / 100.0).toFixed(2));
            $(".total dd > span").eq(1).html((data.shipping_cost / 100.0).toFixed(2));
            $(".total dd > span").eq(2).html((data.total_amount / 100.0).toFixed(2));

            $(".discount-code input[name='discountcode']").val('');
            if (data.discount) {
                $(".discount-code .applied .code").html(data.discount.code);
                $(".discount-code .applied .percentage").html(data.discount.percentage);
                $(".discount-code .applied").removeClass("hidden");
            }
        }
    });
}