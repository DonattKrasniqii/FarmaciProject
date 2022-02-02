<div class="tab-pane fade" id="contact-messages" role="tabpanel">
    <div class="testimonial-area">
        <div class="container">
            <div class="testimonial-active-3 nav-style-2-modify-1 dot-style-1 dot-style-1-center dot-style-1-mt1 wow tmFadeInUp">
                @foreach($messages as $message)
                    <div class="testimonial-plr-1">
                        <div class="single-testimonial">
                            <h4>{{$message->name}}</h4>
                            <p>{{$message->message}}</p>
                            <div class="client-info">
                                <h5>{{$message->email}}</h5>
                                <span>{{$message->phone_number}}</span>
                            </div>
                            <br>
                            <a href="{{action("ContactController@markasRead",['id' => $message->id])}}" id="markasRead">Mark as read</a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
