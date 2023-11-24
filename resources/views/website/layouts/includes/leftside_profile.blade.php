<div class="bg-white b-r-l-cont p-0 mb-3">
    <div class="list-group list_sidebar_menu">
        <a href="#" class="list-group-item list-group-item-action active">
            <div class="d-flex align-items-center me-2">
                <img id="avatar_final_info" class="rounded-circle avatar-small me-3"
                    src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}">
                <div class="">
                    <p class="mb-0 text-xs text-blue-300">
                        Welcome</p>
                    <h5 id="name_final_info" class="fw-bold text-white mb-0">
                        {{ Auth::guard('school')->user()->full_name }}
                    </h5>
                    <p id="number_final_info" class="mb-0 text-xs text-blue-300">
                        {{ Auth::guard('school')->user()->phone_number }}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('school_route.dashboard') }}" class="list-group-item list-group-item-action 
        @if($type === 'my_profile') active @endif"><i class="fa-solid fa-user me-2"></i> My
            Profile</a>
        <a href="{{ route('school_route.my_requests') }}"
            class="list-group-item list-group-item-action @if($type === 'requests') active @endif"><i
                class="fa-solid fa-paper-plane me-2"></i>
            Requests</a>
        <a href="{{ route('school_route.unit_book') }}"
            class="list-group-item list-group-item-action @if($type === 'hotels') active @endif"><i
                class="fa-solid fa-hotel me-2"></i>
            Hotels</a>
        <a href="{{ route('school_route.package_book') }}"
            class="list-group-item list-group-item-action @if($type === 'packages') active @endif"><i
                class="fa-solid fa-suitcase-rolling me-2"></i>
            Packages</a>
        <a href="{{ route('school_route.trip_book') }}"
            class="list-group-item list-group-item-action @if($type === 'trips') active @endif"><i
                class="fa-solid fa-umbrella-beach me-2"></i>
            Trips</a>
        <a href="{{ route('school_route.my_visa') }}"
            class="list-group-item list-group-item-action @if($type === 'visa') active @endif"><i
                class="fa-solid fa-passport me-2"></i>
            Visa</a>
        <a href="{{ route('school_route.my_invoices') }}"
            class="list-group-item list-group-item-action @if($type === 'invoices') active @endif"><i
                class="fa-solid fa-receipt me-2"></i>
            Invoices</a>
    </div>
</div>