@extends('layouts.layout')
@section('content')
    <form action="{{ route('register') }}" method="post" class="mt-5">
        @csrf
        <input type="text" placeholder="email" name="email">
        <input type="text" placeholder="name" name="name">
        <input type="text" placeholder="password" name="password">
        <button>Reg</button>
    </form>
@endsection
