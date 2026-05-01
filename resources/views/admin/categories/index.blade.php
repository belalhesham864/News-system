@extends('layout.dashboard.app')
@section('title')
    Categories

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
        <p class="mb-4">
            You can manage all categories here and add a description for each category to clarify its content and better
            organize your posts.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Categories Mangment</h6>
               @can('Add_categories')
                   
               <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
               href="#Add_Category" title="Add Category">Add Category<i class="fa-solid fa-plus"></i></a>
               @endcan
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
@can('delete_categories')
    

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$Category->id}}" title="Delete"><i
                                                class="fa-solid fa-trash"></i></a>

@endcan
@can('Edit_categories')
    

                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-toggle="modal" href="#Edit{{$Category->id}}" title="Edit"><i
                                                class="fa-solid fa-edit"></i></a>
                                                @endcan
                                         @can('Block_categories')
                                             
                                       
                                        <a class="modal-effect btn btn-sm btn-secondary" data-effect="effect-scale"
                                            data-toggle="modal" href="#Block{{$Category->id}}" title="block"><i
                                                class="fa-solid @if($Category->status == 1) fa-ban @else fa-unlock-keyhole @endif"></i></a>
   @endcan 
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
        @include('admin.categories.add')
        @foreach ($Categories as $Category)

            {{-- Modal Delete Category --}}
            @include('admin.categories.delete')
            {{-- Modal Edit Category --}}
            @include('admin.categories.edit')
            {{-- Modal Block Category --}}
            @include('admin.categories.block')
        @endforeach
    </div>
@endsection