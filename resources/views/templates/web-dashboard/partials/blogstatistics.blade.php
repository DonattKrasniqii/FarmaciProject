<div class="tab-pane fade" id="blogstatistics" role="tabpanel">
    <div class="myaccount-content">
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Emri Blogut</th>
                    <th>Vizita</th>
                    <th>Hape</th>
                </tr>
                </thead>
                <tbody>
                @if(count($blogs)>0)
                    @foreach($blogs as $blog)
                        <tr>
                            <td>{{$blog->name}}</td>
                            <td>{{0}}</td>
                            <td><a target="_blank" href="{{action('BlogController@viewBlog',$blog->id)}}"
                                   class="check-btn sqr-btn ">Hape</a>
                                <span>|</span>
                                <a href="{{action('BlogController@featuredState',['id' => $blog->id,'type' => $blog->is_featured])}}"
                                   class="check-btn sqr-btn ">{{(( $blog->is_featured == 0) ? 'Aktiv' : 'Jo Aktiv') }}</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td>Nuk keni asnjë blog të postuar</td>
                        <td>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
{{--        @if(count($blogs)>0)--}}
{{--            <div class="pro-pagination-style text-center mt-55">--}}
{{--                {{$blogs->onEachSide(1)->links('vendor.pagination.default') }}--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
</div>
