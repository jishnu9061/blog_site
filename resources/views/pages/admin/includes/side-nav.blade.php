<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ ProfileHelper::getProfileImage(AuthConstants::GUARD_ADMIN) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('admin.profile.index') }}" class="d-block">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN), 10) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>{{ __('Home') }}</p>
                </a>
            </li>

            <li class="nav-header">USER MANAGEMENT</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/user') || request()->is('admin/user/*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users-cog nav-icon"></i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            <li class="nav-header">SUPPORT TICKETS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/support-ticket') || request()->is('admin/support-ticket/*') ? 'active' : '' }}" href="{{ route('admin.support-ticket.index') }}">
                    <i class="fas fa-anchor nav-icon"></i>
                    <p>{{ __('Support Tickets') }}</p>
                </a>
            </li>

            <li class="nav-header">CONTACT US</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/contact-us') || request()->is('admin/contact-us/*') ? 'active' : '' }}" href="{{ route('admin.contact-us.index') }}">
                    <i class="fas fa-address-book nav-icon"></i>
                    <p>{{ __('Contact Us') }}</p>
                </a>
            </li>
            <li class="nav-header">PAGE </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/page-management') || request()->is('admin/page-management/*') ? 'active' : '' }}" href="{{ route('admin.page.index') }}">
                    <i class="fas fa-clipboard-list nav-icon"></i>
                    <p>{{ __('Pages') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/testimonials') || request()->is('admin/page-management/testimonials/*') ? 'active' : '' }}" href="{{ route('admin.page-management.testimonials.index') }}">
                    <i class="fas fa-object-group nav-icon"></i>
                    <p>{{ __('Testimonials') }}</p>
                </a>
            </li>
            <li class="nav-header">SITE SETTINGS</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Sign out') }}</p>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
