@extends('layout.dashboard.app')

@section('title')
    Show Post
@endsection

@section('body')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <h2 class="fw-bold mb-3">{{ $post->title }}</h2>

             
            <div class="d-flex align-items-center mb-3">
                <img 
                    src="{{ $post->user->image ?? asset('assets/dashboard/img/undraw_profile.svg') }}"
                    class="rounded-circle me-2"
                    style="width:45px;height:45px;object-fit:cover;"
                >
                <div>
                    <div class="fw-bold">
                      <a href="{{ route('admin.users.show',$post->user->id) }}"> {{ $post->user->name ?? $post->admin->name }}</a>
                    </div>
                    <small class="text-muted">
                        {{ $post->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
<div class="d-flex align-items-center gap-3 mb-3 text-muted small">

    <div class="d-flex align-items-center gap-1">
        <i class="fa fa-eye"></i>
        <span>{{ $post->numer_of_view}} views</span>
    </div>



</div>
            <div id="newsCarousel" class="carousel slide mb-4" data-ride="carousel">
                <div class="carousel-inner rounded shadow">

                    @foreach ($post->images as $image)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img 
                                src="{{ asset($image->path) }}"
                                class="d-block w-100"
                                style="height:450px;object-fit:cover;"
                            >
                        </div>
                    @endforeach

                </div>

                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div class="bg-white p-4 rounded shadow-sm mb-4" style="line-height:1.9;">
                {!! $post->desc !!}
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-dark px-4">
                     Back
                </a>
                <a data-effect="effect-scale" data-toggle="modal" href="#delete{{$post->id}}" class="btn btn-outline-dark px-4">
                  <i class="fa fa-trash"></i>   Delete
                </a>
            </div>
         
        </div>
    </div>
          <div class="modal" id="delete{{$post->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete post </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the post </p>
                                <input disabled name="post" value="{{ $post->title }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
</div>

@endsection