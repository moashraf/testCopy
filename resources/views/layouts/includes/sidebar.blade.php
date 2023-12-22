<!-- Sidebar -->
<ul class="sidebar_wide navbar-nav accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon me-1">
            {{-- <img alt="Tripo" width="32" src="{{ URL::asset('img/dashboard/system/favicon_white.svg') }}"> --}}
            <img class="me-1" width="60" src="{{ asset('img/website/logo/lam_logo_white.svg') }}">
        </div>
        <div class="sidebar-brand-text"><sup>v1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href={{ route('sett.home') }}>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('basic.dashboard') }}</span></a>
        </a>
    </li>


    @role('Super-admin|Operation-worker|Branch-manager|Call-center|Monitor')
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.on_request.index') }}" data-bs-toggle="collapse"
            data-bs-target="#on_request" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-paper-plane text-s2 fa-fw"></i> <span>{{ __('basic.requests') }}</span>
        </a>
        <div id="on_request" class="collapse collapse-side-admin" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.client_form.index') }}">{{ __('basic.website forms')
                    }}</a>
            </div>
        </div>
    </li>
    @endrole

    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        {{ __('basic.operation') }}
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.managers.index') }}" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-user fa-fw"></i>
            <span>{{ __('basic.clients') }}</span>
        </a>
        <div id="collapseTwo" class="collapse collapse-side-admin" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.managers.index') }}">{{ __('basic.search') }}</a>
                <a class="collapse-item" href="{{ route('sett.pat_show_all_patients') }}">{{ __('basic.smart search')
                    }}</a>


                @role('Super-admin|Branch-manager')
                <hr>
                <h6 class="collapse-header">{{ __('basic.settings') }}:</h6>
                <a class="collapse-item" href="{{ route('sett.resourcecat.index') }}">{{ __('basic.resources') }}</a>
                @endrole
            </div>
        </div>
    </li>

    @role('Super-admin|Branch-manager|Receptionist|Doctor|Call-center|Monitor|Marketing|Data-entry|Call-center|Hotel-worker|Hotel-manager|Transport-manager|Transport-worker|Driver|Airline-manager|Airline-worker|Visa-manager|Visa-worker|Trip-manager|Trip-worker|Package-manager|Package-worker|Operation-manager|Operation-worker')
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.edu_department.index') }}" data-bs-toggle="collapse"
            data-bs-target="#operation" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-school text-s2 fa-fw"></i> <span>{{ __('basic.schools') }}</span>
        </a>
        <div id="operation" class="collapse collapse-side-admin" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.edu_department.index') }}">
                    {{ __('basic.education department') }}</a>
                <a class="collapse-item" href="{{ route('sett.edu_department_office.index') }}">
                    {{ __('basic.education department office') }}</a>
            </div>

        </div>
    </li>
    @endrole

    @role('Super-admin|Branch-manager|Call-center|Monitor|Marketing|Data-entry|Visa-manager|Visa-worker|Operation-worker|Operation-manager')
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.teacher_speciality.index') }}" data-bs-toggle="collapse"
            data-bs-target="#visa_side" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-chalkboard-teacher text-s2 fa-fw"></i> <span>{{ __('basic.teachers') }}</span>
        </a>
        <div id="visa_side" class="collapse collapse-side-admin" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.teacher_speciality.index') }}">
                    {{ __('basic.teacher specialities') }}</a>
                <a class="collapse-item" href="{{ route('sett.school_job.index') }}">
                    {{ __('basic.school jobs') }}</a>
            </div>

        </div>
    </li>
    @endrole


    @role('Super-admin|Branch-manager|Receptionist|Doctor|Call-center|Monitor|Marketing|Data-entry|Transport-manager|Transport-worker|Driver|Operation-manager|Operation-worker')
    {{-- Bus --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.school_event.index') }}" data-bs-toggle="collapse"
            data-bs-target="#buses" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-calendar-week"></i>
            <span>{{ __('basic.events') }}</span>
        </a>
        <div id="buses" class="collapse collapse-side-admin" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item fw-bold" href="{{ route('sett.school_event.index') }}">{{ __('basic.all events')
                    }}</a>
                <a class="collapse-item" href="{{ route('sett.school_event.create') }}">
                    {{ __('basic.new event')
                    }}</a>
            </div>
        </div>
    </li>
    @endrole

    @role('Super-admin|Hr-manager|Hr-worker')
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('basic.employees') }}
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sett.admin.index') }}" data-bs-toggle="collapse"
            data-bs-target="#collapsePagesworker" aria-expanded="true" aria-controls="collapsePages"
            data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fas fa-users"></i>
            <span>{{ __('basic.workers') }}</span>
        </a>
        <div id="collapsePagesworker" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.admin.index') }}">{{ __('basic.all workers') }}</a>
                @role('Super-admin|Hr-manager')
                <a class="collapse-item" href="{{ route('sett.admin.create') }}">{{ __('basic.new worker') }}</a>
                <hr>
                <h6 class="collapse-header">{{ __('basic.settings') }}:</h6>
                <a class="collapse-item" href="{{ route('sett.user_job_title.index') }}">{{ __('basic.job titles')
                    }}</a>
                <a class="collapse-item" href="{{ route('sett.user_edu_qualification.index') }}">{{
                    __('basic.educational qualifications') }}</a>
                @endrole
            </div>
        </div>
    </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    {{-- @role('Super-admin|Operation-manager')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-chart-pie fa-fw"></i>
            <span>{{ __('basic.reports') }}</span>
        </a>
        <div id="reports" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.livereport') }}">{{ __('basic.live report') }}</a>
                <a class="collapse-item" href="{{ route('sett.pat_allstatcs') }}">{{ __('basic.patients') }}</a>
                <a class="collapse-item" href="{{ route('sett.google') }}">Google</a>
            </div>
        </div>
    </li>
    @endrole --}}

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('basic.basic') }}
    </div>


    <!-- Divider -->
    @role('Super-admin|Data-entry|Monitor')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#articles_sidebar"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-newspaper fa-fw"></i>
            <span>{{ __('basic.articles') }}</span>
        </a>
        <div id="articles_sidebar" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.article.index') }}">{{ __('basic.articles') }}</a>
                <a class="collapse-item" href="{{ route('sett.article.create') }}">{{ __('basic.new article') }}</a>
                <a class="collapse-item" href="{{ route('sett.tag.index') }}">{{ __('basic.tags') }}</a>
                <a class="collapse-item" href="{{ route('sett.tag.create') }}">{{ __('basic.new tag') }}</a>
            </div>
        </div>
    </li>
    @endrole

    @role('Super-admin|Data-entry|Monitor')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#video_tutorial_sidebar"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-video fa-fw"></i>
            <span>{{ __('basic.video tutorials') }}</span>
        </a>
        <div id="video_tutorial_sidebar" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="{{ route('sett.video_tutorial.index') }}">{{ __('basic.video tutorials')
                    }}</a>
                <a class="collapse-item" href="{{ route('sett.video_tutorial.create') }}">
                    {{ __('basic.new video tutorial') }}</a>
            </div>
        </div>
    </li>
    @endrole


    @role('Super-admin|Data-entry|Monitor')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#slider_sidebar"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-exchange-alt fa-fw"></i>
            <span>{{ __('basic.sliders') }}</span>
        </a>
        <div id="slider_sidebar" class="collapse collapse-side-admin" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item" href="{{ route('sett.slider.index') }}">{{ __('basic.sliders') }}</a>
                <a class="collapse-item" href="{{ route('sett.slider.create') }}">{{ __('basic.new slider') }}</a>
            </div>
        </div>
    </li>
    @endrole


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->