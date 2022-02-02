@extends('layouts.app')
@section('content')
    <div class="login-register-area pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login-register-wrap login-register-gray-bg">
                        <div class="login-register-title">
                            <h1>{{__('Kyçu')}}</h1>
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{\Illuminate\Support\Facades\Session::get('error')}}
                                </div>
                            @endif
                            @if(session('errorMessage'))
                                <div class="alert alert-danger" role="alert">
                                    {{\Illuminate\Support\Facades\Session::get('errorMessage')}}
                                </div>
                                @endif

                        </div>
                        <div class="login-register-form">
                            <form action="{{action('HomeController@authLogin')}}" method="post">
                                @csrf
                                <div class="login-register-input-style input-style input-style-white">
                                    <label>Email address *</label>
                                    <input type="email" name="email">
                                    @error('email')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style input-style-white">
                                    <label>Password *</label>
                                    <input type="password" name="password" required>
                                    @error('password')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="lost-remember-wrap">
                                    <div class="remember-wrap">
                                        <input type="checkbox">
                                        <span>{{__('Më mbaj mend')}}</span>
                                    </div>
                                    <div class="lost-wrap">
                                        <a href="{{action('HomeController@resetPasswordView')}}">{{__('Harruat passwordin?')}}</a>
                                    </div>
                                </div>
                                <div class="login-register-btn">
                                    <button type="submit">{{__('Kyçu')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login-register-wrap">
                        <div class="login-register-title">
                            <h1>{{__('Regjistrohu')}}</h1>
                        </div>
                        <div class="login-register-form">
                            <form action="{{action('HomeController@authRegister')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="login-register-input-style input-style">
                                    <label>Farmacia *</label>
                                    <input type="text" name="name" value="{{old('name')}}" required>
                                    @error('name')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Qyteti *</label>
                                    <select name="city" required>
                                        <option value="" selected disabled>{{__('Qyteti *')}}</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <span>{{__('Zgjedh *')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Adresa </label>
                                    <input type="text" value="{{old('address')}}" name="address">
                                    @error('address')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Telefoni *</label>
                                    <input type="text" value="{{old('phone_number')}}" name="phone_number" required>
                                    @error('phone_number')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Email address *</label>
                                    <input type="email" value="{{old('email')}}" name="email" required>
                                    @error('email')
                                    <span>{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Password *</label>
                                    <input type="password" name="password">
                                    @error('password')
                                    <span class="text-center text-danger">{{__('Mbush')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Logo * </label>
                                    <input type="file" name="logo" accept="image/png, image/jpeg, image/jpg" id="logo"
                                           required>
                                    @error('logo')
                                    <span>{{__('Zgjedh Logon')}}</span>
                                    @enderror
                                </div>
                                <div class="login-register-input-style input-style">
                                    <label>Captcha * </label>
                                    <div class="captcha">
                                        <span> {!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success" style="background-color: #4e97fd " class="reload" id="reload">
                                            &#x21bb;
                                        </button>
                                    </div>
                                </div>
                                @error('captcha')
                                <span>{{__('Mbush Captcha')}}</span>
                                @enderror
                                <div class="login-register-input-style input-style">
                                    <input id="captcha" type="text" class="form-control"  name="captcha">
                                </div>

                                <div class="login-register-btn">
                                    <button type="submit">{{__('Regjistrohu')}}</button>
                                </div>
                            </form>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"> </script>
                            <script type="text/javascript">
                                $('#reload').click(function (e) {
                                    e.preventDefault();
                                        $.ajax({
                                        type: 'GET',
                                        url: '/reload-captcha',
                                        success: function (data) {
                                            $(".captcha span").html(data.captcha);
                                        }
                                    });
                                });

                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
