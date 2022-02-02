<div class="col-lg-9 col-md-9">
    <div class="tab-content" id="myaccountContent">
        <!-- Single Tab Content Start -->
        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
            <div class="myaccount-content">
                <div class="welcome">

                    <p>{{__('Përshendetje')}}, <strong>{{auth()->user()->name}}</strong></p>
                </div>
                @if(auth()->user()->is_admin)
                    <p class="mb-0">{{__('Ky është paneli permes së cilit ju menaxhoni aplikacionin .')}} </p>
                @else
                <p class="mb-0">{{__('Ky është paneli permes së cilit ju menaxhoni farmacinë tuaj.')}} </p>
                @endif
            </div>
        </div>
        <!-- Single Tab Content End -->
    @if(auth()->user()->is_admin)
        @include('templates.web-dashboard.partials.drug-stores')
        @include('templates.web-dashboard.partials.payments')
        @include('templates.web-dashboard.partials.statistics')
        @include('templates.web-dashboard.partials.contact-messages')
        @include('templates.web-dashboard.partials.blogstatistics')
        @include('templates.web-dashboard.partials.blog')
        @include('templates.web-dashboard.partials.acceptedDrugs')
        @include('templates.web-dashboard.partials.jiraBugsNotifier')
    @endif
    @include('templates.web-dashboard.partials.drugs')
    @include('templates.web-dashboard.partials.orders')
    @include('templates.web-dashboard.partials.profileViews')
    <!-- Single Tab Content Start -->
        @include('templates.web-dashboard.partials.account')
    </div>
</div> <!-- My Account Tab Content End -->
