@extends('layouts.main')

@section('content')
<body id="register">
    
    @include('partials.navbar')
    
    <!--<header class="blank"></header>-->
    <section class="darker">
        <div class="container">
            <div class="sign">
                <h1>Join Brush!</h1>
                <form role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name" />
                    @if ($errors->has('name'))
                    <p class="error">{{ $errors->first('name') }}</p>
                    @endif

                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                    @if ($errors->has('email'))
                    <p class="error">{{ $errors->first('email') }}</p>
                    @endif

                    <input id="password" type="password" name="password" placeholder="Create password" />
                    @if ($errors->has('password'))
                    <p class="error">{{ $errors->first('password') }}</p>
                    @endif

                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" />
                    @if ($errors->has('password_confirmation'))
                    <p class="error">{{ $errors->first('password_confirmation') }}</p>
                    @endif

                    <button type="submit">
                        <i class="fa fa-btn fa-user"></i> Register
                    </button>

                </form>
            </div>
        </div>
    </section>
    
    @include('partials.footer')
    
</body>
@endsection
