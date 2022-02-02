@extends('layouts.app')
@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=153862576584583&autoLogAppEvents=1"
            nonce="mkwSbrR8"></script>
    <div class="about-us-area fix about-us-img pt-65 pb-10 mb-30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-img wow tmFadeInUp">
                        <img class="mb-30" src="{{asset($user->logo)}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-us-content wow tmFadeInUp">
                        <h3>Emri: {{$user->name}} <span class="{{$user->getBadgeColor()}}">{{$user->getUserTypeBadge($user->advertise_type)}}</span></h3>
                        <h4>Telefoni: {{$user->phone_number}}</h4>
                        <h4>Email: {{$user->email}}</h4>
                        <h4>Qyteti: {{$user->city->name ?? ''}}</h4>
                        <h4>Adresa: {{$user->address}}</h4>
                        <div class="product-details-social tooltip-style-4 ">
                            <a target="_blank" aria-label="Website" class="website" href="{{$user->website_url}}"><i class="fa fa-globe"></i></a>
                            <a target="_blank" aria-label="Facebook" class="facebook ml-2" href="{{$user->facebook_url}}"><i class="fab fa-facebook-f"></i></a>
                            <a aria-label="Email" class="envelope ml-2" href="mailto:{{$user->email}}"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($user->drugs)>0)
        <div class="product-area pb-20 mt-20">
            <div class="custom-container">
                <div class="section-title-1 mb-40">
                    <h2>Medikamentet</h2>
                </div>
                <div class="row">
                    @foreach($user->drugs as $drug)
                        <div class="custom-col-5">
                            <div class="single-product-wrap mb-50 wow tmFadeInUp">
                                <div class="product-img-action-wrap mb-20">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{action('DrugsController@viewDrug',$drug->id)}}">
                                            <img class="default-img" src="{{asset($drug->mainImagePath())}}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2><a href="product-details.html">{{$drug->name}}</a></h2>
                                    @if(!is_null($drug->price) && floatval($drug->price)>0)
                                        <div class="product-price">
                                            <span>{{$drug->price}} €</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
