@extends('layouts.main')

@section('content')
<body id="checkout" class="charge subpage">

    @include('partials.navbar')

    <section class="darker">
        <div class="container">
            <img src="/assets/images/illustrations/success.png"/>
            <h1>Successfully charged!</h1>
            <p>Thanks for being with us! We sent you an email about your purchase.</p>
            <small>You can also track your order from the Account tab above.</small>
            <a class="button" href="/designs">See more designs</a>
        </div>
    </section>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')

</body>
@endsection