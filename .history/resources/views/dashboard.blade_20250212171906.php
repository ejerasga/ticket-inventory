@extends('layout.header')

@section('content')




    <h1>Welcome to the Dashboard!</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>



@endsection
