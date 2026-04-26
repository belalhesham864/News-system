@extends('layout.dashboard.app')
@section('title')
    Create Admin
@endsection
@section('body')
 <div class="d-flex justify-content-center">
         <form action="{{ route('admin.admins.store') }}" method="post" >
            @csrf
            <div class="card-body shadow mb-4 " style="min-width: 80ch"> 
<div class="d-flex justify-content-between align-items-center">
                    <h2>Create New Admin</h2>

    <a href="{{ url()->previous() }}" class="modal-effect btn btn-sm btn-secondary" >Back</a>
</div>                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter Admin Name" class="form-control">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Enter Admin UserName" class="form-control">
                        </div>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter Admin Email" class="form-control">
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
                                <option value="1">Active</option>
                                <option value="0">Blocked</option>

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

                <br>
                <button type="submit" class="btn btn-info">Add Admin</button>
            </div>
        </form>
 </div>
@endsection