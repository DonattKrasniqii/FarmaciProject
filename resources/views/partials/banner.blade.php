<div class="categories-area pb-70">
    <div class="custom-container mb-40">
        <div class="categories-slider-1 wow tmFadeInUp">
            @foreach($bannerDrugStores as $store)
                <div class="product-plr-1">
                    <div class="categories-wrap">
                        <div class="categories-img categories-img-zoom">
                            <a href="{{action('UserController@viewStore',$store->id)}}">
                                <img  src="{{asset($store->logo)}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
