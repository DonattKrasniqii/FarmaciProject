<div class="shop-area adding-30-row-col mt-20">
    <div class="custom-container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                @include('partials.drug-filters')
                @if(count($drugs)>0)
                    <div class="shop-bottom-area">
                        <div class="row">
                            @foreach($drugs as $drug)
                                <div class="col-lg-3 col-md-4 wow tmFadeInUp">
                                    <div class="single-product-wrap mb-50">
                                        <div class="product-img-action-wrap mb-10">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{action('DrugsController@viewDrug',$drug->id)}}">
                                                    <img class="default-img" src="{{asset($drug->mainImagePath())}}"
                                                         alt="{{$drug->name}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{action('UserController@viewStore',$drug->drugStore->id)}}">{{$drug->drugStore->name}}</a>
                                            </div>
                                            <h2>
                                                <a href="{{action('DrugsController@viewDrug',$drug->id)}}">{{$drug->name}}</a>
                                            </h2>
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
                        <div class="pro-pagination-style text-center mb-20">
                            {{ $drugs->onEachSide(1)->links('vendor.pagination.default') }}
                        </div>
                    </div>
                @else
                    <div class="shop-bottom-area">
                        <h3 class="mb-20">{{__('Nuk është gjetur asnjë produkt !')}}</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
