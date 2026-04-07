@extends('layout.forntend.app')
@section('title')
    posts
@endsection

@section('body')
<br>
<br>
        <div class="main-news">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="row">
          @forelse ($posts as $post )
              <div class="col-md-4">
                <div class="mn-img">
                  <img src="{{ $post->images->first()->path }}" />
                  <div class="mn-title">
                    <a href="{{ route('forntend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                  </div>
                </div>
              </div>
              
          @empty
              <div class="alert-info">
                Category is empty
              </div>
          @endforelse
        </div>
       {{ $posts->links() }}
          </div>

          <div class="col-lg-3">
            <div class="mn-list">
              <h2>other categories</h2>
              <ul>
                @foreach ($categories as $category )
                
                <li><a href="{{ route('forntend.category.posts',$category->slag) }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection