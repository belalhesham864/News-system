@extends('layout.dashboard.app')

@section('title')
403 - Forbidden
@endsection

@section('body')

<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="text-center">

        <i class="fa fa-ban text-danger" style="font-size: 60px;"></i>
        <h1 class="display-1 fw-bold text-danger">403</h1>

        <p class="fs-3">
            <span class="text-danger">Oops!</span> Access Denied
        </p>

        <p class="lead text-muted">
            You don't have permission to access this page.
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