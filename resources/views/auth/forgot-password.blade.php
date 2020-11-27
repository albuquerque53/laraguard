@extends('auth.master.master')

@section('title', 'Login')

@section('content')

<div class="main">

    <p class="sign" align="center">Forgot your password?</p>
    <p class="info" align="center">We'll send a password reset link to your e-mail.</p>
    <form class="form1" action="{{ route('reset.send') }}" method="POST">
        @csrf
        <input 
            class="un " name="email"
            type="email" align="center"
            required
            placeholder="Type here your registered e-mail">
        <button class="submit" align="center">
            {{ __('Send Password Reset Link') }}
            <i class="fas fa-envelope"></i>
        </button>
    </form>

</div>

@endsection