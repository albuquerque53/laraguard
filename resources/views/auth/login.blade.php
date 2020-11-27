@extends('auth.master.master')

@section('title', 'Login')

@section('content')

<div class="main">

    <p class="sign" align="center">Sign in</p>
    <form class="form1" action="{{ route('login') }}" method="POST">
        @csrf
        <input class="un " name="email" type="email" align="center" placeholder="E-mail">
        <input class="pass" name="password" type="password" align="center" placeholder="Password">
        <button class="submit" align="center">
            Login
            <i class="fas fa-sign-in-alt"></i>
        </button>
        <a class="google-button" href="{{ route('google.redirect') }}">
            <i class="fab fa-google"></i>
            Login with Google
        </a>
        <a class="github-button" href="{{ route('github.redirect') }}">
            <i class="fab fa-github"></i>
            Login with Github
        </a>
        <a href="{{ route('forgot.password') }}" class="forgo-password">
            Forgot your password?
        </a>
    </form>

</div>

@endsection