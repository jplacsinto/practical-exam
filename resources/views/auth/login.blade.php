@extends('layouts.login')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="logo"><img src="https://portal.suntec.io/images/logo/black-logo.png" class="logo" alt=""></div>
    
    <div class="form-row">
        <!-- <label for="email">Email</label> -->
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-row">
        <!-- <label for="email">Password</label> -->

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-row">
        <input type="submit" name="login" value="SIGN IN">
        <p>Don't have an account yet? <a href="{{ route('register')}}">Sign up</a></p>
    </div>

</form>



@endsection
