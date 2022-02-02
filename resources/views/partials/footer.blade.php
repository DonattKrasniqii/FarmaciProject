<footer class="footer-area pt-75 pb-35">
    <div class="custom-container">
        <div class="row">
            <div class="col-width-25 custom-common-column">
                <div class="footer-widget footer-about mb-30">
                    <div class="footer-logo logo-width-1">
                      <span>BarnatoreON</span>
                    </div>
                    <div class="copyright">
                        <p>Copyright © {{date('Y')}} {{config('app.name')}} |<br>
                            <a href="/">Të drejtat e rezervuara.
                            </a>
                        </p>
                        <p>Powered: Our Team <3
                        <div class="product-details-social tooltip-style-4 ">
                            <a target="_blank" aria-label="Website" class="linkedin" href="
3"><i class="fab fa-linkedin"></i></a>
                            <a target="_blank" aria-label="Facebook" class="facebook ml-2"
                               href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a aria-label="Email" class="envelope ml-2" href="mailto:drenbilalli8@gmail.com"><i
                                    class="fas fa-envelope"></i></a>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-width-22 custom-common-column">
                <div class="footer-widget mb-40">
                    <h3 class="footer-title">Navigim</h3>
                    <div class="footer-info-list">
                        <ul>
                            <li><a href="/"> Ballina</a></li>
                            <li><a href="{{action('BlogController@getBlogs')}}">Blog </a></li>
                            <li><a href="{{action('ContactController@contactView')}}"> Kontakt </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-width-22 custom-common-column">
                <div class="footer-widget mb-40">
                    <h3 class="footer-title">Kontakti</h3>
                    <div class="footer-info-list">
                        <ul>
                            <li><a href="mailto:{{env('CONTACT_EMAIL')}}">{{env('CONTACT_EMAIL')}}</a></li>
                            <li><a href="tel:{{env('CONTACT_PHONE_NUMBER')}}">{{env('CONTACT_PHONE_NUMBER')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-width-31 custom-common-column">
                <div class="footer-widget mb-40">
                    <h3 class="footer-title">Së shpejti</h3>
                    <div class="app-visa-wrap">
                        <p>Aplikacionet mobile</p>
                        <div class="app-google-img">
                            <a href="javascript:void(0)"><img src="{{asset('assets/images/icon-img/app-store.jpg')}}"
                                                              alt=""></a>
                            <a href="javascript:void(0)"><img src="{{asset('assets/images/icon-img/google-play.jpg')}}"
                                                              alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
