@extends('layout.dashboard.app')

@section('title')
    Change Password
@endsection


@section('body')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                
                <div class="card-header bg-gradient bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0">Change Password</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.admins.UpdatePassword') }}" method="POST">
                        @csrf
                       
                        <div class="row g-4">

              <input type="hidden" value="{{ $id }}" name="id">
                     
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Current Password</label>
                                <input type="password" name="password_current" class="form-control form-control-lg">
                                @error('password_current')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">New Password</label>
                                <input type="password" name="password" class="form-control form-control-lg">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                           
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg">
                            </div>

                        </div>

                        <div class=" mt-4 text-end">
                            <button type="submit" class="btn btn-success px-5 py-2 rounded-3">
                                Update Password
                            </button>
                      
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection