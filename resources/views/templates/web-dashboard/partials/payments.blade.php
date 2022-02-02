<div class="tab-pane fade" id="payments" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <button type="button" class="btn btn-primary float-right mb-20" data-toggle="modal"
                    data-target="#addPaymentModal">{{__('Regjistro')}}</button>
            <a href="{{action('PaymentsController@printExcelData')}}" class="btn btn-primary float-right mb-20">{{__('Shkarko në Excel')}}</a>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Barnatorja</th>
                    <th>Tipi</th>
                    <th>Shuma</th>
                    <th>Prej</th>
                    <th>Deri</th>
                    <th>Regjistruar</th>
                    <th>Shenim</th>
                    <th>Aksion</th>
                </tr>
                </thead>
                <tbody>
                @if(count($payments)>0)
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->store->name}}</td>
                            @if($payment->type==\App\Models\Payment::TYPE_MEMBER_SHIP)
                                <td>{{__('Antarësim')}}</td>
                            @elseif($payment->type==\App\Models\Payment::TYPE_MARKETING_ADS)
                                <td>{{__('Marketing')}}</td>
                            @endif
                            <td>{{$payment->sum}} {{__('€')}}</td>
                            <td>{{\Carbon\Carbon::parse($payment->from)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($payment->to)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($payment->created_at)->format('d-m-Y H:i:s')}}</td>
                            <td>{{$payment->note}}</td>
                            <td>
                                <a data-id="{{$payment->id}}" href="javascript:void(0)"
                                   class="check-btn sqr-btn paymentEditBtn">Edito</a>
                                <a href="{{action('PaymentsController@deletePayment',$payment->id)}}"
                                   class="check-btn sqr-btn ">Fshije</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni pagesa të regjistruara</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(count($payments)>0)
            <div class="pro-pagination-style text-center mt-55">
                {{$payments->onEachSide(1)->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>
</div>

<!-- Add Modal -->
<div id="addPaymentModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Regjistro Pagesë')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{action('PaymentsController@store')}}"
                      method="post" autocomplete="off">
                    @csrf
                    <div class="account-info input-style mb-30">
                        <label>Barnatorja *</label>
                        <select name="user" required>
                            <option value="" selected disabled>{{__('Barnatorja *')}}</option>
                            @foreach($stores as $store)
                                @if(!$store->isAdmin())
                                <option value="{{$store->id}}">{{$store->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user')
                        <span>{{__('Zgjedh *')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Tipi *</label>
                        <select name="type" required>
                            <option value="" selected disabled>{{__('Tipi *')}}</option>
                            <option value="{{\App\Models\Payment::TYPE_MEMBER_SHIP}}">{{__('Antarësim')}}</option>
                            <option value="{{\App\Models\Payment::TYPE_MARKETING_ADS}}">{{__('Marketing')}}</option>
                        </select>
                        @error('type')
                        <span>{{__('Zgjedh *')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Shuma </label>
                        <input type="text" name="sum"
                               value="{{old('sum')}}">
                        @error('sum')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Prej *</label>
                        <input type="date" name="from" required
                               value="{{old('from')}}">
                        @error('from')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Deri *</label>
                        <input type="date" name="to" required
                               value="{{old('to')}}">
                        @error('to')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Shenim</label>
                        <textarea name="note" cols="4" rows="5"
                                  id="note"></textarea>
                        @error('note')
                        <span>{{__('Shkruaj Shenimin')}}</span>
                        @enderror
                    </div>
                    <div class="account-info-btn">
                        <button class="btn btn-primary float-right" type="submit">{{__('Ruaj')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edito Pagesë')}}</h5>
                <button type="button" class="close" id="closePaymentEditModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{action('PaymentsController@update')}}"
                      method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="">
                    <div class="account-info input-style mb-30">
                        <label>Barnatorja *</label>
                        <select name="user" id="user" required>
                            <option value="" selected disabled>{{__('Barnatorja *')}}</option>
                            @foreach($stores as $store)
                                <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                        @error('user')
                        <span>{{__('Zgjedh *')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Tipi *</label>
                        <select name="type" id="type" required>
                            <option value="" selected disabled>{{__('Tipi *')}}</option>
                            <option value="{{\App\Models\Payment::TYPE_MEMBER_SHIP}}">{{__('Antarësim')}}</option>
                            <option value="{{\App\Models\Payment::TYPE_MARKETING_ADS}}">{{__('Marketing')}}</option>
                        </select>
                        @error('type')
                        <span>{{__('Zgjedh *')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Shuma </label>
                        <input type="text" name="sum" id="sum"
                               value="{{old('sum')}}">
                        @error('sum')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Prej *</label>
                        <input type="date" name="from" required id="from"
                               value="{{old('from')}}">
                        @error('from')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Deri *</label>
                        <input type="date" name="to" required id="to"
                               value="{{old('to')}}">
                        @error('to')
                        <span>{{__('Mbush')}}</span>
                        @enderror
                    </div>
                    <div class="account-info input-style mb-30">
                        <label>Shenim</label>
                        <textarea name="note" cols="4" rows="5"
                                  id="note"></textarea>
                        @error('note')
                        <span>{{__('Shkruaj Shenimin')}}</span>
                        @enderror
                    </div>
                    <div class="account-info-btn">
                        <button class="btn btn-primary float-right" type="submit">{{__('Ruaj')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
