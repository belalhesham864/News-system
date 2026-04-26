@extends('layout.dashboard.app')

@section('title')
    Edit Post
@endsection

@section('body')
    <div class="container d-flex justify-content-center mt-4">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data"
            class="w-100">
            @csrf
           @method('PUT')
            <div class="card shadow-lg col-lg-10 mx-auto p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Post</h2>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        Back
    </a>
</div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Post Title</label>
                        <input type="text" value="{{ old('title', $post->title) }}" name="title"
                            placeholder="Enter Post Title" class="form-control">
                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Small Description</label>
                        <input type="text" value="{{ old('SmallDesc', $post->SmallDesc) }}" name="SmallDesc"
                            placeholder="Enter Small Description" class="form-control">
                        @error('SmallDesc')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Post Description</label>
                        <textarea name="desc" id="summernote"
                            class="form-control">{!! old('desc', $post->desc) !!}</textarea>
                        @error('desc')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Post Images</label>
                        <input type="file" name="images[]" class="form-control" id="postimage" multiple>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control form-select">
                            @foreach ($categorise as $category)
                                <option @selected($category->id == $post->category_id) value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control form-select">
                            <option selected disabled>-- Select status --</option>
                            <option value="1" @selected($post->status == 1)>Active</option>
                            <option value="0" @selected($post->status == 0)>DesActive</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="form-check">
                            <input @checked($post->comment_able == 1) name="comment_able" type="checkbox"
                                class="form-check-input" id="commentsCheck">
                            <label class="form-check-label" for="commentsCheck">
                                Enable Comments
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info ">
                    Update Post
                </button>
               
            </div>
        </form>
        
    </div>
@endsection

@push('js')
    <script>
        $(function () {

            $('#postimage').fileinput({
                theme: 'fa5',
                showCancel: true,
                allowedFileTypes: ['image'],
                maxFileCount: 5,
                enableResumableUpload: false,
                showUpload: false,
                showPreview: true,
                browseLabel: "Choose Images",
                initialPreviewAsData: true,
                initialPreview: [
                    @if($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            "{{ asset($image->path) }}",
                        @endforeach
                    @endif
                ],
                'initialPreviewConfig': [
                    @if($post->images->count() > 0)
                        @foreach ($post->images as $image){

                            caption: "{{ $image->path }}",
                            key: "{{ $image->id }}",
                            url: "{{ route('admin.posts.deleteimage',[$image->id,'_token'=>csrf_token()]) }}",
                            
                        },
                        @endforeach
                    @endif
                ],


            });

            $('#summernote').summernote({
                placeholder: 'Write your post here...',
                tabsize: 2,
                height: 150
            });

        });
    </script>
@endpush