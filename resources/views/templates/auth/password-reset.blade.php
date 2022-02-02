@extends('layouts.app')
@section('content')
    <div class="login-register-area pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-6">
                    <div class="login-register-wrap login-register-gray-bg">
                        <div class="login-register-title @if(session('message')) text-center @endif">
                            <h1>{{__('Reseto Password')}}</h1>
                            @if(session('message'))
                                <p class="text-success">{{session('message')}}</p>
                            @endif
                        </div>
                        @if(!session('message'))
                            <div class="login-register-form">
                                <form action="{{action('HomeController@resetPassword')}}" method="post">
                                    @csrf
                                    <div class="login-register-input-style input-style input-style-white">
                                        <label>Email address *</label>
                                        <input type="email" required name="email">
                                        @error('email')
                                        <span>{{__('Shkruaj Email')}}</span>
                                        @enderror
                                    </div>
                                    <div class="login-register-btn">
                                        <button type="submit">{{__('Reseto')}}</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
@endsection
