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
                        <h3>Description</h3>
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
                        <button id="canvasSize" class="item dropdown">
                            <a data-number="0" href="#">Please select...</a>
                            <a data-number="1" href="#">25cm x 17.5cm</a>
                            <a data-number="2" href="#">50cm x 35cmm</a>
                            <a data-number="3" href="#">100cm x 70cm</a>
                            <input id="canvasSizeInput" type="number" value="0" />
                        </button>
                    </div>
                    <div class="tshirt">
                        <h3>Tshirt</h3>
                        <p>Design printed on a tshirt</p>
                        <button id="tshirtGender" class="item dropdown">
                            <a data-number="0" href="#">Please select...</a>
                            <a data-number="1" href="#">Unisex</a>
                            <a data-number="2" href="#">Female</a>
                            <a data-number="3" href="#">Male</a>
                            <input id="tshirtGenderInput" type="number" value="0" />
                        </button>
                        <button id="tshirtSize" class="item dropdown">
                            <a data-number="0" href="#">Please select...</a>
                            <a data-number="1" href="#">Small</a>
                            <a data-number="2" href="#">Medium</a>
                            <a data-number="3" href="#">Large</a>
                            <a data-number="3" href="#">X-Large</a>
                            <input id="tshirtSizeInput" type="number" value="0" />
                        </button>
                    </div>
                    <div class="mug">
                        <h3>Mug</h3>
                        <p>Mug content</p>
                    </div>
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
</body>
@endsection