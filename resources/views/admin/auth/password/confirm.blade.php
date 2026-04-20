@extends('layout.dashboard.admin');
@section('title')
Confirm Password
@stop
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
                                    <div class="text-center">
                                        <p class="mb-4">
                                         Enter your email and Otp send in email</p>
                                    </div>
                                  
                                    <form action="{{ route('admin.password.VerifayOtp') }}" method="post" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                value="{{ $email }}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input name="code" type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter OtpCode send Address...">
                                        </div>
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <button class="btn btn-primary btn-user btn-block">
                                            Confirm Password
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