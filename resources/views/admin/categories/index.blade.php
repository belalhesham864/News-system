@extends('layout.dashboard.app')
@section('title')
    Categories

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
<p class="mb-4">
    You can manage all categories here and add a description for each category to clarify its content and better organize your posts.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Categories Mangment</h6>
                 <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-toggle="modal" href="#Add_Category" title="Add Category">Add Category<i
                                                class="fa-solid fa-plus"></i></a>
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                             <ul class="mb-0">

                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                </div>
                                                @endif
            </div>
            @include('layout.dashboard.filte.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Posts Count</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Posts Count</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($Categories as $Category)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $Category->name }}</td>
                                    <td>{{ $Category->posts_count }}</td>
                               
                                    <td>
                                        @if($Category->status == 1)
                                            <span class="badge badge-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">Not Active</span>
                                        @endif
                                    </td>

                                    <td>{{ $Category->created_at }}</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$Category->id}}" title="Delete"><i
                                                class="fa-solid fa-trash"></i></a>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-toggle="modal" href="#Edit{{$Category->id}}" title="Edit"><i
                                                class="fa-solid fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$Category->id}}" title="block"><i
                                                class="fa-solid @if($Category->status==1) fa-ban @else fa-unlock-keyhole @endif"></i></a>
                                   
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not Category found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $Categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

        {{-- Modal ADD New Category --}}
          <div class="modal fade" id="Add_Category" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Add Category</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="SmallDesc" class="form-control" placeholder="Enter description">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option disabled selected>-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">deactivate</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>

            </form>

        </div>
    </div>
</div>
        @foreach ($Categories as $Category)

  {{-- Modal Delete Category --}}
            <div class="modal" id="delete{{$Category->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete Category </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.categories.destroy', $Category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the Category </p>
                                <input disabled name="Category" value="{{ $Category->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
  {{-- Modal Edit Category --}}
            <div class="modal" id="Edit{{$Category->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Category </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.categories.update', $Category->id) }}" method="post">
                            @csrf
                                         @method('PUT')

                            <div class="modal-body">
                                         <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" value="{{ $Category->name }}" class="form-control" placeholder="Enter category name" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="SmallDesc" value="{{ $Category->SmallDesc }}" class="form-control" placeholder="Enter description">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option disabled selected >-- Select Status --</option>
                            <option value="1" {{ $Category->status==1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ $Category->status==0 ? 'selected' : ''}}>deactivate</option>
                        </select>
                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
              {{-- Modal Block Category --}}
            <div class="modal" id="Block{{$Category->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Active </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.category.changestatus', $Category->id) }}" method="post">
                            @csrf

                            <div class="modal-body">
                                @if ($Category->status == 1)
                                    <p>Do You want deactivate the Category </p>
                                @else
                                    <p>Do You want Actived the Category </p>

                                @endif
                                <input disabled name="Category" value="{{ $Category->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                 @if ($Category->status == 1)
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