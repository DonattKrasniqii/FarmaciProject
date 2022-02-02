<header class="header-area header-height-3">
    <div class="header-bottom sticky-bar sticky-white-bg">
        <div class="custom-container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 logo-hm3">
                   <span>BarnatoreOn</span>
                </div>
                <div
                    class="main-menu main-menu-grow main-menu-padding-1 main-menu-lh-1 main-menu-mrg-1 hm3-menu-padding d-none d-lg-block hover-boder">
                    <nav>
                        <ul>
                            <li><a href="/">Ballina </a></li>
                            <li><a href="{{action('BlogController@getBlogs')}}">Blog </a></li>
                            <li><a href="{{action('ContactController@contactView')}}">Kontakt </a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-action-right">
                    <div class="search-style-1 d-none d-lg-block">
                        <form action="/">
                            <input type="text" id="drug_name" name="q" @if(request()->has('q')) value="{{request()->q}}" @endif placeholder="Kërko {{$drugsCount ?? ''}} medikamente...">

                            <button type="submit"><i class="far fa-search"></i></button>


                        </form>
                    </div>
                    <div class="header-action header-action-hm3">
                        <div class="header-action-icon header-action-mrg-none2">
                            <div id="hideSearch" class="header-action-icon">
                                <a id="mobileSearchIcon" class="search-active" href="#"><i class="far fa-search"></i></a>
                            </div>


                            <div class="header-action-icon header-action-mrg-none2">
                                @if(auth()->check())

                                    <a href="{{action('DashboardController@index')}}"><i
                                            class="far fa-user icon"></i>Dashboard</a>
                                @else
                                    <a href="{{action('HomeController@auth')}}"><i class="far fa-user icon"></i>Llogaria</a>
                                @endif
                            </div>
                            <div class="header-action-icon d-block d-lg-none">
                                <div class="burger-icon">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</header>
