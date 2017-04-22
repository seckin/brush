@extends('layouts.main')

@section('content')
<body id="home">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/styles/home.css') }}">

    @include('partials.navbar')

    <header></header>

    <div class="container">
        <img style="margin: 40px 0px;" src="/assets/images/interface/search_no_results_en.png"/>
    </div>

    @include('partials.subscribe-to-list')

</body>