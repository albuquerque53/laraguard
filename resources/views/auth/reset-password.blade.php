@extends('auth.master.master')

@section('title', 'Login')

@section('content')

<div class="main">

    <p class="sign" align="center">Type your new password</p>
    <form class="form1" action="{{ route('password.reset') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input 
            class="pass" name="password"
            type="password" align="center"
            required
            placeholder="New password">
        <input 
            class="pass" name="password_confirmation"
            required
            type="password" align="center"
            placeholder="Confirm password">

        <button class="submit" align="center">
            Reset password
            <i class="fas fa-key"></i>
        </button>
    </form>

</div>

@endsection
