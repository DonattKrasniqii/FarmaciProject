<div class="tab-pane fade" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Barnatorja</th>
                    <th>Produkti</th>
                    <th>Emri</th>
                    <th>Telefoni</th>
                    <th>Adresa</th>
                    <th>Mesazhi</th>
                </tr>
                </thead>
                <tbody>
                @if(count($orders)>0)
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->store}}</td>
                            <td>{{$order->product}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->phone_number}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->message}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni porosi të regjistruara</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(count($orders)>0)
            <div class="pro-pagination-style text-center mt-55">
                {{$orders->onEachSide(1)->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>
</div>
