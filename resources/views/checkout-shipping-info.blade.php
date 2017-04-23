@extends('layouts.main')

@section('content')

<body id="cart" class="design subpage">
    <!-- <section class="status">
        <div class="container">
            <a href="#">Visit our newest collection: Cityscapes</a>
        </div>
        <a href="#">
            <img src="/assets/images/interface/icon-close.png" />
        </a>
    </section> -->

    @include('partials.navbar')

    <div class="orderid" data-order-id="{{$order->id}}"></div>
    <section id="checkout-shipping-info">
       <ul class="opc-progress-bar">
          <li class="opc-progress-bar-item _active">
             <!-- <span>Shipping</span> -->
          </li>
          <!-- <li class="opc-progress-bar-item" >
             <span >Review &amp; Payments</span>
             </li> -->
       </ul>
       <div class="shipping-wrapper">
          <div id="shipping" class="checkout-shipping-address" >
             <div class="step-title" >Shipping Address</div>
             <div id="checkout-step-shipping" class="step-content" data-role="content">
                <div class="form form-shipping-address" id="co-shipping-form" >
                   <div id="shipping-new-address-form" class="fieldset address">
                      <div class="field required" >
                         <label class="label" >
                         <span>First Name</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="firstname" placeholder="" id="ICKHF97">
                         </div>
                      </div>
                      <div class="field required" >
                         <label class="label" >
                         <span>Last Name</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="lastname" placeholder="" id="MIPKJLI">
                         </div>
                      </div>
                      <!-- <div class="field" >
                         <label class="label" >
                         <span >Company</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="company" placeholder="" id="OR5NGQK">
                         </div>
                      </div> -->
                      <fieldset class="field street required" >
                         <legend class="label">
                            <span>Street Address</span>
                         </legend>
                         <div class="control">
                            <div class="field true" >
                               <label class="label" >
                               </label>
                               <div class="control" >
                                  <input class="input-text" type="text" name="street[0]" placeholder="" id="SMX11RU">
                               </div>
                            </div>
                            <br/>
                            <div class="field additional" >
                               <label class="label" >
                               </label>
                               <div class="control" >
                                  <input class="input-text" style="margin-top: 5px;" type="text" name="street[1]" placeholder="" id="DBUF86Y">
                               </div>
                            </div>
                         </div>
                      </fieldset>
                      <div class="field required" >
                         <label class="label" >
                         <span>City</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="city" placeholder="" id="HYDY07H">
                         </div>
                      </div>
                      
                      <!-- <div class="field" >
                         <label class="label" >
                         <span>State/Province</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="region" placeholder="" id="YA7570H">
                         </div>
                      </div> -->
                      <!-- <div class="field required _error" >
                         <label class="label" >
                         <span >Zip/Postal Code</span>
                         </label>
                         <div class="control" >
                            <input class="input-text" type="text" name="postcode" placeholder="" id="JIBT8CR">
                         </div>
                      </div> -->
                      <div class="field required" >
                         <label class="label" >
                         <span>Country</span>
                         </label>
                         <div class="control" >
                            <select class="select" name="country_id" id="EXS9SFX" placeholder="">
                               <option value=""> </option>
                               <option value="TR">Turkey</option>
                            </select>
                         </div>
                      </div>
                      <div class="field required" >
                         <label class="label" >
                         <span>Phone Number</span>
                         </label>
                         <div class="control _with-tooltip" >
                            <input class="input-text" type="text" name="telephone" placeholder="" id="PU2NNXE">
                            <div class="field-tooltip toggle">
                               <span class="field-tooltip-action action-help" tabindex="0" data-toggle="dropdown" ></span>
                               <div class="field-tooltip-content" data-target="dropdown" aria-hidden="true">
                               </div>
                            </div>
                         </div>
                      </div>
                      <!-- <div class="field choice" >
                         <input type="checkbox" class="checkbox" id="shipping-save-in-address-book" >
                         <label class="label" for="shipping-save-in-address-book">
                         <span >Save in address book</span>
                         </label>
                      </div> -->
                   </div>
                   <div class="actions-toolbar">
                      <div class="primary">
                         <button type="submit" class="button action continue primary">
                            <span>Next</span>
                         </button>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        });
        $(".primary.button").click(function() {
            if($("input[name='firstname']").val().trim() == "") {
              alert("Please enter your first name");
              return;
            }
            if($("input[name='lastname']").val().trim() == "") {
              alert("Please enter your last name");
              return;
            }
            if($("input[name='street[0]']").val().trim() == "") {
              alert("Please enter your street address");
              return;
            }
            if($("input[name='city']").val().trim() == "") {
              alert("Please enter your city");
              return;
            }
            if($("select[name='country_id']").val() == "") {
              alert("Please select your country");
              return;
            }
            if($("input[name='telephone']").val().trim() == "") {
              alert("Please enter your phone number");
              return;
            }

            var email = $(".subscribe #email").val();
            $.ajax({
                url: '/api/v1/shippingInfo',
                type: 'POST',
                data: {
                  order_id: $(".orderid").data("orderId"),
                  firstname: $("input[name='firstname']").val().trim(),
                  lastname: $("input[name='lastname']").val().trim(),
                  address: ($("input[name='street[0]']").val().trim() + ' ' + $("input[name='street[1]']").val().trim()).trim(),
                  city: $("input[name='city']").val().trim(),
                  country: $("select[name='country_id']").val(),
                  phone_number: $("input[name='telephone']").val().trim()
                },
                error: function() {
                },
                success: function(data) {
                    window.location.href='/checkout/payment';
                }
            });
        });
       </script>
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