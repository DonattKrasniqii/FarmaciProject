<div class="tab-pane fade" id="blog" role="tabpanel">
    <div class="myaccount-content">
        <div class="account-details-form">
            <form action="{{action('BlogController@store')}}" id="blogForm" enctype="multipart/form-data"
                  method="post" autocomplete="off">
                @csrf
                <div class="account-info input-style mb-30">
                    <label>Emri *</label>
                    <input type="text" value=""
                           name="name" required>
                    @error('name')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Fotografia *</label>
                    <input type="file" name="photto" id="photto"
                           onchange="loadImage()" accept="image/png, image/jpeg, image/jpg"
                           required>
                    @error('main_photo')
                    <span>{{__('Ngarko Fotografinë')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Përshkrimi * </label>
                    <textarea required name="description" cols="4" rows="5"
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
