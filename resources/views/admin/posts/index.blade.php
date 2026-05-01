@extends('layout.dashboard.app')
@section('title')
    Posts

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts</h1>
     <p class="mb-4">
    You can manage all Posts here and view their information, control their status, and organize access to the system.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts Mangment</h6>
            </div>
            @include('layout.dashboard.filte.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>numer of view</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>numer_of_view</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($posts as $post)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{$post->category->name }}</td>
                                    <td>{{ $post->admin->name ?? $post->user->name }}</td>
                                    <td>{{$post->numer_of_view }}</td>
                                    <td>
                                        @if($post->status == 1)
                                            <span class="badge badge-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">disactive</span>
                                        @endif
                                    </td>

                                    <td>{{ $post->created_at }}</td>
                                    <td>
@can('delete_post')
    

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$post->id}}" title="block"><i
                                                class="fa-solid fa-trash"></i></a>
@endcan
@can('block_post')
    

                                        <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$post->id}}" title="block"><i
                                                class="fa-solid @if($post->status==1) fa-ban @else fa-unlock-keyhole @endif"></i></a>
                                                @endcan         
                                                @if ($post->admin_id==auth('admin')->id())
                                                <a class="modal-effect btn btn-sm btn-info"
                                                href="{{ route('admin.posts.edit', $post->id) }}" title="edit"><i
                                                class="fa-solid fa-edit"></i>
                                            </a>
                                            @endif
                                        <a class="modal-effect btn btn-sm btn-info"
                                            href="{{ route('admin.posts.show', [$post->id,'page'=>request()->page]) }}" title="show"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not Posts found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                   {{ $posts->appends(request()->input())->links() }}
                  
                </div>
            </div>
        </div>
        @foreach ($posts as $post)


            <div class="modal" id="delete{{$post->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete post </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the post </p>
                                <input disabled name="post" value="{{ $post->title }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
            <div class="modal" id="Block{{$post->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Block post </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.posts.changestatus', $post->id) }}" method="post">
                            @csrf

                            <div class="modal-body">
                                @if ($post->status == 1)
                                    <p>Do You want Disactive the post </p>
                                @else
                                    <p>Do You want Actived the post </p>

                                @endif
                                <input disabled name="post" value="{{ $post->title }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                 @if ($post->status == 1)
                                <button type="submit" class="btn btn-secondary">Disactive</button> 
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