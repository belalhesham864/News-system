@extends('layout.dashboard.app')
@section('title')
    Users

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
     <p class="mb-4">
    You can manage all users here and view their information, control their status, and organize access to the system.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Mangment</h6>
            </div>
            @include('layout.dashboard.filte.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($users as $user)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>@if($user->image)

                                        <img src="{{ asset($user->image) }}"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @else
                                            <img src="{{ asset('assets/dashboard/img/undraw_profile.svg') }}"
                                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge badge-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">Blocked</span>
                                        @endif
                                    </td>

                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
@can('delete_User')
    

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$user->id}}" title="block"><i
                                                class="fa-solid fa-trash"></i></a>
@endcan

@can('edit_User')
    

                                        <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$user->id}}" title="block"><i
                                                class="fa-solid @if($user->status==1) fa-ban @else fa-unlock-keyhole @endif"></i></a>
@endcan
@can('show_User')
    

                                        <a class="modal-effect btn btn-sm btn-info"
                                            href="{{ route('admin.users.show', $user->id) }}" title="eye"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
@endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not user found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        @foreach ($users as $user)


            <div class="modal" id="delete{{$user->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete User </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the user </p>
                                <input disabled name="user" value="{{ $user->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
            <div class="modal" id="Block{{$user->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Block User </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.user.block', $user->id) }}" method="post">
                            @csrf

                            <div class="modal-body">
                                @if ($user->status == 1)
                                    <p>Do You want Block the user </p>
                                @else
                                    <p>Do You want Actived the user </p>

                                @endif
                                <input disabled name="user" value="{{ $user->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                 @if ($user->status == 1)
                                <button type="submit" class="btn btn-secondary">Block</button> 
                                @else
                                <button type="submit" class="btn btn-success">Active</button> 
@endif
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        @endforeach
    </div>
@endsection