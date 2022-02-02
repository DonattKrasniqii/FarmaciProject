<div class="tab-pane fade" id="drugs" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <a href="{{action('DrugsController@addDrugView')}}"
               class="btn btn-primary float-right mb-20">{{__('Regjistro')}}</a>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Emri</th>
                    <th>Çmimi</th>
                    <th>Aksion</th>
                </tr>
                </thead>
                <tbody>
                @if(count($drugs)>0)
                    @foreach($drugs as $drug)
                        <tr>
                            @if($drug->user_id == auth()->user()->id)
                                <td>{{$drug->name}} <span><i class="fas fa-bookmark" title="Medikamenti i juaj &#128512"></i></span ></td>
                            @else
                                <td>{{$drug->name}}</td>
                            @endif
                            <td>{{$drug->price}}</td>
                            <td>
                                <a href="{{action('DrugsController@editDrugView',$drug->id)}}"
                                   class="check-btn sqr-btn ">Edito</a>
                                <a href="{{action('DrugsController@deleteDrug',$drug->id)}}"
                                   class="check-btn sqr-btn ">Fshije</a>
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
            <div class="pro-pagination-style text-center mt-55">
                {{ $drugs->onEachSide(1)->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
