@extends('layout.forntend.app')
@section('title')
    Notifications
@endsection

@section('body')
           <!-- Dashboard Start-->
       <div class="dashboard container">
        <!-- Sidebar -->
    
@include('forntend.dashboard.sidebar',['notifay_active'=>'active'])

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                  <div class="col-6 d-flex justify-content-end gap-2">

    <form action="{{ route('forntend.dashboard.notifaction.readall') }}" method="POST">
        @csrf
        <button style="margin-right: 10px;" class="btn btn-success btn-sm ">
            Read All
        </button>
    </form>

 <form action="{{ route('forntend.dashboard.notifaction.Deleteall')  }}" method="POST">
    @csrf
    <button class="btn btn-danger btn-sm">Delete All</button>
</form>

</div>
                  

                </div>
          @forelse (auth()->user()->notifications as $notifay)

<div class="notification alert alert-info d-flex justify-content-between align-items-center">

    <!-- TEXT -->
    <a href="{{ $notifay->data['link'] }}?notify={{ $notifay->id }}" class="text-decoration-none text-dark flex-grow-1">
        <strong>
            You have notification from: {{ $notifay->data['username'] }}
        </strong>
        <br>
        <small>
            Post: {{ substr($notifay->data['post_title'],0,20) }}...
        </small>
        <br>
        <small class="text-muted">
            {{ $notifay->created_at->diffForHumans() }}
        </small>
    </a>

    <!-- STATUS + ACTIONS -->
    <div class="d-flex align-items-center gap-2">

        @if(!$notifay->read_at)
            <span class="badge bg-danger">New</span>
        @else
            <span class="badge bg-success">Read</span>
        @endif

        <form method="POST" action="{{ route('forntend.dashboard.notifaction.deleteone',$notifay->id) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-dark">Delete</button>
        </form>

    </div>

</div>

@empty
<div class="alert alert-info text-center">
    No notifications yet
</div>
@endforelse 
          
            </div>
        </div>
      </div>
      <!-- Dashboard End-->

@endsection