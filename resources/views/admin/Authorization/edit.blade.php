@extends('layout.dashboard.app')
@section('title')
    Edit Role
@endsection

@section('body')
<div class="d-flex justify-content-center mt-4">
    <form action="{{ route('admin.authorization.update',$role->id) }}" method="post">
        @csrf
   @method('PUT')
        <div class="card shadow-lg border-0 rounded-3" style="min-width: 85ch;">
            <div class="card-body p-4">

               
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">    Edit Role
</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                        Back
                    </a>
                </div>

      
                <div class="mb-4">
                    <label class="form-label fw-semibold">Role Name</label>
                    <input type="text" name="name" value="{{ $role->role }}"  placeholder="Enter Role Name" class="form-control form-control-lg">
                    
                    @error('name')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>
@php
$rolePermissions=is_array($role->permessions) ? $role->permessions : json_decode($role->permessions,true);
@endphp
                <div class="mb-4">
                    <label class="form-label fw-semibold mb-2">Permissions</label>

                    <div class="row">
                        @foreach (config('authorization.permessions') as $key=>$value )
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        value="{{ $key }}" 
                                        name="permision[]"
                                        id="perm_{{ $key }}"
                                        @checked(in_array($key,$rolePermissions)??[] )
                                    >
                                    <label class="form-check-label" for="perm_{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @error('permision')
                        <div class="text-danger mt-2 small">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="text-end">
                    <button type="submit" class="btn btn-info px-4 py-2">
                        Update Role
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection