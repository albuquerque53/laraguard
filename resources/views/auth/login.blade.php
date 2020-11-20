@extends('auth.master.master')

@section('title', 'Login')

@section('content')

<div class="main">

    <p class="sign" align="center">Sign in</p>
    <form class="form1" action="{{ route('login') }}" method="POST">
        @csrf
        <input class="un " name="email" type="email" align="center" placeholder="E-mail">
        <input class="pass" name="password" type="password" align="center" placeholder="Password">
        <button class="submit" align="center">Sign in</button>
    </form>

</div>

@endsection