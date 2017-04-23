@extends('layouts.main')

@section('content')
<body id="error">

    @include('partials.navbar')

    <section class="darker">
        <div class="container">
            <h1>Page not found.</h1>
            <p>Sorry for the inconvenience. Click to go <a href="/">Home</a>.</p>
            <img src="/assets/images/illustrations/error.png"/>
        </div>
    </section>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')

</body>
@endsection