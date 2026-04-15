@extends('layout.forntend.app')
@section('title')
    Notifications
@endsection

@section('body')
           <!-- Dashboard Start-->
       <div class="dashboard container">
        <!-- Sidebar -->
    
@include('forntend.dashboard.sidebar')

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
                @forelse (auth()->user()->notifications as $notifay )
                
                    <a href="{{ $notifay->data['link'] }}?notify={{ $notifay->id }}">
                <div class="notification alert alert-info">
                    <strong>you have notifaction form : {{ $notifay->data['username'] }}!</strong> post title :{{ $notifay->data['post_title'] }}
                        @if(!$notifay->read_at)
                <span class="badge bg-danger">New</span>
            @else
                <span class="badge bg-success">Read</span>
            @endif
             <form action="{{  route('forntend.dashboard.notifaction.deleteone',$notifay->id)}}">
                @csrf
                       <div class="float-right">
                        <button style="margin-top: -47px" class="btn btn-danger btn-sm">Delete</button>
                    </div>
             </form>
                </div>
               </a>
               @empty
               <div class="alert alert-info">Dont have notifaction</div>
                @endforelse
               
          
            </div>
        </div>
      </div>
      <!-- Dashboard End-->

@endsection