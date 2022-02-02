<div class="brand-logo-area pb-35 mt-20">
    <div class="container">
        <div class="row align-items-center">
            @foreach($bannerDrugStores as $store)
                <div class="custom-col-5 wow tmFadeInUp">
                    <div class="single-brand-logo mb-30">
                        <a href="{{action('UserController@viewStore',$store->id)}}"><img src="{{asset($store->logo)}}" alt=""></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
