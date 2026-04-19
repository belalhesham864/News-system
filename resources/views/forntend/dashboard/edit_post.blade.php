@extends('layout.forntend.app')
@section('title')
    Edit : {{ $post->title }}
@endsection

@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
      @include('forntend.dashboard.sidebar',['porfile_active'=>'active'])

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            <section id="posts-section" class="posts-section">
                <h2>Your Posts</h2>
                <form action="{{ route('forntend.dashboard.post.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" class="form-control mb-2 post-title" name="title"
                                value="{{ $post->title }}" />
                               @error('title')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            <textarea type="text" class="form-control mb-2 post-title" placeholder="Enter small desc" name="SmallDesc"
                                value="{{ $post->SmallDesc ?? '' }}" ></textarea>
                               @error('SmallDesc')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                               <input type="hidden" name="id" value="{{ $post->id }}">
                            <!-- Editable Content -->
                            <textarea id="summernote" name="desc" class="form-control mb-2 post-content">
            {!! $post->desc !!}         
               </textarea>

            @error('desc')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror

                            <!-- Image Upload Input for Editing -->
                            <input id="fileimage" name="images[]" type="file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />
                                @error('images[]')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">
                                @foreach ($categories as $category)

                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>
                                        {{ $category->name }}
                                    </option>

                                @endforeach
                            </select>
  @error('category_id')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" @checked($post->comment_able == 1)
                                    class="form-check-input enable-comments" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>
  @error('comment_able')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fa-solid fa-eye"></i> {{ $post->numer_of_view }}
                                </span>
                                <span class="post-comments">
                                    <i class="fa-solid fa-comment"></i> {{ $post->comment->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                {{-- <button class="btn btn-primary edit-post-btn">Edit</button> --}}

                                <button type="submit" class="btn btn-success save-post-btn ">
                                    Save
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary cancel-edit-btn ">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </form>
            </section>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $('#fileimage').fileinput({
            theme: 'fa5',
            showCancel: true,
            allowedFileTypes: ['image'],
            maxFileCount: 5,
            enableResumableUpload: false,
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: [
                @if ($post->images->count() > 0)
                     @foreach ($post->images as $image)
                         "{{ asset($image->path) }}",
                     @endforeach

                @endif
                       ],
            'initialPreviewConfig': [
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        {
                                caption: "{{ $image->path }}",
                                key: {{ $image->id }},
                                url: "{{ route('forntend.dashboard.post.imagge.delete',[$image->id,'_token'=>csrf_token()]) }}",
                           
                            },
                    @endforeach
                @endif
            ],

        });
        $('#summernote').summernote({
            placeholder: 'Whats on your mind?',
            tabsize: 2,
            height: 300,
        });
    </script>

@endpush