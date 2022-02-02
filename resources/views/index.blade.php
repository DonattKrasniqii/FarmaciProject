@extends('layouts.app')
@section('ogImage')
    <meta property="og:title" content="{{getenv('APP_NAME')}}"/>
    <meta property="og:site_name" content="{{getenv('APP_NAME')}}"/>
    <meta property="og:url" content="{{getenv('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset('assets/images/logo/logofb.png')}}"/>
    <meta property="og:description" content="Barnatore Online"/>
@endsection
@section('content')
    @include('partials.index-partial')
    @include('partials.header-contact')
@endsection
