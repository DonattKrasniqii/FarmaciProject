@extends('layouts.app')
@section('ogImage')
    <meta property="og:title" content="{{$blog->name}}"/>
    <meta property="og:site_name" content="{{$blog->name}}"/>
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{asset($blog->image_path)}}"/>
    <meta property="og:description" content="{!! strip_tags($blog->description) !!}"/>
    <meta property="og:url" content="{{action('BlogController@viewBlog',$blog->id)}}"/>
@endsection
@section('content')
    <div class="blog-details-area padding-30-row-col pt-75 pb-75">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details-top-content">
                            <h1>{{$blog->name}}</h1>
                            <div class="blog-meta-3">
                                <ul>
                                    <li>
                                        <i class="far fa-calendar"></i> {{\Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <img class="img-fluid mb-20" src="{{asset('http://127.0.0.1:100'.$blog->image_path)}}" alt="">
                        <div class="blog-details-column mt-20">
                            {!! $blog->description !!}
                        </div>
                        <div class="blog-tag-share-wrap">
                            <div class="blog-tag-wrap">
                            </div>
                            <div class="blog-share-wrap">
                                <div class="blog-share-content">
                                    <span>{{__('Shpërndaje')}}</span>
                                </div>
                                <div class="blog-share-icon">
                                    <span class="fas fa-share-alt"></span>
                                    <div class="blog-share-list tooltip-style-4 blog-share-right-0">
                                        <a aria-label="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://barnatore-online.com/blog/view/{{$blog->id}};src=sdkpreparse"><i class="fab fa-facebook-f"></i></a>
                                        <a aria-label="Twitter" href="#"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-wrapper sidebar-wrapper-mr1">
                        <div class="sidebar-widget sidebar-widget-wrap sidebar-widget-padding-2 mb-20">
                            <h4 class="sidebar-widget-title">{{__('Të rejat')}}</h4>
                            <div class="sidebar-post-wrap mt-30">
                                @foreach($drugs as $drug)
                                    <div class="single-sidebar-post">
                                        <div class="sidebar-post-img">
                                            <a href="{{action('DrugsController@viewDrug',$drug->id)}}">
                                                <img src="{{asset($drug->mainImagePath())}}" alt="">
                                            </a>
                                        </div>
                                        <div class="sidebar-post-content">
                                            <h4><a href="{{action('DrugsController@viewDrug',$drug->id)}}">{{$drug->name}}</a></h4>
                                            <span>{{$drug->headline}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
