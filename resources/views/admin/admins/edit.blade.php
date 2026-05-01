@extends('layout.dashboard.app')
@section('title')
    Edit Admin
@endsection
@section('body')
 <div class="d-flex justify-content-center">
         <form action="{{ route('admin.admins.update',$admin->id) }}" method="post" >
            @csrf
            @method('PUT')
            <div class="card-body shadow mb-4 " style="min-width: 80ch"> 
<div class="d-flex justify-content-between align-items-center">
                    <h2>Edit Admin</h2>

    <a href="{{ url()->previous() }}" class="modal-effect btn btn-sm btn-secondary" >Back</a>
</div>                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="name" value="{{ $admin->name }}" placeholder="Enter Admin Name" class="form-control">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="username" value="{{ $admin->username }}" placeholder="Enter Admin UserName" class="form-control">
                        </div>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" name="email" value="{{ $admin->email }}" placeholder="Enter Admin Email" class="form-control">
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" id="" class="form-control">
                                <option selected disabled>Select Stauts</option>
                                <option @selected($admin->status==1) value="1">Active</option>
                                <option @selected($admin->status==0) value="0">Blocked</option>

                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


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
 <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="role_id" id="" class="form-control">
                                
                                
                                <option selected disabled>Select Role</option>
                                @forelse ($roles as $role )
                                <option @selected($admin->role_id==$role->id) value="{{ $role->id }}">{{$role->role}}</option>
                                @empty
                                <option value="" disabled selected>No Roles</option>
                                @endforelse
                            

                            </select>
                        </div>
                        @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <br>
                <button type="submit" class="btn btn-info">Update Admin</button>
            </div>
        </form>
 </div>
@endsection