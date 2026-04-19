<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img
            src="{{ asset(auth()->user()->image) }}"
            alt="User Image"
            class="rounded-circle mb-2"
            style="width: 80px; height: 80px; object-fit: cover"
        />
        <h5 class="mb-0" style="color: #ff6f61">
            {{ auth()->user()->name }}
        </h5>
    </div>

    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">

        <a
            href="{{ route('forntend.dashboard.porfile') }}"
            class="list-group-item list-group-item-action menu-item
           {{ $porfile_active ?? '' }}"
        >
            <i class="fas fa-user"></i> Profile
        </a>

        <a
            href="{{ route('forntend.dashboard.notifaction.show') }}"
            class="list-group-item list-group-item-action menu-item
        {{ $notifay_active ?? '' }}"
        >
            <i class="fas fa-bell"></i> Notifications
        </a>

        <a
            href="{{ route('forntend.dashboard.setting') }}"
            class="list-group-item list-group-item-action menu-item
          {{ $setting_active ?? ''}}"
        >
            <i class="fas fa-cog"></i> Settings
        </a>

        <a
            href="{{ $setting->whatsapp }}"
            class="list-group-item list-group-item-action menu-item
          {{ $setting_active ?? ''}}"
        >
            <i class="fas fa-phone"></i> Support
        </a>

        <a
            href="javascript:void(0)"
            onclick="document.getElementById('logoutform').submit()"
            class="list-group-item list-group-item-action menu-item
        "
        >
            <i class="fas fa-sign-out"></i> Logout
        </a>
        <form id="logoutform" method="post" action="{{ route('logout') }}">
            @csrf

        </form>

    </div>
</aside>