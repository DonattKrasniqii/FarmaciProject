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
                                            <a id="outputLink" href="javascript:void(0)"><img id="output"
                                                                                              src="{{asset('assets/images/product/sidebar-product-1.jpg')}}"
                                                                                              alt=""></a>
                                        </div>
                                    </div>
                                    <div id="otherPhottosDiv"
                                         class="sidebar-widget sidebar-widget-wrap sidebar-widget-padding-2 mb-20 d-none">
                                        <h4 class="sidebar-widget-title">Fotografitë tjera</h4>
                                        <div id="otherPhottosDivImgPlace" class="sidebar-post-wrap mt-30 text-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="myaccount-content">
                                    <div class="account-details-form">
                                        <form action="{{action('DrugsController@saveDrug')}}"
                                              enctype="multipart/form-data" id="addDrugsForm"
                                              method="post" autocomplete="off">
                                            @csrf
                                            @if(auth()->user()->is_admin)
                                                <div class="account-info input-style mb-30">
                                                    <label>Barnatore *</label>
                                                    <select name="store" required>
                                                        <option value="" selected disabled>{{__('Barnatore *')}}</option>
                                                        @foreach($stores as $store)
                                                            <option value="{{$store->id}}">{{$store->name}}</option>
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
                                                       name="name" value="{{old('name')}}" required>
                                                @error('name')
                                                <span>{{__('Shkruaj Emrin')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Kategoria *</label>
                                                <select name="category" required>
                                                    <option value="" selected disabled>{{__('Kategoria *')}}</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <span>{{__('Zgjedh Kategorinë')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Çmimi (€) </label>
                                                <input type="text" name="price" value="{{old('price')}}">
                                                @error('price')
                                                <span>{{__('Shkruaj Çmimin')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Fotografia Kryesore*</label>
                                                <input type="file" name="main_photo" id="main_photo"
                                                       onchange="loadImage()" accept="image/png, image/jpeg, image/jpg"
                                                       required>
                                                @error('main_photo')
                                                <span>{{__('Ngarko Fotografinë')}}</span>
                                                @enderror
                                            </div>

                                            <div class="account-info input-style mb-30">
                                                <label>Fotografitë tjera</label>
                                                <input type="file" multiple
                                                       name="other_photos[]"
                                                       accept="image/png, image/jpeg, image/jpg" id="other_photos">
                                                @error('other_photos')
                                                <span>{{__('Ngarko Fotografitë')}}</span>
                                                @enderror
                                            </div>
                                            <div class="account-info input-style mb-30">
                                                <label>Përshkrim i shkurtër</label>
                                                <textarea name="headline" cols="4" rows="5" id="headline"></textarea>
                                                @error('headline')
                                                <span>{{__('Shkruaj HeadLine')}}</span>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.css"
          integrity="sha512-xc6LLwdApLadqLJTZCrkXyYGYqJxk+pyhCCw4pQa4lSDxUHfW1Wn6Inh8bvGAxXsU6SsP4zOTR99nnU79E5Tig=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.js"
            integrity="sha512-v8HnXqzpxUsxGp5URUiLSIAeMzlVZtFsJRkmLav9kVmD8O6vdbyMhJGGFWGL76T6+NRZydBBEn46LivCl5Rxsg=="
            crossorigin="anonymous"></script>
    <script>
        function loadImage() {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }


        var filesInput = $("#other_photos");

        filesInput.on("change", function (e) {
            var files = e.target.files; //FileList object
            var result = $("#otherPhottosDivImgPlace");
            $('#otherPhottosDiv').removeClass('d-none');
            $('#otherPhottosDivImgPlace').html('');
            $.each(files, function (i, file) {
                var pReader = new FileReader();

                pReader.addEventListener("load", function (e) {
                    var pic = e.target;
                    result.append('<div class="single-sidebar-post">' + '<a href="javascript:void(0)">' +
                        "<img width='200px' src='" + pic.result + "'/>" +
                        '</a>' + '</div>');

                });
                pReader.readAsDataURL(file);

            });


        });

        $('#outputLink').click(function () {
            $('#main_photo').click();
        });
    </script>
    <script type="text/javascript">
        var editor = new Jodit('#description')
    </script>
@endsection
