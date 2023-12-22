<!-- Sidebar -->
<ul class="sidebar_wide navbar-nav accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-start">
        <div class="sidebar-brand-icon">
            <img class="platform_icon" alt="lam platform logo" src="{{ URL::asset('img/website/logo/lam_logo.svg') }}">
        </div>
        <div class="topbar-divider d-none d-sm-block fullsc_topbar_hide my-0 mx-1"></div>
        <div class="sidebar-brand-text">منصة لام</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <div class="text-gray-400 text-xs px-4">
            خط سير الرحلة الخاصة بمدرسة علي نظام <span class="main-color fw-bold">"لام"</span>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.chart_of_cost_center_show') }}" data-bs-toggle="collapse"
            data-bs-target="#collapsePagesCost_center" aria-expanded="true" aria-controls="collapsePages"
            data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fas fa-dollar-sign"></i>
            <span>{{ __('basic.cost centers') }}</span>
        </a>

        <div id="collapsePagesCost_center" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.chart_of_cost_center_show') }}">
                    {{ __('basic.cost center chart') }}</a>
                <a class="collapse-item" href="{{ route('sett.cost_center_report') }}">{{ __('basic.reports')
                    }}</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->