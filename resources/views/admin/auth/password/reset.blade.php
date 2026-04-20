@extends('layout.dashboard.admin');
@section('title')
Reset password    
@endsection
@section('body')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                  
                                    <form action="{{ route('admin.password.reset') }}" method="post" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                               value="{{ $email }}">
                                        </div>
                                       
                                        @if (session()->has('error'))
                                         
                                        @endif
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                                placeholder="Enter New password...">
                                        </div>
                                             @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <input name="password_confirmation" type="password" class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                                placeholder="Enter New password again...">
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <button class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                 
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection