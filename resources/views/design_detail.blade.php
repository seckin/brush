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

    <header class="display" style="background-image: url({{$design->image}});"></header>
    <div class="design_id" data-design-id="{{$design->id}}"></div>
	<section id="design-detail" class="display" data-tab="design">
	    <div class="container">
            <div class="title">
                <h3>{{$design->name}}</h3>
                <p>by <b><a href="/artists/{{$design->artist->id}}">{{$design->artist->name}}</a></b></p>
            </div>
            <div class="visual">
                <img class="design" src="{{$design->image}}" />
                <img class="canvas" src="{{$design->canvas_image}}" />
                <img class="tshirt" src="{{$design->tshirt_male_image}}" />
                <!-- <img class="mug" style="display: none;" src="/assets/content/sample/artwork/04.png" /> -->
                <div style="display:none;" data-tshirt-male-image="{{$design->tshirt_male_image}}"></div>
                <div style="display:none;" data-tshirt-female-image="{{$design->tshirt_female_image}}"></div>
            </div>
            <div class="tabbing">
                <a class="tab active" data-id="design"></a>
                <a class="tab" data-id="canvas"></a>
                <a class="tab" data-id="tshirt"></a>
                <!-- <a class="tab" data-id="mug"></a> -->
            </div>
            <div class="information">
                <div class="design">
                    <p>{{$design->description}}</p>
                </div>
                <div class="canvas">
                    <p>Design printed on a canvas</p>
                    <div class="progress">
                        <b>{{$canvas_total_sold}} {{$canvas_total_sold == 1 ? "supporter" : "supporters" }}</b>
                        <div style="background-size: {{max (2, 100.0 * $canvas_total_sold / (1.0 * $canvas_limit))}}% 100%;"></div>
                        <b>{{$canvas_limit - $canvas_total_sold}} needed to reach {{$canvas_limit}}</b>
                    </div>
                    <div class="price">
                        <span class="price-text">{{number_format($design->designSizes[0]->price / 100.0, 2, '.', '')}}</span>
                        <i class="fa fa-try" aria-hidden="true"></i>
                        <div class="incl-tax">incl. tax excluding shipping fees</div>
                    </div>
                    <div class="options clearfix">
                        <div class="dropdown-wrapper">
                            <button id="canvasSize" class="dropdown">
                                <a data-value="" href="#">Please select...</a>
                                @foreach ($design->designSizes as $designSize)
                                <a data-value="{{$designSize->size}}" data-price="{{number_format($designSize->price / 100.0, 2, '.', '')}}" href="#">
                                    {{$designSize->size}}
                                    <i class="fa fa-try" aria-hidden="true"></i>
                                </a>
                                @endforeach
                                <input id="canvasSizeInput" type="text" value="" />
                            </button>
                        </div>
                        <button id="canvas-addtocart-button" class="submit action tocart <?php if ($canvas_total_sold == $canvas_limit) { echo 'disabled';} ?>" type="submit" title="Add to Cart">Add to Cart</button>
                        @if ($canvas_total_sold == $canvas_limit)
                            <div style="clear: both;">Canvas sold out :(</div>
                        @endif
                    </div>
                    <p id="canvasinfo"></p>
                    <ul class="extra">
                        <li>Delivery in 3 to 6 working days after the campaign is over.</li>
                        <li>Gallery-quality fine art canvas print.</li>
                        <li>The canvas material is printed and then stretched on a wooden frame. The design covers the edges of the canvas.</li>
                        <li>Material: 340 g/m² cotton (65%) and polyester (35%)</li>
                        <li>Finish: Matt</li>
                        <li>Print Type: 12-colour digital printing</li>
                    </ul>
                </div>
                <div class="tshirt">
                    <p>Design printed on a tshirt</p>
                    <div class="progress">
                        <b>{{$tshirt_total_sold}} {{$tshirt_total_sold == 1 ? "supporter" : "supporters" }}</b>
                        <div style="background-size: {{max (2, 100.0 * $tshirt_total_sold / (1.0 * $tshirt_limit))}}% 100%;"></div>
                        <b>{{$tshirt_limit - $tshirt_total_sold}} needed to reach {{$tshirt_limit}}</b>
                    </div>
                    <div class="price">
                        <span class="price-text">{{number_format($design->tshirt_price / 100.0, 2, '.', '')}}</span>
                        <i class="fa fa-try" aria-hidden="true"></i>
                        <div class="incl-tax">incl. tax excluding shipping fees</div>
                    </div>
                    <div class="options clearfix">
                        <div class="dropdown-wrapper">
                            <button id="tshirtGender" class="dropdown">
                                <a data-value="" href="#">Please select...</a>
                                <a data-value="Female" href="#">Female</a>
                                <a data-value="Male" href="#">Male</a>
                                <input id="tshirtGenderInput" type="text" value="" />
                            </button>
                        </div>
                        <div class="dropdown-wrapper">
                            <button id="tshirtSize" class="dropdown">
                                <a data-value="" href="#">Please select...</a>
                                <a data-value="S" href="#">Small</a>
                                <a data-value="M" href="#">Medium</a>
                                <a data-value="L" href="#">Large</a>
                                <a data-value="XL" href="#">X-Large</a>
                                <a data-value="XXL" href="#">XX-Large</a>
                                <input id="tshirtSizeInput" type="text" value="" />
                            </button>
                        </div>
                        <button id="tshirt-addtocart-button" class="submit action tocart <?php if ($tshirt_total_sold == $tshirt_limit) { echo 'disabled';} ?>" type="submit" title="Add to Cart">Add to Cart</button>
                        @if ($tshirt_total_sold == $tshirt_limit)
                            <p class="error">T-shirt sold out :(</p>
                        @endif
                    </div>
                    <p id="tshirtinfo"></p>
                    <ul class="extra">
                        <li>Delivery in 3 to 6 working days after the campaign is over.</li>
                        <li>Material: 100% cotton jersey</li>
                        <li>Fit: Regular fit</li>
                        <li>Print Type: Digital-direct printing</li>
                        <li>Care: Machine washable at 30ºC</li>
                    </ul>
                </div>

                <!-- <div class="mug">
                    <h3>Mug</h3>
                    <p>Mug content</p>
                </div> -->
            </div>
	    </div>
	</section>
	<section class="showcase">
	    <div class="container">
	        <h3>You may also like</h3>
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

    @include('partials.service-details')

    @include('partials.notify-me')
    
    @include('partials.footer')
    
    <script>
        function addToCart(size, iscanvas, $button, gender) {
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
                error: function(data) {
                    $('#' + (iscanvas ? "canvas" : "tshirt" ) + 'info').html('<p>' + data.responseJSON.error + '</p>');
                    $button.removeClass("disabled");
                    $button.html("Add to Cart");
                },
                // dataType: 'jsonp',
                success: function(data) {
                    $button.html("Added!");
                    updateCart();
                    setTimeout(function() {
                        $button.removeClass("disabled");
                        $button.html("Add to Cart");
                    }, 1000);
                }
            });
        }
        $("#canvas-addtocart-button").click(function() {
            if($("#canvas-addtocart-button").hasClass("disabled")){
                return;
            }
            if($("#canvasSizeInput").attr("value") == "") {
                alert("Please select a size for your canvas");
                setTimeout(function(){
                    $("#canvasSize").addClass('open');
                }, 100);
                return;
            }
            $("#canvas-addtocart-button").addClass("disabled");

            $("#canvas-addtocart-button").html("Adding...");

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            var iscanvas = 1;
            var size = $("#canvasSizeInput").attr("value");
            var $button = $("#canvas-addtocart-button");
            addToCart(size, iscanvas, $button);
        });
        $("#tshirt-addtocart-button").click(function() {
            if($("#tshirt-addtocart-button").hasClass("disabled")){
                return;
            }
            if($("#tshirtGenderInput").attr("value") == "") {
                alert("Please select a gender for your tshirt");
                setTimeout(function(){
                    $("#tshirtGender").addClass('open');
                }, 100);
                return;
            }
            if($("#tshirtSizeInput").attr("value") == "") {
                alert("Please select a size for your tshirt");
                setTimeout(function(){
                    $("#tshirtSize").addClass('open');
                }, 100);
                return;
            }
            $("#tshirt-addtocart-button").addClass("disabled");
            $("#tshirt-addtocart-button").html("Adding...");

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            var iscanvas = 0;
            var size = $("#tshirtSizeInput").attr("value");
            var gender = $("#tshirtGenderInput").attr("value");
            var $button = $("#tshirt-addtocart-button");
            addToCart(size, iscanvas, $button, gender);
        });
        $("#canvasSizeInput").change(function() {
            var price = $("#canvasSize > a[data-value='" + $("#canvasSizeInput").attr("value") +"']").data("price");
            $(".canvas .price-text").html(price);
        });
        $("#tshirtGender").change(function() {
            var val = $("#tshirtGenderInput").attr("value");
            console.log("val:", val);
            if(val == "Female") {
                $(".visual > .tshirt").attr("src", $("div[data-tshirt-female-image]").data("tshirtFemaleImage"));
            } else {
                $(".visual > .tshirt").attr("src", $("div[data-tshirt-male-image]").data("tshirtMaleImage"));
            }
        });
    </script>
</body>
@endsection