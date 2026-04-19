    <!-- Top Bar Start -->
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="tb-contact">
              <p><i class="fas fa-envelope"></i>{{ $setting->email }}</p>
              <p><i class="fas fa-phone-alt"></i>{{ $setting->phone }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="tb-menu">
              <a href="">About</a>
              <a href="">Privacy</a>
              <a href="">Terms</a>
              <a href="{{ route('forntend.contact') }}">Contact</a>
              @guest
                
              <a href="{{ route('register') }}">Register</a>
              <a href="{{ route('login') }}">Login</a>
              @endguest
              @auth
              
              <a href="#" onclick="
              event.preventDefault();
              if(confirm('do you sure logout')){
              document.getElementById('formlogout').submit()
              }
              return false
              " >Logout</a>
              @endauth
              <form id="formlogout" action="{{ route('logout') }}" method="post">
                @csrf
                

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    <div class="brand">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4">
            <div class="b-logo">
              <a href="index.html">
                <img src="{{ asset('assets/forntend') }}{{ $setting->logo }}" alt="Logo" />
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-4">
            <div class="b-ads">
            
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <form action="{{ route('forntend.search') }}" method="post">
              @csrf

              <div class="b-search">
                <input type="text" title="search" name="search" placeholder="Search" />
                @error('search')
                  
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar">
      <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
          <a href="#" class="navbar-brand">MENU</a>
          <button
            type="button"
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div
            class="collapse navbar-collapse justify-content-between"
            id="navbarCollapse"
          >
            <div class="navbar-nav mr-auto">
              <a href="{{ route('forntend.index') }}" class="nav-item nav-link   {{ request()->routeIs('forntend.index') ? 'active' : '' }}">Home</a>
              <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-toggle="dropdown"
                  >Categories</a
                >
                <div class="dropdown-menu">
                  @foreach ($categories as $category )
                  <a href="{{ route('forntend.category.posts',$category->slug) }}" title="{{ $category->name }}" class="dropdown-item {{ request()->routeIs('forntend.category.posts') && request()->route('slug') == $category->slug ? 'active' : '' }}">{{ $category->name }}</a>
                  
                  @endforeach
                
                </div>
              </div>
             
              <a href="{{ route('forntend.contact') }}"class="nav-item nav-link   {{ request()->routeIs('forntend.contact') ? 'active' : '' }}">Contact Us</a>
              <a href="{{ route('forntend.dashboard.porfile') }}" class="nav-item nav-link   {{ request()->routeIs('forntend.dashboard.porfile') ? 'active' : '' }}" >Account</a>
            </div>
            <div class="social ml-auto">
              @auth
                
              
                            <!-- Notification Dropdown -->
 <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell"></i>
    <span id="count-notifaction" class="badge badge-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
</a>
<div class="dropdown-menu dropdown-menu-right"
     aria-labelledby="notificationDropdown"
     style="width: 300px; max-height: 350px; overflow-y: auto;">
<div class="dropdown-header d-flex justify-content-between align-items-center">

    <h6 class="mb-0">Notifications</h6>
 @if (auth()->user()->unreadNotifications()->count() > 0)
   

    <form action="{{ route('forntend.dashboard.notifaction.readall') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-success">
            Read All
        </button>
    </form>
 @endif
</div>

    @forelse (auth()->user()->unreadNotifications()->limit(7)->get() as $notification)
<div id="push-notifaction">


        <div class="dropdown-item d-flex justify-content-between align-items-center gap-2">

            
            <span class="small text-dark">
                new comment on post:
                <span class="text-primary">
                    {{ substr( $notification->data['post_title'],0,10) }}
                </span>
            </span>

            {{-- Action --}}
            <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}"
               class="text-decoration-none text-primary">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{ route('forntend.dashboard.notifaction.deleteone',$notification->id) }}"
               class="text-decoration-none text-primary">
                <i class="fa fa-trash"></i>
            </a>

        </div>
</div>
    @empty

        <div class="dropdown-item text-center text-muted">
            No notifications
        </div>

    @endforelse

</div>
@endauth
              <a href="{{ $setting->tiwter }}" title="tiwter" target="_blank" rel="nofollow" ><i class="fab fa-twitter"></i></a>
              <a href="{{ $setting->facebook }}" title="facebook" target="_blank" rel="nofollow"><i class="fab fa-facebook-f"></i></a>
              <a href="{{ $setting->instgram }}" title="instagram" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a>
              <a href="{{ $setting->youtube }}" title="youtube" target="_blank" rel="nofollow"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- Nav Bar End -->