@extends('layout.dashboard.app')
@section('title')
    Create User
@endsection
@section('body')
  <center>
      <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body shadow mb-4 col-10">
            <h2>Create New User</h2><br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Enter User Name" class="form-control">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter User UserName" class="form-control">
                    </div>
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter User Email" class="form-control">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Enter User phone" class="form-control">
                    </div>
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option selected disabled>Select Stauts</option>
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>

                        </select>
                    </div>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select name="email_verified_at" id="" class="form-control">
                            <option selected disabled>Select Email Status</option>
                            <option value="1">Verified</option>
                            <option value="0">Not Verified</option>

                        </select>
                    </div>
                </div>
                @error('email_verified_at')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="country" placeholder="Enter Country Name" class="form-control">
                    </div>
                    @error('country')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="city" placeholder="Enter City Name" class="form-control">
                    </div>
                    @error('city')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="street" placeholder="Enter Street Name" class="form-control">
                    </div>
                    @error('street')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Upload User Image" class="form-control-file">
                    </div>
                </div>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter User password" class="form-control">
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Enter User password again" class="form-control">
                    </div>
                
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
            </div>
            <br>
            <button type="submit" class="btn btn-info">Add User</button>
        </div>
    </form>
  </center>
@endsection