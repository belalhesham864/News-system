@extends('layout.forntend.app')
@section('title')
    
@endsection

@section('body')
      <div class="main-news">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            @if ($posts->count()>0)
                
           
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
  @else
<p class="text-center mt-4">
    No results for "<strong>{{ $keyword }}</strong>" 
</p>   

@endif
          </div>
        </div>

    {{ $posts->links() }}    
      </div>
    </div>
  </div>
@endsection