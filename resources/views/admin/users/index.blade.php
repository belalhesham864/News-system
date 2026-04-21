@extends('layout.dashboard.app');
@section('title')
    Users

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            {{-- <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="from-group">
                         <select >
                            <option value="id">Id</option>
                            <option value="name">Name</option>
                            <option value="created_at">Created_at</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                         <select >
                            <option value="as">Acs</option>
                            <option value="desc">Des</option>
                       
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                         <select >
                            <option value="">Id</option>
                            <option value="">Name</option>
                            <option value="">Created_at</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                         <select >
                            <option value="">Id</option>
                            <option value="">Name</option>
                            <option value="">Created_at</option>
                         </select>
                        </div>
                    </div>
                     <div class="col-2">
                        <div class="from-group">
                      <input type="text" placeholder="Search here..." name="search">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                        <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                   
                </div>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
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
                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge badge-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge badge-danger px-3 py-2">Non Active</span>
                                        @endif
                                    </td>

                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$user->id}}" title="block"><i
                                                class="fa-solid fa-trash"></i></a>
                                        <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$user->id}}" title="block"><i class="fa-solid fa-ban"></i></a>
                                        <a class="modal-effect btn btn-sm btn-info" href="{{ route('admin.users.show',$user->id) }}" title="eye"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not user found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
@foreach ($users as $user)
    

         <div class="modal" id="delete{{$user->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete User </h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="#" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Do You sure Delete </p>
                                        <input disabled name="user" value="{{ $user->name }}" >
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
                                    <h6 class="modal-title">Block User </h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="#" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Do You sure Block </p>
                                        <input disabled name="user" value="{{ $user->name }}" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-secondary">Block</button>
                                    </div>
                            </div>
                            </form>
	
                        </div>
                    </div>
                    @endforeach
    </div>
@endsection