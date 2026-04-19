@extends('layouts.app')

@section('content')
    @include('home._ticker')
    @include('home._navbar')
    @include('home._hero')
    @include('home._marquee')
    @include('home._sticky-car')
    @include('home._marquee', ['reverse' => true])
    @include('home._products-preview')
    @include('home._footer')
@endsection