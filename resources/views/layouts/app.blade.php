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
    <meta property="fb:app_id" content="153862576584583">
    <meta property="og:locale" content="en_US"/>
    <meta property="og:title" content="{{getenv('APP_NAME')}}"/>
    <meta property="og:site_name" content="{{getenv('APP_NAME')}}"/>
    <!-- For the og:image content, replace the # with a link of an image -->
@yield('ogImage')
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
{{--<div class="main-wrapper">--}}
{{--    <!-- Messenger Chat Plugin Code -->--}}
{{--    <div id="fb-root"></div>--}}
{{--      <script>--}}
{{--        window.fbAsyncInit = function() {--}}
{{--          FB.init({--}}
{{--            xfbml            : true,--}}
{{--            version          : 'v10.0'--}}
{{--          });--}}
{{--        };--}}

{{--        (function(d, s, id) {--}}
{{--          var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--          if (d.getElementById(id)) return;--}}
{{--          js = d.createElement(s); js.id = id;--}}
{{--          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';--}}
{{--          fjs.parentNode.insertBefore(js, fjs);--}}
{{--        }(document, 'script', 'facebook-jssdk'));--}}
{{--      </script>--}}

{{--      <!-- Your Chat Plugin code -->--}}
{{--      <div class="fb-customerchat"--}}
{{--        attribution="biz_inbox"--}}
{{--        page_id="103281815034005">--}}
{{--      </div>--}}
    @include('partials.header')
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

@yield('scripts')
</body>
</html>
