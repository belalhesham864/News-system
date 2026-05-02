@extends('layout.dashboard.app')
@section('title')
    Contact

@endsection
@section('body')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Contact</h1>
     <p class="mb-4">
    You can manage all Contact here and view their information, control their status, and organize access to the system.
</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Mangment</h6>
            </div>
            @include('admin.contact.filte.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                             
                                <th>User Name</th>
                                <th>User Email</th>
                             <th>Title</th>
                             <th>Status</th>
                              
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                             
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Title</th>
                                  <th>Status</th>
                              
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @forelse ($contatcs as $contact)


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{$contact->email }}</td>
                                    <td>{{ $contact->title}}</td>
                                     <td>
                                        @if($contact->status==0)
                                        <div class="btn btn-danger"> UnRead</div>
                                        @else
                                        <div class="btn btn-info"> Read</div>
                                        @endif
                                     </td>

                                    <td>{{ $contact->created_at }}</td>
                                    <td>

    

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{$contact->id}}" title="delete"><i
                                                class="fa-solid fa-trash"></i></a>

     
                                             
                                        <a class="modal-effect btn btn-sm btn-info"
                                            href="{{ route('admin.Contact.show', [$contact->id,'page'=>request()->page]) }}" title="show"><i
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
                   {{ $contatcs->appends(request()->input())->links() }}
                  
                </div>
            </div>
        </div>
        @foreach ($contatcs as $contact)


            <div class="modal" id="delete{{$contact->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Delete Contact </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.Contact.destory', $contact->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p>Do You want Delete the Contact </p>
                                <input disabled name="Contact" value="{{ $contact->title }}">
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