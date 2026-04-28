@extends('layout.dashboard.app')
@section('title')
    Admins

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
     <p class="mb-4">
    You can manage all Admins here and view their information, control their status, and organize access to the system.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="m-0 font-weight-bold text-primary">Admin Mangment</h6>
                         <a class="modal-effect btn btn-sm btn-info"
                                                href="{{ route('admin.admins.create',['page'=>request()->page]) }}" title="Add">Create Admin<i
                                                class="fa-solid fa-add"></i>
                                            </a>
                </div>
            </div>
            @include('layout.dashboard.filte.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                    <th>#</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($admins as $admin)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                   <td>
                                        @if($admin->status == 1)
                                            <span class="badge badge-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">Blocked</span>
                                        @endif
                                    </td>
        
                                    <td>{{ $admin->created_at?->format('Y-m-d h:i a') }}</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$admin->id}}" title="block"><i
                                                class="fa-solid fa-trash"></i></a>
                                         <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$admin->id}}" title="block"><i
                                                class="fa-solid @if($admin->status==1) fa-ban @else fa-unlock-keyhole @endif"></i></a>
                                        <a class="modal-effect btn btn-sm btn-info"
                                            href="{{ route('admin.admins.show', $admin->id) }}" title="eye"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not Admin found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $admins->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        @foreach ($admins as $admin)


            <div class="modal" id="delete{{$admin->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete admin </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the admin </p>
                                <input disabled name="admin" value="{{ $admin->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        

                   <div class="modal" id="Block{{$admin->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Block admin </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.admins.changestatus', $admin->id) }}" method="post">
                            @csrf

                            <div class="modal-body">
                                @if ($admin->status == 1)
                                    <p>Do You want Block the admin </p>
                                @else
                                    <p>Do You want Actived the admin </p>

                                @endif
                                <input disabled name="admin" value="{{ $admin->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                 @if ($admin->status == 1)
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