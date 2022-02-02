@extends('layouts.dashboard')
@section('content')
    <div class="my-account-area pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="sidebar-wrapper sidebar-wrapper-mr1">
                                    <div
                                        class="sidebar-widget sidebar-widget-wrap slidebar-product-wrap-2 sidebar-widget-padding-5 text-center mb-20">
                                        <div class="slidebar-product-content-2 text-center">
                                            <h3>Fotografia Kryesore</h3>
                                        </div>
                                        <div class="slidebar-product-img-2 text-center mt-2">
                                            <a href="javascript:void(0)"><img id="output"
                                                                              src="{{asset($drug->mainImagePath())}}"
                                                                              alt=""></a>
                                        </div>
                                    </div>
                                    <div id="otherPhottosDiv"
                                         class="sidebar-widget sidebar-widget-wrap sidebar-widget-padding-2 mb-20">
                                        <h4 class="sidebar-widget-title">Fotografitë tjera</h4>
                                        <div id="otherPhottosDivImgPlace" class="sidebar-post-wrap mt-30 text-center">
                                            @foreach($drug->images as $image)
                                                <div class="single-sidebar-post"><a href="javascript:void(0)"><img
                                                            width="200px" src="{{$image->image}}"></a></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="myaccount-content">
                                    <div class="account-details-form">
                                        <form action="{{action('DrugsController@updateDrug')}}"
                                              enctype="multipart/form-data"
                                              method="post" autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$drug->id}}">
                                            @if(auth()->user()->is_admin)
                                                <div class="account-info input-style mb-30">
                                                    <label>Barnatore *</label>
                                                    <select name="store" required>
                                                        <option value="" selected disabled>{{__('Barnatore *')}}</option>
                                                        @foreach($stores as $store)
                                                            <option @if($store->id==$drug->user_id) selected @endif value="{{$store->id}}">{{$store->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('store')
                                                    <span>{{__('Zgjedh Barnatoren')}}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="account-info input-style mb-30">
                                                <label>Emri *</label>
                                                <input type="text"
                                                       name="name" value="{{old('name',$drug->name)}}" required>
                                                @error('name')
                                                <span>{{__('Shkruaj Emrin')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Kategoria *</label>
                                                <select name="category" required>
                                                    <option value="" selected disabled>{{__('Kategoria *')}}</option>
                                                    @foreach($categories as $category)
                                                        <option @if($drug->category_id==$category->id) selected
                                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <span>{{__('Zgjedh Kategorinë')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Çmimi (€) </label>
                                                <input type="text" name="price" value="{{old('price',$drug->price)}}">
                                                @error('price')
                                                <span>{{__('Shkruaj Çmimin')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Fotografia Kryesore @if(strlen($drug->mainImagePath())<1)
                                                        * @endif</label>
                                                <input type="file" name="main_photo" id="main_photo"
                                                       onchange="loadImage()"
                                                       accept="image/png, image/jpeg, image/jpg"
                                                       @if(strlen($drug->mainImagePath())<1) required @endif>
                                                @error('main_photo')
                                                <span>{{__('Ngarko Fotografinë')}}</span>
                                                @enderror
                                            </div>

                                            <div class="account-info input-style mb-30">
                                                <label>Fotografitë tjera</label>
                                                <input type="file" multiple name="other_photos[]"
                                                       accept="image/png, image/jpeg, image/jpg">
                                                @error('other_photos')
                                                <span>{{__('Ngarko Fotografitë')}}</span>
                                                @enderror
                                            </div>

                                            <div class="account-info input-style mb-30">
                                                <label>Përshkrim i shkurtër</label>
                                                <textarea name="headline" class="text-align:left" cols="2" rows="4"
                                                          id="headline">{{old('headline',$drug->headline)}}</textarea>
                                                @error('headline')
                                                <span>{{__('Shkruaj Përshkrimin e shkurtër')}}</span>
                                                @enderror
                                            </div>

                                            <div class="account-info input-style mb-30">
                                                <label>Përshkrimi</label>
                                                <textarea name="description" cols="4" rows="5"
                                                          id="description"></textarea>
                                                @error('description')
                                                <span>{{__('Shkruaj Përshkrimin')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info-btn">
                                                <button type="submit">{{__('Ruaj')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.js"></script>
    <script>
        function loadImage() {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    </script>
    <script type="text/javascript">
        var editor = new Jodit('#description');
        editor.value = '{!! $drug->description !!}';
    </script>
@endsection
