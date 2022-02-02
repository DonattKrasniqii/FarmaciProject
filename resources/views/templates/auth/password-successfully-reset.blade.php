@extends('layouts.app')
@section('content')
    <div class="login-register-area pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-6">
                    <div class="login-register-wrap login-register-gray-bg">
                        <div class="login-register-title text-center">
                            <h1>{{__('Sukses !')}}</h1>
                            <p class="text-success">{{__('Password është ndryshuar me sukses !')}}</p>
                            <div class="login-register-btn pw-reset">
                                <a  href="{{action('HomeController@auth')}}">{{__('Kyçu')}}</a>
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
