@extends('layout.dashboard.app')

@section('title')
    Notification
@endsection

@section('body')
    <div class="container py-5">

        <div class="mx-auto" style="max-width: 950px;">

          
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Notifications</h2>
                    <p class="text-muted mb-0">Manage all admin notifications</p>
                </div>

                <span class="badge rounded-pill bg-primary px-4 py-2 fs-6 shadow-sm" style="color: white">
                    {{ Auth::guard('admin')->user()->unreadNotifications->count() }}
                    Unread
                </span>
                      <a class="modal-effect btn btn-sm btn-danger"
            data-effect="effect-scale"
            data-toggle="modal"
            href="#deleteAll"
            title="Delete"
          >
Delete All
            <i class="fa-solid fa-trash"></i>
        </a>
            </div>

         
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="card-body bg-light p-4">

                    @forelse ($notifaction as $notifay)

                        <div
                            class="bg-white rounded-4 border shadow-sm p-4 mb-3 transition position-relative">

                    <div class="d-flex justify-content-between align-items-start gap-3">

  
    <div class="flex-grow-1">

        <a href="{{ $notifay->data['link'] }}?notifyadmin={{ $notifay->id }}"
            class="text-decoration-none">

            <h5 class="fw-bold text-dark mb-2">
                {{ $notifay->data['name'] }}
            </h5>

        </a>

        <p class="text-secondary mb-3" style="line-height: 1.8;">
            {{ $notifay->data['title'] }}
        </p>

        <div class="d-flex align-items-center gap-2 text-muted small">
            <i class="fa-regular fa-clock"></i>

            <span>
                {{ $notifay->created_at->diffForHumans() }}
            </span>
        </div>

    </div>

    
    <div class="d-flex align-items-center gap-3" >

       
        @if ($notifay->read_at != null)

            <span class="badge bg-info px-3 py-2 rounded-pill" style="color: white">
                Read
            </span>

        @else

            <span class="badge bg-danger px-3 py-2 rounded-pill"  style="color: white">
                Unread
            </span>

        @endif

     
        <a class="btn btn-light border btn-sm rounded-circle shadow-sm"
            data-effect="effect-scale"
            data-toggle="modal"
            href="#delete{{ $notifay->id }}"
            title="Delete"
            style="width: 42px; height: 42px;">

            <i class="fa-solid fa-trash text-danger"></i>
        </a>

    </div>

</div>

                        </div>
      <div class="modal fade" id="delete{{ $notifay->id }}">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 rounded-4">

                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold">
                                        Delete Notifaction
                                    </h5>

                                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('admin.notifaction.delete',$notifay->id) }}" method="POST">

                                    @csrf
                          

                                    <div class="modal-body">

                                        <div class="alert alert-warning rounded-3">
                                            Are you sure you want to delete this Notifaction?
                                        </div>

                                        <textarea class="form-control" rows="3" disabled>{{ $notifay->data['title'] }}</textarea>

                                    </div>

                                    <div class="modal-footer border-0">

                                        <button type="button" class="btn btn-light" data-dismiss="modal">
                                            Close
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                    @empty

                        <div class="text-center py-5">

                            <div class="mb-3">
                                <i class="fa-regular fa-bell-slash fs-1 text-muted"></i>
                            </div>

                            <h5 class="fw-bold text-muted">
                                No Notifications Yet
                            </h5>

                            <p class="text-secondary mb-0">
                                Any new notifications will appear here.
                            </p>

                        </div>

                    @endforelse
<div class="modal fade" id="deleteAll">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 rounded-4">

                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold">
                                        Delete All Notifaction
                                    </h5>

                                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('admin.notifaction.deleteAll') }}" method="POST">

                                    @csrf
                          

                                    <div class="modal-body">

                                        <div class="alert alert-warning rounded-3">
                                            Are you sure you want to delete All  Notifaction?
                                        </div>

                               
                                    </div>

                                    <div class="modal-footer border-0">

                                        <button type="button" class="btn btn-light" data-dismiss="modal">
                                            Close
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection