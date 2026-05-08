        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
        @can('home')
                <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
        @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
    {{-- Admins --}}
         @can('admins')
             

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities2">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Admins</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admins Mangment:</h6>
                    
                        <a class="collapse-item" href="{{ route('admin.admins.index') }}">Admins</a>
                    </div>
                </div>
            </li>
         @endcan
                    @can('authorization')
                
     
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3"
                    aria-expanded="true" aria-controls="collapseUtilities3">
                    <i class="fa-solid fa-circle-minus"></i>
                    <span>Roles</span>
                </a>
                <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Roles Mangment:</h6>
                    
                        <a class="collapse-item" href="{{ route('admin.authorization.index') }}">Roles</a>
                    </div>
                </div>
            </li>
       @endcan
           @can('users')
                       <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                   <i class="fa-solid fa-users"></i>
                       <span>User mangment</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                        @can('Add_User')
                            
                        <a class="collapse-item" href="{{ route('admin.users.create') }}">Add User</a>
                        @endcan 

                        <a class="collapse-item" href="forgot-password.html">Block user</a>
                    
                    </div>
                </div>
            </li>
  @endcan

            <!-- Nav Item - Pages Collapse Menu -->
                        @can('categories')
                
           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                  <i class="fa-solid fa-layer-group"></i>
                    <span>Categories</span></a>
            </li>
 @endcan 
            @can('posts')
                
          
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fa-solid fa-newspaper"></i>
                    <span>Post Mangment</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">posts mangment:</h6>
                        <a class="collapse-item" href="{{ route('admin.posts.index') }}">posts</a>
                        @can('Create_Post')
                            
                        <a class="collapse-item" href="{{ route('admin.posts.create') }}">Create Post</a>
                        @endcan
                    </div>
                </div>
            </li>
  @endcan
  
            <!-- Nav Item - Utilities Collapse Menu -->

            {{-- Setting --}}

     
 
            <!-- Divider -->
            <hr class="sidebar-divider">
{{-- 
            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->

{{-- 
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> --}}

            <!-- Nav Item - Tables -->

                       @can('settings')
                
          
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Setting</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Setting Mangment:</h6>
                    
                        <a class="collapse-item" href="{{ route('admin.setting.index') }}">Setting</a>
                    </div>
                </div>
            </li>
  @endcan
                
           @can('Contacts')
               
           <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.Contact.index') }}">
                   <i class="fa-solid fa-message"></i>
                   <span>Contact</span></a>
                </li>
                @endcan
           @can('notifaction')
               
           <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.notifaction') }}">
                   <i class="fa-solid fa-bell"></i>
                   <span>Notification</span></a>
                </li>
                @endcan
           @can('porfile')
               
           <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.porfile.index') }}">
                   <i class="fa-solid fa-user"></i>
                   <span>Porfile</span></a>
                </li>
                @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->
