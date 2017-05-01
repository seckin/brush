@extends('layouts.main')

@section('content')
<body id="error">

    @include('partials.navbar')

    <section class="darker">
        <div class="container">
            <img src="/assets/images/illustrations/error.png"/>
            <h1>Be right back.</h1>
            <p>We're having difficulties. Working on it.</p>
            <a class="button" onclick="window.location.reload()" href="#">Refresh</a>
        </div>
    </section>

    @include('partials.subscribe-to-list')

    @include('partials.footer')

</body>
@endsection