@extends('layouts.main')

@section('content')

<body id="checkout" class="payment subpage">
    <script>
        var stripe = Stripe('pk_live_rT8HEb47PxJvbZHme4C14NT6');
        var elements = stripe.elements();
    </script>
    
    @include('partials.navbar')

    <!-- <header class="blank"></header> -->
    <section class="darker" id="checkout-payment">
        <div class="container">
            <div class="process">
                <div class="segment panel panel-default">
                    <div class="panel-body">
                        <form action="/charge" method="post" id="payment-form">
                          <h3>Card Information</h3>
                          <div class="form-row">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors -->
                            <div id="card-errors"></div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                          </div>
                          <button class="action">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('partials.order-summary')
        </div>
    </section>
        
        
    <script>
        $(".items-in-cart").click(function() {
            $(".items-in-cart").toggleClass("active");
        });
    </script>

    <script>
        // Custom styling can be passed to options when creating an Element.
        var style = {
          base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            lineHeight: '24px'
          }
        };

        // Create an instance of the card Element
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });


        // Create a token or display an error the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();

          stripe.createToken(card).then(function(result) {
            if (result.error) {
              // Inform the user if there was an error
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server
              stripeTokenHandler(result.token);
            }
          });
        });

        function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);

          // Submit the form
          form.submit();
        }

    </script>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')
    
</body>
@endsection