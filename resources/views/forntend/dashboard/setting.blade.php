@extends('layout.forntend.app')
@section('title')
    Setting
@endsection

@section('body')
        <div class="dashboard container">
      <!-- Sidebar -->
  
@include('forntend.dashboard.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <!-- Settings Section -->
        <section id="settings">
          <h2>Settings</h2>
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>

                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>                
                @endforeach
            </ul>
          </div>
          @endif
          <form class="settings-form" action="{{ route('forntend.dashboard.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="username">name:</label>
              <input type="text" name="name" id="name" value="{{ $user->name }}" />
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" name="username" id="username" value="{{ $user->username }}" />
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" value="{{ $user->email }}" />
            </div>
            <div class="form-group">
              <label for="profile-image">Profile Image:</label>
              <input type="file" name="image" id="profile-image" accept="image/*" />
            </div>
            <div class="form-group">
              <label for="Phone">Phone:</label>
              <input
                type="text"
                id="Phone"
                placeholder="Enter your Phone"
                value="{{$user->phone}}"
                name="phone"
              />
            </div>
            <div class="form-group">
              <label for="country">Country:</label>
              <input
                type="text"
                id="country"
                placeholder="Enter your country"
                value="{{ $user->country }}"
                name="country"
              />
            </div>
            <div class="form-group">
              <label for="city">City:</label>
              <input type="text" id="city" name="city" value="{{ $user->city }}" placeholder="Enter your city" />
            </div>
            <div class="form-group">
              <label for="street">Street:</label>
              <input type="text" name="street" value="{{ $user->street }}" id="street" placeholder="Enter your street" />
            </div>
           
            <button type="submit" class="save-settings-btn">
              Save Changes
            </button>
          </form>

          <!-- Form to change the password -->
          <form class="change-password-form" action="{{ route('forntend.dashboard.changepassword') }}" method="post">
            @csrf
            <h2>Change Password</h2>
            <div class="form-group">
              <label for="current-password">Current Password:</label>
              <input
                type="password"
                id="current-password"
                placeholder="Enter Current Password"  
                name="current_password"
              />
            
            </div>
            <div class="form-group">
              <label for="new-password">New Password:</label>
              <input
                type="password"
                id="new-password"
                placeholder="Enter New Password"
                name="new_password"
              />
               
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm New Password:</label>
              <input
                type="password"
                id="confirm-password"
                placeholder="Enter Confirm New "
                name="new_password_confirmation"
              />
           
            </div>
            <button type="submit" class="change-password-btn">
              Change Password
            </button>
          </form>
        </section>
      </div>
    </div>
@endsection