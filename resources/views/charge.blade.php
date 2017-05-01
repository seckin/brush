@extends('layouts.main')

@section('content')
<body id="password-reset">
    @include('partials.navbar')

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">Charging Your Card</div> -->

                        <div class="panel-body">
                            Successfully charged your card. Thanks for being with us!
                        </div>

                        <p>
                            <p>We sent you an email about your purchase. You can also track your order from the Account tab above.</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.subscribe-to-list')

    @include('partials.footer')

</body>
@endsection
