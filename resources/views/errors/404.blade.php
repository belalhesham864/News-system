@extends('layout.dashboard.app')

@section('title')
404 - Not Found
@endsection

@section('body')

<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="text-center">

        <h1 class="display-1 fw-bold text-warning">404</h1>

        <p class="fs-3">
            <span class="text-warning">Oops!</span> Page Not Found
        </p>

        <p class="lead text-muted">
            The page you are looking for doesn’t exist or has been moved.
        </p>

          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">
            Go Back
        </a>

        <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary mt-3">
            Home
        </a>

    </div>
</div>

@endsection