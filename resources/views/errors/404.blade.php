@extends('layouts.main')

@section('content')
<body id="error">

    @include('partials.navbar')

    <section class="darker">
        <div class="container">
            <img src="/assets/images/illustrations/error.png"/>
            <h1>Page not found.</h1>
            <p>It may have been removed or have never been here.</p>
            <a class="button" href="/">Go to Homepage</a>
        </div>
    </section>

    @include('partials.subscribe-to-list')
    
    @include('partials.footer')

</body>
@endsection