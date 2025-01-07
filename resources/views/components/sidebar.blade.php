<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TICKETING</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard - Visible to all roles -->
    <li class="nav-item">
        @if (Auth::user()->role === 'admin')
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        @elseif (Auth::user()->role === 'agent')
            <a class="nav-link" href="{{ route('agent.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        @else
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        @endif
    </li>

    <!-- Ticket - Visible to all roles -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket.index') }}">
            <i class="fas fa-ticket-alt"></i>
            <span>Ticket</span>
        </a>
    </li>

    <!-- Additional Items - Only for Admin -->
    @if (Auth::user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ticket.logs') }}">
                <i class="fas fa-history"></i>
                <span>Ticket Logs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-folder"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('labels.index') }}">
                <i class="fas fa-tags"></i>
                <span>Labels</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
