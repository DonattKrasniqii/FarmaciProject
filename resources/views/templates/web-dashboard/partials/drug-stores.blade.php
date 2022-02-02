<div class="tab-pane fade" id="drugstores" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Emri</th>
                    <th>Tipi</th>
                    <th>Telefoni</th>
                    <th>Email</th>
                    <th>Data</th>
                    <th>Aksion</th>
                    <th>Statusi</th>
                    <th>Llogaria</th>
                </tr>
                </thead>
                <tbody>
                @if(count($drugStores)>0)
                    @foreach($drugStores as $store)
                        <tr>
                            <td>{{$store->name}}</td>
                            <td>
                                @if($store->advertise_type==\App\Models\User::ADVERTISE_TYPE_PREMIUM)
                                    Premium
                                @elseif($store->advertise_type==\App\Models\User::ADVERTISE_TYPE_TOP)
                                    Top
                                @else
                                    Standard
                                @endif
                            </td>
                            <td>{{$store->phone_number}}</td>
                            <td>{{$store->email}}</td>
                            <td>{{\Carbon\Carbon::parse($store->created_at)->format('d-m-Y H:i:s')}}</td>
                            <td>
                                <a href="{{action('UserController@advertiseType',['id'=>$store->id,'type'=>\App\Models\User::ADVERTISE_TYPE_PREMIUM])}}"
                                   class="check-btn sqr-btn ">Premium</a>
                                <a href="{{action('UserController@advertiseType',['id'=>$store->id,'type'=>\App\Models\User::ADVERTISE_TYPE_TOP])}}"
                                   class="check-btn sqr-btn ">Top</a>
                                <a href="{{action('UserController@advertiseType',['id'=>$store->id,'type'=>\App\Models\User::ADVERTISE_TYPE_STANDARD])}}"
                                   class="check-btn sqr-btn ">Standard</a>
                                <a href="{{action('UserController@deleteUser',$store->id)}}"
                                   class="check-btn sqr-btn ">Fshije</a>
                            </td>
                            @if(Cache::has('user-is-online-' . $store->id))
                                <td><span class="text-success">Online</span></td>
                            @else
                                <td><span class="text-secondary">Offline</span></td>
                            @endif
                            <td>

                                <a href="{{action('UserController@userStatus',['id'=>$store->id,'status' => $store->is_active])}}"
                                   class="check-btn sqr-btn ">{{($store->is_active == \App\Models\User::USER_IS_ACTIVE) ? "Aktive" : "Jo Aktive" }}</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni barnatore të regjistruara</td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(count($drugStores)>0)
            <div class="pro-pagination-style text-center mt-55">
                {{ $drugStores->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>
</div>
