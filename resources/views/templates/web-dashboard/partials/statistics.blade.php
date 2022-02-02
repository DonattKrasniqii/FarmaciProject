<div class="tab-pane fade" id="statistics" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Emri</th>
                    <th>Vizita</th>
                    <th>Hape</th>
                </tr>
                </thead>
                <tbody>
                @if(count($drugs)>0)
                    @foreach($drugs as $drug)
                        <tr>
                            <td>{{$drug->name}}</td>
                            <td>{{$drug->drugVisits->count()}}</td>
                            <td><a target="_blank" href="{{action('DrugsController@viewDrug',$drug->id)}}"
                                   class="check-btn sqr-btn ">Hape</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni produkte të regjistruara</td>
                        <td>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(count($drugs)>0)
            <div class="pro-pagination-style text-center mt-55">
                {{$drugs->onEachSide(1)->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>
</div>
