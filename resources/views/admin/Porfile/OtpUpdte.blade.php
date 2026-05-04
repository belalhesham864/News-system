@extends('layout.dashboard.app')

@section('title')
    OTP
@endsection


@section('body')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                
                <div class="card-header bg-gradient bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0">OTP</h4>
                </div>

                <div class="card-body p-4">

                 <form action="{{ route('admin.porfile.verifayotp') }}" method="post" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                               value="{{ $email }}">
                                        </div>
                                       
                                        @if (session()->has('error'))
                                         
                                        @endif
                                          
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
                </div>
            </div>

        </div>
    </div>
</div>

@endsection