<ul class="nav nav-pills mb-2">
    <!-- account -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/profile/index') || request()->is('admin/profile/index/*') ? 'active' : '' }}" href="{{ route('admin.profile.index') }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Profile</span>
        </a>
    </li>
    <!-- security -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/profile/change-password') || request()->is('admin/profile/change-password/*') ? 'active' : '' }}" href="{{ route('admin.profile.change-password') }}">
            <i data-feather="lock" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Change Password</span>
        </a>
    </li>
    <!-- billing and plans -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/profile/recent-login') || request()->is('admin/profile/recent-login/*') ? 'active' : '' }}" href="{{ route('admin.profile.recent-login') }}">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Recent Logins</span>
        </a>
    </li>
</ul>
