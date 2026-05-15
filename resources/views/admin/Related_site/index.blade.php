@extends('layout.dashboard.app')
@section('title')
    Related site mangment

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Related_site</h1>
        <p class="mb-4">
            You can manage all Related site here and add a description for each category to clarify its content and better
            organize your posts.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Related site Mangment</h6>
       
                   
               <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
               href="#Realted_site" title="Add Realted_site">Add Realted site<i class="fa-solid fa-plus"></i></a>
             
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

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                                     <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                               
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($Realted_site as $R)
         

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $R->name }}</td>
                                    <td>{{ $R->url }}</td>

                                    <td>{{ $R->created_at }}</td>
                                    <td>

    

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$R->id}}" title="Delete"><i
                                                class="fa-solid fa-trash"></i></a>


    

                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-toggle="modal" href="#Edit{{$R->id}}" title="Edit"><i
                                                class="fa-solid fa-edit"></i></a>
                                         
                                             
                                       
                                       

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="alert alert-info">Not Realted_site found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>

        {{-- Modal ADD New Category --}}
        @include('admin.Related_site.add')
        @foreach ($Realted_site as $R)

            {{-- Modal Delete Category --}}
@include('admin.Related_site.delete')
            {{-- Modal Edit Category --}}
            @include('admin.Related_site.edit')
          
           
        @endforeach
    </div>
@endsection