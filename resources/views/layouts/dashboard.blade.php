<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{getenv('APP_NAME')}}</title>
    <meta name="description"
          content="Barnatore Online, Farmaci Online, Kerko Barna, Online, Shop, Blej Barna, Shit Barna">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="{{getenv('APP_URL')}}"/>

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="BarnatoreON"/>
    <meta property="og:url" content="{{getenv('APP_URL')}}"/>
    <meta property="og:site_name" content="{{getenv('APP_NAME')}}"/>
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="{{asset('assets/images/logo/logo.png')}}"/>
    <meta property="og:description" content="BarnatoreON"/>
    <!-- Add site Favicon -->
    <link rel="icon" href="{{asset('assets/images/logo/logo.png')}}" sizes="32x32"/>

    <!-- All CSS is here
	============================================ -->

    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-medizin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-cerebrisans.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-195372692-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-195372692-1');
    </script>

</head>

<body>

<div class="main-wrapper">
    @include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('partials._sessionAlerts')
            </div>
        </div>
    </div>
    @yield('content')
    @include('partials.footer')
</div>
@include('partials.mobile-menu')

<!-- All JS is here
============================================ -->
<script src="{{asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/slick.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.syotimer.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/wow.js')}}"></script>
<script src="{{asset('assets/js/plugins/svg-inject.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery-ui-touch-punch.js')}}"></script>
<script src="{{asset('assets/js/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/clipboard.js')}}"></script>
<script src="{{asset('assets/js/plugins/vivus.js')}}"></script>
<script src="{{asset('assets/js/plugins/waypoints.js')}}"></script>
<script src="{{asset('assets/js/plugins/counterup.js')}}"></script>
<script src="{{asset('assets/js/plugins/mouse-parallax.js')}}"></script>
<script src="{{asset('assets/js/plugins/images-loaded.js')}}"></script>

<script src="{{asset('assets/js/plugins/isotope.js')}}"></script>
<script src="{{asset('assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('assets/js/plugins/ajax-mail.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.css"
      integrity="sha512-xc6LLwdApLadqLJTZCrkXyYGYqJxk+pyhCCw4pQa4lSDxUHfW1Wn6Inh8bvGAxXsU6SsP4zOTR99nnU79E5Tig=="
      crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.js"
        integrity="sha512-v8HnXqzpxUsxGp5URUiLSIAeMzlVZtFsJRkmLav9kVmD8O6vdbyMhJGGFWGL76T6+NRZydBBEn46LivCl5Rxsg=="
        crossorigin="anonymous"></script>
<script src="{{asset('assets/js/inline_scripts.js')}}"></script>

@yield('scripts')
</body>
</html>
