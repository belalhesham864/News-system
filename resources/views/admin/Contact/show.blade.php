@extends('layout.dashboard.app')

@section('title')
    Show Contact
@endsection

@section('body')

<div class="container mt-5">

    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <!-- Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Contact Details</h5>
            <span class="badge bg-light text-dark">
                {{ $contact->created_at->diffForHumans() }}
            </span>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <div class="row g-4">

                <!-- Left (Avatar + Basic Info) -->
                <div class="col-md-4 text-center border-end">
                    <div class="mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 80px; height: 80px; font-size: 30px;">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                    </div>

                    <h5>{{ $contact->name }}</h5>
                    <p class="text-muted mb-1">{{ $contact->email }}</p>
                    <p class="text-muted">{{ $contact->phone }}</p>
                </div>

                <!-- Right (Details) -->
                <div class="col-md-8">

                    <div class="mb-3">
                        <label class="text-muted small">Title</label>
                        <p class="fw-bold">{{ $contact->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small">Message</label>
                        <div class="bg-light p-3 rounded">
                            {{ $contact->body }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted small">IP Address</label>
                            <p class="fw-bold">{{ $contact->ip_address }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Created At</label>
                            <p class="fw-bold">
                                {{ $contact->created_at->diffForHumans()}}
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Footer -->
        <div class="card-footer bg-white text-end">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                Back
            </a>
        </div>

    </div>

</div>

@endsection