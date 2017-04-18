<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta property="og:title" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:site_name" content="" />
    <meta name="_token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="icon" type="image/png" href="/assets/images/identity/icon.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/styles/reset.css') }}">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="{{ asset('assets/styles/generic.css') }}">
    <link type="text/css" rel="stylesheet" charset="utf-8" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/assets/scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/assets/scripts/generic.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    
</head>

@yield('content')

</html>