@extends('layout.dashboard.app')
@section('title')
    Roles

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Roles</h1>
     <p class="mb-4">
    You can manage all Roles here and view their information, control their status, and organize access to the system.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="m-0 font-weight-bold text-primary">Roles Mangment</h6>
                         <a class="modal-effect btn btn-sm btn-info"
                                                href="{{ route('admin.authorization.create',['page'=>request()->page]) }}" title="Add">Create Role<i
                                                class="fa-solid fa-add"></i>
                                            </a>
                </div>
            </div>
        
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                               
                                <th>permessions</th>
                                <th>Created At</th>
                                     <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                  <th>#</th>
                                <th>Role Name</th>
                               
                                <th>permessions</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($authorization as $auth)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $auth->role }}</td>
                                    <td>
                                    @forelse ($auth->permessions as $permession )
                                        {{ $permession }} ,
                                    @empty
                                            <td colspan="6" class="alert alert-info">Not permession found</td>
                                    @endforelse
                                    
                                 </td>
                    
                                    <td>{{ $auth->created_at?->format('Y-m-d h:i a') }}</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$auth->id}}" title="block"><i
                                                class="fa-solid fa-trash"></i></a>
                                      
                                        <a class="modal-effect btn btn-sm btn-info"
                                            href="{{ route('admin.authorization.show', $auth->id) }}" title="eye"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not Role found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $authorization->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        @foreach ($authorization as $auth)


            <div class="modal" id="delete{{$auth->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete Role </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.authorization.destroy', $auth->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the Role </p>
                                <input disabled name="Role" value="{{ $auth->role }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        

          
        @endforeach
    </div>
@endsection