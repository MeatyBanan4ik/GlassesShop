@extends('layouts.layout')
@section('title')
    {{$names[$value]}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$names[$value]}}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>


                    {!! str_replace("\n",'<br>', str_replace("\r\n",'<br>' , \Illuminate\Support\Facades\DB::table('additional')->where('page', $value)->first()->content)) !!}
                </p>
                <br>
            </div>
        </div>
    </div>
@endsection
