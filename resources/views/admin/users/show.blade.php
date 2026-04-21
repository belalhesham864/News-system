@extends('layout.dashboard.app')

@section('title')
    Show User
@endsection

@section('body')

<div class="container mt-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">User Details</h4>
        </div>

        <div class="card-body">
            <div class="row">

          
                <div class="col-md-4 text-center">
                    <img src="{{ asset($user->image ?? 'assets/dashboard/img/undraw_profile.svg') }}"
                class="img-fluid rounded-circle shadow" style="width: 334.65px; height: 334.65px;">
                </div>

               
                <div class="col-md-8">

                    <h4 class="mb-3">{{ $user->name }}</h4>

                    <p ><strong>Username:</strong> {{ $user->username }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Email Verified:</strong>  @if($user->email_verified_at != null)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Non Active</span>
                        @endif</p>
                    <p><strong>Phone:</strong> {{ $user->phone }}</p>

                    <p>
                        <strong>Status:</strong>
                        @if($user->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Blocked</span>
                        @endif
                    </p>

                    <p><strong>Country:</strong> {{ $user->country ?? 'N/A' }}</p>
                    <p><strong>City:</strong> {{ $user->city ?? 'N/A' }}</p>
                    <p><strong>Street:</strong> {{ $user->street ?? 'N/A' }}</p>

                    <p><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</p>

                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ url()->previous()}}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </div>

</div>

@endsection