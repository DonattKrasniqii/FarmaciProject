

<div class="tab-pane fade" id="acceptedDrugs" role="tabpanel">
    @if(count($drugsToBeAccepted) >0)
    <p>Barnat që po presin aprovimin tuaj :)</p>
    @endif
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Emri Barnes</th>
                    <th>Barnatorja</th>
                    <th>Në pritje</th>
                    <th>Aksion</th>
                </tr>
                </thead>
                <tbody>
                @if(count($drugsToBeAccepted)>0)
                    @foreach($drugsToBeAccepted as $drug)
                        <tr>
                            <td>{{$drug->name}}</td>
                            <td>{{$drug->drugStore->name}}</td>
                            <td>{{($drug->getDuration() > 0 ) ? $drug->getDuration() .' orë ' : $drug->getDurationMinutes() . ' minuta'}} </td>
                            <td><a  href="{{action('DrugsController@acceptDrug',$drug->id)}}"
                                   class="check-btn sqr-btn ">Prano</a>
                                <span>|</span>
                             <a  href="{{action('DrugsController@dontAcceptDrug',$drug->id)}}"
                                    class="check-btn sqr-btn ">Mos prano</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni asnjë medikament në pritje</td>
                        <td>
                        </td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div>
                @if(count($drugsToBeAccepted)>0)
                    <div class="pro-pagination-style text-center mt-55">
                        {{$drugsToBeAccepted->onEachSide(1)->links('vendor.pagination.default') }}
                    </div>
                @endif


    </div>
</div>
