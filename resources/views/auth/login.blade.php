@extends('layouts.main')

@section('content')
<body id="login">
    
    @include('partials.navbar')
    
    <!--<header class="blank"></header>-->
    <section class="darker">
        <div class="container">
            <div class="sign">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" />
                    @if ($errors->has('email'))
                    <p class="error">
                        {{ $errors->first('email') }}
                    </p>
                    @endif

                    <input id="password" type="password" name="password" placeholder="Enter your password" />
                    @if ($errors->has('password'))
                    <p class="error">
                        {{ $errors->first('password') }}
                    </p>
                    @endif

                    <div class="options clearfix">
                        <div class="checkbox">
                            <div class="boolean"></div>
                            Remember me
                            <input id="remember" type="checkbox" name="remember" />
                        </div>
                        <a class="link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>

                    <button type="submit">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>

                </form>
            </div>
        </div>
    </section>
    
    @include('partials.footer')
    
    <script>
        $(document).ready(function() {
            $('.checkbox .boolean').click(function() {
                if ($(this).hasClass('true')) {
                    $(this).parent().children('input[type="checkbox"]').removeAttr('checked');
                } else {
                    $(this).parent().children('input[type="checkbox"]').attr('checked', true);
                }
                $(this).toggleClass('true');
            });
        });
    </script>
    
</body>
@endsection