<div class="tab-pane fade" id="countProfile-Views" role="tabpanel">
    <div class="mycountProfile-content">
        <span>Njoftimet <strong>{{auth()->user()->views->count()}}</strong></span>

        @foreach(auth()->user()->views as $view)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong> Barnatorja <strong>{{$view->profileViewer->name}}</strong> ka shikuar profilin tende ne
                {{$view->created_at->format('h:i A')}}.
                <button type="button" href="/" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a href={{action('UserController@viewsDelete',['id' => $view->id])}} > <strong>  Mark as read</strong></a>
                <strong>|</strong>
                <a href={{action('UserController@viewStore',['id' => $view->profileViewer->id])}} > <strong>  Shiko profilin</strong></a>
            </div>
        @endforeach
        </div>
    </div>
</div> <!-- Single Tab Content End -->
