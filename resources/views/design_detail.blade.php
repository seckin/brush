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
    <div class="logindata" data-is-logged-in="<?php echo Auth::check() ? 'true' : 'false';?>"></div>
    <div class="design_id" data-design-id="{{$design->id}}"></div>
	<section id="design-detail" data-tab="design">
	    <div class="container">
            <div class="information">
                <div class="head">
                    <h3>{{$design->name}}</h3>
                    <p>by <b><a href="#">{{$design->artist->name}}</a></b></p>
                    <div class="tabbing">
                        <a class="tab active" data-id="design"></a>
                        <a class="tab" data-id="canvas"></a>
                        <a class="tab" data-id="tshirt"></a>
                        <!-- <a class="tab" data-id="mug"></a> -->
                    </div>
                </div>
                <div class="body">
                    <div class="design">
                        <!-- <h3>Description</h3> -->
                        <p>{{$design->description}}</p>
                        <!-- <h3>Tags</h3>
                        <p class="tags">
                            <a href="#">Frida</a>
                            <a href="#">Frida</a>
                            <a href="#">Frida</a>
                            <a href="#">Frida</a>
                            <a href="#">Frida</a>
                        </p> -->
                    </div>
                    <div class="canvas">
                        <h3>Canvas</h3>
                        <p>Design printed on a canvas</p>
                        <div class="progress" style="background-size: 50% 100%;">
                            <h4>95 needed to reach 200</h4>
                        </div>
                        <div class="options clearfix">
                            <button id="canvasSize" class="dropdown">
                                <a data-number="0" href="#">Please select...</a>
                                <a data-number="1" href="#">25cm x 17.5cm</a>
                                <a data-number="2" href="#">50cm x 35cmm</a>
                                <a data-number="3" href="#">100cm x 70cm</a>
                                <input id="canvasSizeInput" type="number" value="0" />
                            </button>
                        </div>
                        <button id="canvas-addtocart-button" class="submit" type="submit" title="Add to Cart" class="action tocart">Add to Cart</button>
                        <p id="canvasinfo"></p>
                    </div>
                    <div class="tshirt">
                        <h3>Tshirt</h3>
                        <p>Design printed on a tshirt</p>
                        <div class="progress" style="background-size: 50% 100%;">
                            <h4>95 needed to reach 200</h4>
                        </div>
                        <div class="options clearfix">
                            <button id="tshirtGender" class="dropdown">
                                <a data-number="0" href="#">Please select...</a>
                                <a data-number="1" href="#">Unisex</a>
                                <a data-number="2" href="#">Female</a>
                                <a data-number="3" href="#">Male</a>
                                <input id="tshirtGenderInput" type="number" value="0" />
                            </button>
                            <button id="tshirtSize" class="dropdown">
                                <a data-number="0" href="#">Please select...</a>
                                <a data-number="1" href="#">Small</a>
                                <a data-number="2" href="#">Medium</a>
                                <a data-number="3" href="#">Large</a>
                                <a data-number="3" href="#">X-Large</a>
                                <input id="tshirtSizeInput" type="number" value="0" />
                            </button>
                            <button id="tshirt-addtocart-button" class="submit" type="submit" title="Add to Cart" class="action tocart">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="mug">
                        <h3>Mug</h3>
                        <p>Mug content</p>
                    </div> -->
                </div>
            </div>
            <div class="display">
                <img class="design" src="{{$design->image}}" />
                <img class="canvas" src="{{$design->canvas_image}}" />
                <img class="tshirt" src="{{$design->tshirt_image}}" />
                <!-- <img class="mug" src="/assets/content/sample/artwork/04.png" /> -->
            </div>
	    </div>
	</section>
	<section class="showcase">
	    <div class="container">
	        <h3>Similar Designs</h3>
	        <div class="cards">
	            @foreach($similar_designs as $design)
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
    <script>
        function addToCart(size, iscanvas, $button, gender) {
            if($(".logindata").data("isLoggedIn") == false) {
                window.location.href="/login";
            }
            var designId = $(".design_id").data("designId");
            $.ajax({
                url: '/api/v1/addToCart',
                type: 'POST',
                data: {
                  type: iscanvas ? "canvas" : "tshirt",
                  size: size,
                  designId: designId,
                  gender: gender
                },
                error: function() {
                  $('#' + (iscanvas ? "canvas" : "tshirt" ) + 'info').html('<p>An error has occurred</p>');
                },
                // dataType: 'jsonp',
                success: function(data) {
                    $button.children("span").val("Added");
                    updateCart();
                    setTimeout(function() {
                        $button.children("span").val("Add to Cart");
                    }, 2000);
                }
            });
        }
        $("#canvas-addtocart-button").click(function() {
            if($("#canvas-addtocart-button").hasClass("disabled")){
                return;
            }
            $("#canvas-addtocart-button").addClass("disabled");
            console.log("canvas clicked");
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            var iscanvas = 1;
            var size = "70X50";
            var $button = $("#canvas-addtocart-button");
            addToCart(size, iscanvas, $button);
        });
        $("#tshirt-addtocart-button").click(function() {
            if($("#tshirt-addtocart-button").hasClass("disabled")){
                return;
            }
            $("#tshirt-addtocart-button").addClass("disabled");
            console.log("canvas clicked");
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            var iscanvas = 0;
            var size = "M";
            var gender = "Male";
            var $button = $("#tshirt-addtocart-button");
            addToCart(size, iscanvas, $button, gender);
        });
    </script>
</body>
@endsection