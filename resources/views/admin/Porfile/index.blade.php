@extends('layout.dashboard.app')

@section('title')
    Profile
@endsection


@section('body')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                
                <div class="card-header bg-gradient bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0">Update Profile</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.porfile.otp',$admin->id) }}" method="POST">
                        @csrf
                       
                        <div class="row g-4">

                         
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" value="{{ $admin->name }}" class="form-control form-control-lg">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                          
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" name="username" value="{{ $admin->username }}" class="form-control form-control-lg">
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                    
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ $admin->email }}" class="form-control form-control-lg">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                   

                     
                           

                        </div>

                        <div class=" d-flex justify-content-between align-items-center mt-4 text-end">
                            <button type="submit" class="btn btn-success px-5 py-2 rounded-3">
                                Update
                            </button>
                            <a href="{{ route('admin.porfile.ChangePassword') }}">
                                Change Password
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection