@extends('layouts.layout')
@section('content')
    <form action="{{ route('auth') }}" method="post" class="mt-5">
        @csrf
        <input type="text" placeholder="email" name="email">
        <input type="text" placeholder="password" name="password">
        <button>auth</button>
    </form>
@endsection
