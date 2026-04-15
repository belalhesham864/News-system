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
                    <div class="col-6">
                        <button style="margin-left: 270px" class="btn btn-danger btn-sm">Delete All</button>
                    </div>
                </div>
               <a href="">
                <div class="notification alert alert-info">
                    <strong>Info!</strong> This is an informational notification.
                    <div class="float-right">
                        <button  class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
               </a>
               <a href="">
                <div class="notification alert alert-warning">
                    <strong>Warning!</strong> This is a warning notification.
                    <div class="float-right">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
               </a>
               <a href="">
                <div class="notification alert alert-success">
                    <strong>Success!</strong> This is a success notification.
                    <div class="float-right">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
               </a>
            </div>
        </div>
      </div>
      <!-- Dashboard End-->

@endsection