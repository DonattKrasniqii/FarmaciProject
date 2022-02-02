@extends('layouts.app')
@section('content')
    <div class="blog-area pt-75 pb-75">
        <div class="container">
            <div class="row grid">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-12 col-sm-6 grid-item wow tmFadeInUp">
                        <div class="blog-wrap-2 mb-30">
                            <div class="blog-img-2">
                                <a href="{{action('BlogController@viewBlog',['id'=>$blog->id])}}">
                                    <img src="{{asset('http://127.0.0.1:100'.$blog->image_path)}}" class="img-fluid" alt="{{$blog->name}}">
                                </a>
                            </div>
                            <div class="blog-content-2">
                                <div class="blog-meta-2">
                                    <ul>
                                        <li>
                                            <i class="far fa-calendar"></i> {{\Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}
                                        </li>
                                    </ul>
                                </div>
                                <h3>
                                    <a href="{{action('BlogController@viewBlog',['id'=>$blog->id])}}">{{$blog->name}}</a>
                                </h3>
                                <div class="blog-btn">
                                    <a href="{{action('BlogController@viewBlog',['id'=>$blog->id])}}">{{__('Më shumë')}} <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
{{--            <div class="pro-pagination-style text-center">--}}
{{--                {{ $blogs->onEachSide(2)->links('vendor.pagination.default') }}--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
