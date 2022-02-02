<div class="tab-pane fade" id="account-info" role="tabpanel">
    <div class="myaccount-content">
        <div class="account-details-form">
            <form action="{{action('DashboardController@userInfoUpdate')}}" enctype="multipart/form-data"
                  method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="account-info input-style mb-30">
                    <label>Logo  @if(is_null(auth()->user()->logo)) * @endif</label>
                    <input type="file" name="logo" accept="image/png, image/jpeg, image/jpg" id="logo"
                           @if(is_null(auth()->user()->logo)) required @endif>
                    @error('logo')
                    <span>{{__('Zgjedh Logon')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Farmacia *</label>
                    <input type="text" value="{{old('name',auth()->user()->name)}}"
                           name="name" required>
                    @error('name')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Qyteti *</label>
                    <select name="city" required>
                        <option value="" disabled>{{__('Qyteti *')}}</option>
                        @foreach($cities as $city)
                            <option @if(auth()->user()->city_id==$city->id) selected
                                    @endif value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    @error('city')
                    <span>{{__('Zgjedh *')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Adresa </label>
                    <input type="text" name="address"
                           value="{{old('address',auth()->user()->address)}}">
                    @error('address')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Telefoni *</label>
                    <input type="text" name="phone_number" required
                           value="{{old('phone_number',auth()->user()->phone_number)}}">
                    @error('phone_number')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Email address *</label>
                    <input type="email" name="email" required
                           value="{{old('email',auth()->user()->email)}}">
                    @error('email')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Password *</label>
                    <input type="password" name="password">
                    @error('password')
                    <span class="text-center text-danger">{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Website Url</label>
                    <input type="text" name="website_url"
                           value="{{old('website_url',auth()->user()->website_url)}}">
                    @error('website_url')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Facebook Url</label>
                    <input type="text" name="facebook_url"
                           value="{{old('facebook_url',auth()->user()->facebook_url)}}">
                    @error('facebook_url')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info-btn">
                    <button type="submit">{{__('Ruaj')}}</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Single Tab Content End -->
