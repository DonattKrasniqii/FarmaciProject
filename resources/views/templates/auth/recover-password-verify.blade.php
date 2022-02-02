@extends('layouts.app')
@section('content')
    <div class="login-register-area pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-6">
                    <div class="login-register-wrap login-register-gray-bg">
                        <div class="login-register-title">
                            <h1>{{__('Reseto Password')}}</h1>
                            <div class="login-register-btn">
                                <a href="{{getenv('APP_IP')}}/reset-password/{{$token}}">{{__('Kliko Këtu')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
@endsection
