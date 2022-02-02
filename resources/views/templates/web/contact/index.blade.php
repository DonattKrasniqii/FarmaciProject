@extends('layouts.app')
@section('content')
    <div class="contact-us-area pt-65 pb-55">
        <div class="container">
            <div class="section-title-2 mb-45 wow tmFadeInUp"
                 style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                <h2>Motivimi për sot!</h2>
                <p>{!! motivational_qoute() !!}</p>
            </div>
            <div class="contact-info-wrap-2 mb-40">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 col-sm-5 wow tmFadeInUp"
                         style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                        <div class="single-contact-info3-wrap mb-30">
                            <div class="single-contact-info3-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="single-contact-info3-content">
                                <h3>Adresa</h3>
                                <p class="width-1"> Prishtinë</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 col-sm-7 wow tmFadeInUp"
                         style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                        <div class="single-contact-info3-wrap mb-30">
                            <div class="single-contact-info3-icon">
                                <i class="fal fa-phone"></i>
                            </div>
                            <div class="single-contact-info3-content">
                                <h3>Kontakt</h3>
                                <p> Telefoni: <span>{{env('CONTACT_PHONE_NUMBER')}}</span></p>
                                <p> Mail: <span>{{env('CONTACT_EMAIL')}}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 col-sm-12 wow tmFadeInUp"
                         style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                        <div class="single-contact-info3-wrap mb-30">
                            <div class="single-contact-info3-icon">
                                <i class="fal fa-clock"></i>
                            </div>
                            <div class="single-contact-info3-content">
                                <h3>Orari i punës</h3>
                                <p> Hënë - Premte: 09:00 - 17:00 </p>
                                <p> Shtunë &amp; Diele: 11:30 - 15:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-10 ml-auto mr-auto">
                    <div class="contact-from-area  padding-20-row-col wow tmFadeInUp"
                         style="visibility: visible; animation-name: medizinAnimationFadeInUp;">
                        <h3>Na dërgo mesazh</h3>
                        @if(session('message'))
                            <p class="form-messege mt-5 mb-5">
                                {{session('message')}}
                            </p>
                        @endif
                        <form class="contact-form-style text-center"
                              action="{{action('ContactController@saveContact')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="name" placeholder="Emri *" required type="text">
                                        @error('name')
                                        <span>{{__('Shkruaj Emrin')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="name2" placeholder="Mbiemri *" required type="text">
                                        @error('name2')
                                        <span>{{__('Shkruaj Mbiemrin')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="phone_number" placeholder="Telefoni *" required type="tel">
                                        @error('phone_number')
                                        <span>{{__('Shkruaj Telefonin')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input name="email" placeholder="Email *" required type="email">
                                        @error('email')
                                        <span>{{__('Shkruaj Emailn')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="textarea-style mb-30">
                                        <textarea name="message" placeholder="Mesazhi *" required></textarea>
                                        @error('message')
                                        <span>{{__('Shkruaj Mesazhin')}}</span>
                                        @enderror
                                    </div>
                                    <button class="submit submit-auto-width" type="submit">Dërgo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
