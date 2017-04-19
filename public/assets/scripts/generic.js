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
    $('.dropdown a').click(function() {
        var dropdown = $(this).parent('.dropdown');
        if(dropdown.hasClass('open')) {
            $('a[data-number="0"]').remove();
            $(this).prependTo(dropdown);
            var number = $(this).data('number');
            $(this).parent().children('input').attr('value', number);
            dropdown.removeClass('open');
        } else {
            dropdown.addClass('open');
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
            // dataType: 'jsonp',
            success: function(data) {
                $(".subscribe #email").val('');
                $(".subscribe .email-saved").css({"display": "block"});
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
            $(".header__amount").removeClass("is-hidden");
            window.asd = data;
            $(".header__amount").text("(" + data.count + ")");
        }
    });
}