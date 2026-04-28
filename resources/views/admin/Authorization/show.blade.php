@extends('layout.dashboard.app')

@section('title')
    Show Admin
@endsection

@section('body')

<div class="container mt-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">admin Details</h4>
        </div>

        <div class="card-body">
            <div class="row">

          
              
                <div class="col-md-4 text-center">
                    <img src="{{ asset($admin->image ?? 'assets/dashboard/img/undraw_profile.svg') }}"
                class="img-fluid rounded-circle shadow" style="width: 334.65px; height: 334.65px;">
                </div>
               
                <div class="col-md-8">

                    <h4 class="mb-3">{{ $admin->name }}</h4>

                  
                    <p><strong>UserName:</strong> {{ $admin->username }}</p>
                
                    <p><strong>Phone:</strong> {{ $admin->phone }}</p>

                    <p>
                        <strong>Status:</strong>
                        @if($admin->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Blocked</span>
                        @endif
                    </p>

                    <p><strong>Joined:</strong> {{ $admin->created_at->format('Y-m-d') }}</p>

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