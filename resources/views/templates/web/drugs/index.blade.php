@extends('layouts.app')
@section('ogImage')
    <meta property="og:title" content="{{$drug->name}}"/>
    <meta property="og:site_name" content="{{$drug->name}}"/>
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{asset($drug->mainImagePath())}}"/>
    <meta property="og:description" content="{{$drug->headline}}"/>
    <meta property="og:url" content="{{action('DrugsController@viewDrug',$drug->id)}}"/>
@endsection
@section('content')
    <div id="fb-root"></div>
{{--    <script async defer crossorigin="anonymous"--}}
{{--            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=153862576584583&autoLogAppEvents=1"--}}
{{--            nonce="mkwSbrR8"></script>--}}
    <div class="product-details-area padding-30-row-col pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="product-details-wrap">
                        <div class="product-details-wrap-top">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="product-details-slider-wrap mb-30">
                                        <div class="pro-dec-big-img-slider">
                                            <?php
                                            $images = $drug->images;
                                            ?>
                                            @foreach($images as $image)
                                                <div class="single-big-img-style">
                                                    <div class="pro-details-big-img">
                                                        <a class="img-popup"
                                                           href="{{asset($image->image)}}">
                                                            <img src="{{asset($image->image)}}" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="product-dec-slider-small product-dec-small-style1">
                                            @foreach($images as $image)
                                                <div class="product-dec-small active">
                                                    <img src="{{asset($image->image)}}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
{{--                                    <div class="fb-page ml-30"--}}
{{--                                         data-href="https://www.facebook.com/barnatoremedikamenteonline"--}}
{{--                                         data-width="340"--}}
{{--                                         data-hide-cover="false"--}}
{{--                                         data-show-facepile="true"></div>--}}
{{--                                </div>--}}
                                <div class="col-lg-6 col-md-6">
                                    <div class="product-details-content pro-details-content-pl">
                                        <h1>{{$drug->name}}</h1>
                                        <div class="pro-details-brand-review">
                                            <div class="pro-details-brand">
                                                <span> Barnatorja: <a
                                                        href="{{action('UserController@viewStore',$drug->drugStore->id)}}">{{$drug->drugStore->name}}</a></span>
                                            </div>
                                            <div class="pro-details-rating-wrap">
                                                <span><i class="fa fa-mobile-alt mr-1"></i>{{$drug->drugStore->phone_number}}</span>
                                            </div>
                                        </div>

                                        <div class="pro-details-price-short-description">
                                            @if(!is_null($drug->price) && floatval($drug->price)>0)
                                                <div class="pro-details-price">
                                                    <span>{{$drug->price}} €</span>
                                                </div>
                                            @endif
                                            <div class="pro-details-short-description">
                                                <p>{{$drug->headline}}</p>
                                            </div>
                                        </div>

                                        <div
                                            class="product-details-social tooltip-style-4 @if($drug->price==0) mt-2 @endif">
                                            <a target="_blank" aria-label="Website" class="website"
                                               href="{{$drug->drugStore->website_url}}"><i class="fa fa-globe"></i></a>
                                            <a target="_blank" aria-label="Facebook" class="facebook"
                                               href="{{$drug->drugStore->facebook_url}}"><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a aria-label="Email" class="envelope"
                                               href="mailto:{{$drug->drugStore->email}}"><i class="fas fa-envelope"></i></a>
                                        </div>
                                        <div class="pro-details-quality-stock-area">
                                            <div class="pro-details-quality-stock-wrap">
                                                <div class="product-details-description">
                                                    <div class="entry-product-section-heading">
                                                        <h2>Përshkrimi</h2>
                                                    </div>
                                                    {!! $drug->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-us-area contact-us-bg pt-75 pb-75">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-width-58 custom-common-column">
                    <div class="contact-from-area contact-from-area-bg padding-20-row-col wow tmFadeInUp"
                         style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                        <h3>{{__('Porosit')}}</h3>
                        @if(session('message'))
                            <p class="form-messege mt-5 mb-5">
                                {{session('message')}}
                            </p>
                        @endif
                        <form class="contact-form-style" action="{{action('OrdersController@saveOrder')}}"
                              method="post">
                            @csrf
                            <input type="hidden" name="drug_id" value="{{$drug->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-style mb-20">
                                        <input name="name" placeholder="Emri *" required type="text">
                                        @error('name')
                                        <span>{{__('Shkruaj Emrin')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-style mb-20">
                                        <input name="phone_number" placeholder="Telefoni *" required type="text">
                                        @error('name')
                                        <span>{{__('Shkruaj Telefonin')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-style mb-20">
                                        <input name="address" placeholder="Adresa *" required type="text">
                                        @error('name')
                                        <span>{{__('Shkruaj Adresen')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="textarea-style mb-30">
                                        <textarea name="message" placeholder="Mesazhi"></textarea>
                                        @error('name')
                                        <span>{{__('Shkruaj Mesazhin')}}</span>
                                        @enderror
                                    </div>
                                    <button class="submit" type="submit">{{__('Porosit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
{{--                <div class="col-width-41 custom-common-column">--}}
{{--                    <div class="contact-info-wrap">--}}
{{--                        <a target="_blank" href="https://www.instagram.com/herbalinaadelina">--}}
{{--                            <img src="{{asset('/assets/ads/ad1.jpg')}}" class="img-fluid">--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    @if(count($related)>0)
        <div class="product-area border-top-2 pt-75 pb-70">
            <div class="container">
                <div class="section-title-1 mb-40">
                    <h2>Të ngjashme</h2>
                </div>
                <div class="product-slider-active-1 nav-style-2 nav-style-2-modify-3">
                    @foreach($related as $rel)
                        <div class="product-plr-1">
                            <div class="single-product-wrap">
                                <div class="product-img-action-wrap mb-20">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{action('DrugsController@viewDrug',$rel->id)}}">
                                            <img class="default-img" src="{{asset($rel->mainImagePath())}}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2>
                                        <a href="{{action('DrugsController@viewDrug',$rel->id)}}"></a>{{$rel->name}}
                                    </h2>
                                    @if(!is_null($rel->price) && floatval($rel->price)>0)
                                        <div class="product-price">
                                            <span>{{$rel->price}} €</span>
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
