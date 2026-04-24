@extends('layout.dashboard.app')

@section('title')
    Create Post
@endsection

@section('body')
<div class="container d-flex justify-content-center mt-4">
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data" class="w-100">
        @csrf

        <div class="card shadow-lg col-lg-10 mx-auto p-4">
            <h2 class="mb-4 text-center">Create New Post</h2>
@if ($errors->any())
<div class="text-danger">
    <ul class="mb-04">

        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    
@endif
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Post Title</label>
                    <input type="text" name="title" placeholder="Enter Post Title" class="form-control">
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Small Description</label>
                    <input type="text" name="SmallDesc" placeholder="Enter Small Description" class="form-control">
                    @error('SmallDesc')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label">Post Description</label>
                    <textarea name="desc" id="summernote" class="form-control"></textarea>
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
                        <option selected disabled>-- Select Category --</option>
                        @foreach ($categorise as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                       <option value="1">Active</option>
                       <option value="0">DesActive</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-check">
                        <input name="comment_able" type="checkbox" class="form-check-input" id="commentsCheck">
                        <label class="form-check-label" for="commentsCheck">
                            Enable Comments
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-info w-100">
                Create Post
            </button>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    $(function(){

        $('#postimage').fileinput({
            theme: 'fa5',
            showCancel: true,
            allowedFileTypes: ['image'],
            maxFileCount: 5,
            enableResumableUpload: false,
            showUpload: false,
            showPreview: true,
            browseLabel: "Choose Images"
        });

        $('#summernote').summernote({
            placeholder: 'Write your post here...',
            tabsize: 2,
            height: 150
        });

    });
</script>
@endpush