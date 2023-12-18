<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ ProfileHelper::getProfileImage(AuthConstants::GUARD_USER) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="javascript:;" class="d-block">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_USER), 10) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('user.home') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>{{ __('Home') }}</p>
                </a>
            </li>

            <li class="nav-header">SUPPORT TICKETS</li>
            <li class="nav-item">
                <a href="{{ route('user.support-ticket.index') }}" class="nav-link {{ request()->is('user/support-ticket') || request()->is('user/support-ticket/*') ? 'active' : '' }}">
                    <i class="fas fa-anchor nav-icon"></i>
                    <p>Support Tickets</p>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route('executive.order.delivered') }}" class="nav-link {{ request()->is('order') || request()->is('order/*') ? 'active' : '' }}">--}}
{{--                    <i class="fas fa-truck nav-icon"></i>--}}
{{--                    <p>Delivered Orders</p>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Logout') }}</p>
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
