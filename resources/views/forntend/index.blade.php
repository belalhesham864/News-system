@extends('layout.forntend.app')
@section('title')
Home
@stop
@section('breadcrumb')
  @parent

@endsection
@section('body')

  <div class="top-news">
    <div class="container">
      <div class="row">
        <div class="col-md-6 tn-left">
          <div class="row tn-slider">
            @foreach ($latest_three as  $post)
            
            <div class="col-md-6">
              <div class="tn-img">
               <img src="{{ $post->images->first()->path}}" />
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a>
                </div>
              </div>
            </div>
            @endforeach
         
          </div>
        </div>
        <div class="col-md-6 tn-right">
          <div class="row">
            @foreach ($latest_four as $post )
             <div class="col-md-6">
              <div class="tn-img">
                <img src="{{$post->images->first()->path }}" />
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a>
                </div>
              </div>
            </div>
            
            @endforeach
           
     
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Top News End-->

  <!-- Category News Start-->
  <div class="cat-news">
    <div class="container">
      <div class="row">
       @foreach ($categories_with_posts as $categoriy )
        <div class="col-md-6">
          <h2>{{$categoriy->name}}</h2>
          <div class="row cn-slider">
          @foreach ($categoriy->posts as  $post)
              <div class="col-md-6">
              <div class="cn-img">
                <img src="{{ $post->images->first()->path }}" />
                <div class="cn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a>
                </div>
              </div>
            </div>
          @endforeach
            
          </div>
        </div>
       
       @endforeach
      
      </div>
    </div>
  </div>
  <!-- Category News End-->



  <!-- Tab News Start-->
  <div class="tab-news">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#oldest">oldest News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
            </li>
           
          </ul>

          <div class="tab-content">
            <div id="oldest" class="container tab-pane active">
          @foreach ($oldest_news as $post )
              <div class="tn-news">
                <div class="tn-img">
                  <img src="{{ $post->images->first()->path }}" />
                </div>
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{$post->title}}</a>
                </div>
              </div>
          
          @endforeach
           
            </div>


@php
  $greats_post_comment=$greats_post_comment->take(3);
@endphp
            <div id="popular" class="container tab-pane fade">
           @foreach ($greats_post_comment as $post )
              <div class="tn-news">
                <div class="tn-img">
                  <img src="{{$post->images->first()->path}}" />
                </div>
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{$post->title}} ({{ $post->comment_count }})</a>
                </div>
              </div>
           
           @endforeach
           
            </div>
            
          </div>
        </div>

        <div class="col-md-6">
          <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
            </li>
           
          </ul>

          <div class="tab-content">
            <div id="m-viewed" class="container tab-pane active">
          @foreach ($latest_three as $last )
              <div class="tn-news">
                <div class="tn-img">
                  <img src="{{ $last->images->first()->path }}" />
                </div>
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$last->slug) }}">{{ $last->title }}</a>
                </div>
              </div>
            
          @endforeach
            
            </div>
            <div id="m-read" class="container tab-pane fade">
            @foreach ($greats_view as $post )
                <div class="tn-news">
                <div class="tn-img">
                  <img src="{{ $post->images->first()->path }}" />
                </div>
                <div class="tn-title">
                  <a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }} ({{ $post->numer_of_view }})</a>
                </div>
              </div>
            @endforeach
           
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Tab News Start-->

  <!-- Main News Start-->
  <div class="main-news">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            @foreach ($posts as $post)
              <div class="col-md-4">
                <div class="mn-img">
                  <img src="{{ $post->images->first()->path }}" />
                  <div class="mn-title">
                    <a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          {{ $posts->links() }}
        </div>

        <div class="col-lg-3">
          <div class="mn-list">
            <h2>Read More</h2>
            <ul>
              @foreach ($read_post_more as $post )
                
              <li><a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a></li>
              @endforeach
     
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection