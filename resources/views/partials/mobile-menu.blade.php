<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src="{{asset('assets/images/logo/logo.png')}}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="/">
                    <input type="text" name="q" placeholder="Jam duke kërkuar...">
                    <button type="submit"><i class="far fa-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li><a href="/">Ballina </a></li>
                        <li><a href="{{action('BlogController@getBlogs')}}">Blog </a></li>
                        <li><a href="{{action('ContactController@contactView')}}">Kontakt </a></li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
        </div>
    </div>
</div>
