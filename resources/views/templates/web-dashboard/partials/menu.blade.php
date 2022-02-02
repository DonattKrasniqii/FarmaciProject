<div id="menuDiv" class="myaccount-tab-menu nav" role="tablist">
    <a href="#dashboad" class="active" data-toggle="tab">{{__('Ballina')}}</a>
    <a href="#drugs" data-toggle="tab">{{__('Barnat')}}</a>
    <a href="#orders" data-toggle="tab">{{__('Porositë')}}</a>
    @if(auth()->user()->is_admin)
        <a href="#drugstores" data-toggle="tab">{{__('Barnatoret')}}</a>
        <a href="#payments" data-toggle="tab">{{__('Pagesat')}}</a>
        <a href="#statistics" data-toggle="tab">{{__('Statistikat')}}</a>
        <a href="#blogstatistics" data-toggle = "tab"> {{__('Statistikat e blogut')}}</a>
        <a href="#contact-messages" data-toggle="tab">{{__('Mesazhet')}}</a>
        <a href="#blog" data-toggle="tab">{{__('Blogu')}}</a>
        <a href="#acceptedDrugs" data-toggle="tab">{{__('Prano Barnat')}}
        @if($countNotAccepted > 0)
                <span class="badge rounded-pill bg-warning text-dark">{{$countNotAccepted}}</span>
            @endif
        </a>
    @endif
    <a href="#countProfile-Views" data-toggle="tab">{{__('Shikimet e profilit')}}</a>
    <a href="#account-info" data-toggle="tab"> {{__('Llogaria')}}</a>
    @if(auth()->user()->is_admin)
        <a href="#jiraBugPanel" data-toggle="tab">{{__('Jira ')}}</a>
        @endif
    <a id="logOutBtn" href="{{action('HomeController@logout')}}">{{__('Çkyqu')}}</a>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#menuDiv a:not(:last-child)').click(function () {
                var href = $(this).attr('href');
                localStorage.setItem('active-menu', href);
            });
            var active = localStorage.getItem('active-menu');
            if (typeof active != 'undefined') {
                if (active.length > 2) {
                    $('#menuDiv a:not(:last-child)').each(function () {
                        var href = $(this).attr('href');
                        if (typeof href != 'undefined') {
                            if (href.length > 2) {
                                if (active === href) {
                                    $(this).addClass('active');
                                } else {
                                    $(this).removeClass('active');
                                }
                            }
                        }
                    });
                    if(typeof active!='undefined'){
                        $('#myaccountContent div').each(function () {
                            var id = $(this).attr('id');
                            if (typeof id != 'undefined') {
                                if (id.length > 2) {
                                    id = '#' + id;
                                    if (active === id) {
                                        $(this).addClass('show');
                                        $(this).addClass('active');
                                    } else {
                                        $(this).removeClass('active');
                                        $(this).removeClass('show');
                                    }
                                }
                            }
                        });
                    }
                }
            }
        });

        $('#logOutBtn').click(function (){
            localStorage.removeItem('active-menu');
        });
    </script>
@endsection
