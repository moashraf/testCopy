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
    {{--
    <hr class="sidebar-divider my-1 mb-2"> --}}


    <!-- Nav Item - Dashboard -->
    <li class="nav-item  d-none d-md-block active">
        <div class="text-gray-400 text-xs px-4">
            خط سير الرحلة @if($what_school_now === "second")
            الثانية
            @endif الخاصة بمدرستك <br> علي نظام <span class="main-color fw-bold">"لام"</span>
        </div>
    </li>


    <!-- progressbar -->
    <ul class="px-4 pe-md-4 progressbar progressbar_roadmap mb-0" style="overflow: auto" id="progressbar">
        <li class="active">
            <a class="d-flex align-items-center">
                <!-- in case we want to use prog selector href="#clinics" -->
                <div class="icon-circle checked d-flex align-items-center justify-content-center me-2">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.5418 22.9168H5.2085C3.12516 22.9168 2.0835 21.8752 2.0835 19.7918V11.4585C2.0835 9.37516 3.12516 8.3335 5.2085 8.3335H10.4168V19.7918C10.4168 21.8752 11.4585 22.9168 13.5418 22.9168Z"
                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M10.5314 4.16699C10.4481 4.47949 10.4168 4.82324 10.4168 5.20866V8.33366H5.2085V6.25033C5.2085 5.10449 6.146 4.16699 7.29183 4.16699H10.5314Z"
                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14.5835 8.3335V13.5418" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.75 8.3335V13.5418" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M17.7085 17.7085H15.6252C15.0522 17.7085 14.5835 18.1772 14.5835 18.7502V22.9168H18.7502V18.7502C18.7502 18.1772 18.2814 17.7085 17.7085 17.7085Z"
                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.25 13.542V17.7087" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M10.417 19.7918V5.2085C10.417 3.12516 11.4587 2.0835 13.542 2.0835H19.792C21.8753 2.0835 22.917 3.12516 22.917 5.2085V19.7918C22.917 21.8752 21.8753 22.9168 19.792 22.9168H13.542C11.4587 22.9168 10.417 21.8752 10.417 19.7918Z"
                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h6 class="mb-0 d-none d-md-block">مرحبا بك عزيزي</h6>
            </a>
        </li>

        <li class="@if($roadmap >= 3 && $what_school_now === 'first') active @elseif($roadmap>= 11 && $what_school_now
            === 'second') active @endif">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 3 && $what_school_now === 'first') checked @elseif($roadmap>= 11 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="transparent"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.35 22H14.65C19.9 22 22 19.9 22 14.65V8.35C22 3.1 19.9 1 14.65 1H8.35C3.1 1 1 3.1 1 8.35V14.65C1 19.9 3.1 22 8.35 22Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.2751 16.8342H15.3326" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12.5185 16.8342H5.72504" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M17.8 8.34985H5.20001" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M17.275 12.8865H11.4685" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M8.63354 12.8865H5.72504" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات عامة</h6>
            </a>
        </li>

        <li class=" @if($roadmap >= 4 && $what_school_now === 'first') active @elseif($roadmap>= 12 && $what_school_now
            === 'second') active @endif">

            <a class="d-flex align-items-center">

                <div class="icon-circle d-flex align-items-center justify-content-center me-2  @if($roadmap >= 4 && $what_school_now === 'first') checked @elseif($roadmap>= 12 && $what_school_now
                    === 'second') checked @endif">

                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.2973 10.7651V6.29204C20.2973 2.06052 19.2303 1 14.9395 1H6.35784C2.06703 1 1 2.06052 1 6.29204V18.1151C1 20.9081 2.65731 21.5696 4.6665 19.5746L4.67783 19.5641C5.60864 18.6506 7.02756 18.7241 7.8335 19.7216L8.98 21.1391"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M17.6866 21.3702C19.6927 21.3702 21.319 19.8658 21.319 18.0102C21.319 16.1545 19.6927 14.6501 17.6866 14.6501C15.6804 14.6501 14.0541 16.1545 14.0541 18.0102C14.0541 19.8658 15.6804 21.3702 17.6866 21.3702Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 22.0001L20.8649 20.9501" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.10809 6.25H15.1892" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M7.24329 10.4501H14.0541" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات مرافق المدرسة</h6>
            </a>
        </li>


        <li class=" @if($roadmap >= 4 && $what_school_now === 'first') active @elseif($roadmap>= 12 && $what_school_now
            === 'second') active @endif">

            <a class="d-flex align-items-center">

                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 5 && $what_school_now === 'first') checked @elseif($roadmap>= 13 && $what_school_now
                    === 'second') checked @endif">

                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.77839 10.417C8.68256 10.4075 8.56756 10.4075 8.46214 10.417C6.18131 10.3404 4.37006 8.47163 4.37006 6.17163C4.37006 3.82371 6.26756 1.91663 8.62506 1.91663C10.973 1.91663 12.8801 3.82371 12.8801 6.17163C12.8705 8.47163 11.0593 10.3404 8.77839 10.417Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M15.7263 3.83325C17.5854 3.83325 19.0804 5.33784 19.0804 7.18742C19.0804 8.99867 17.6429 10.4745 15.8509 10.5416C15.7742 10.532 15.6879 10.532 15.6017 10.5416"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M3.98663 13.9533C1.66746 15.5058 1.66746 18.0358 3.98663 19.5787C6.62205 21.342 10.9442 21.342 13.5796 19.5787C15.8987 18.0262 15.8987 15.4962 13.5796 13.9533C10.9537 12.1995 6.63163 12.1995 3.98663 13.9533Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M17.5759 19.1666C18.2659 19.0229 18.9176 18.745 19.4543 18.3329C20.9493 17.2116 20.9493 15.362 19.4543 14.2408C18.9272 13.8383 18.2851 13.57 17.6047 13.4166"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات الطلاب</h6>
            </a>
        </li>


        <li class=" @if($roadmap >= 6 && $what_school_now === 'first') active @elseif($roadmap>= 14 && $what_school_now
            === 'second') active @endif entsab_sidebar">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 6 && $what_school_now === 'first') checked @elseif($roadmap>= 14 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.2 1H5.8C2.6 1 1 2.6 1 5.8V16.2C1 16.64 1.36 17 1.8 17H12.2C15.4 17 17 15.4 17 12.2V5.8C17 2.6 15.4 1 12.2 1Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9.72789 5.67202L5.57593 9.82402C5.41593 9.98402 5.26393 10.296 5.23193 10.52L5.00792 12.104C4.92792 12.68 5.32793 13.08 5.90393 13L7.48789 12.776C7.71189 12.744 8.02389 12.592 8.18389 12.432L12.3359 8.28002C13.0479 7.56802 13.3919 6.73602 12.3359 5.68002C11.2799 4.61602 10.4479 4.95202 9.72789 5.67202Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.13574 6.26379C9.48774 7.51977 10.4717 8.51177 11.7357 8.86377" stroke="#0A3A81"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>
                <h6 class="mb-0 d-none d-md-block text-s">فصول الانتساب</h6>
            </a>
        </li>
        <li class=" @if($roadmap >= 7 && $what_school_now === 'first') active @elseif($roadmap>= 15 && $what_school_now
            === 'second') active @endif">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 7 && $what_school_now === 'first') checked @elseif($roadmap>= 15 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.5834 8.66663C22.3783 8.66663 23.8334 7.21155 23.8334 5.41663C23.8334 3.62171 22.3783 2.16663 20.5834 2.16663C18.7884 2.16663 17.3334 3.62171 17.3334 5.41663C17.3334 7.21155 18.7884 8.66663 20.5834 8.66663Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.58337 14.0833H13" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M7.58337 18.4166H17.3334" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15.1667 2.16663H9.75002C4.33335 2.16663 2.16669 4.33329 2.16669 9.74996V16.25C2.16669 21.6666 4.33335 23.8333 9.75002 23.8333H16.25C21.6667 23.8333 23.8334 21.6666 23.8334 16.25V10.8333"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات المعلمين</h6>
            </a>
        </li>
        <li class=" @if($roadmap >= 8 && $what_school_now === 'first') active @elseif($roadmap>= 16 && $what_school_now
            === 'second') active @endif">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 8 && $what_school_now === 'first') checked @elseif($roadmap>= 16 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="26" height="23" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.17627H12.5051" stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.84424 17.0591H8.26637" stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.294 17.0591H16.1383" stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.84894 12.7356H16.7485" stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M25.2213 11.5371V16.5771C25.2213 20.9129 24.1435 22 19.8442 22H6.37714C2.07785 22 1 20.9129 1 16.5771V6.42294C1 2.08706 2.07785 1 6.37714 1H16.1383"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M21.685 1.77814L17.192 6.36108C17.0224 6.53402 16.8529 6.8799 16.8165 7.12696L16.5743 8.88108C16.4895 9.51113 16.9255 9.95584 17.5432 9.86937L19.2629 9.62231C19.5051 9.58525 19.8442 9.41231 20.0138 9.23937L24.5068 4.65637C25.2819 3.86579 25.6452 2.95167 24.5068 1.79049C23.3563 0.616962 22.4601 0.98755 21.685 1.77814Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21.0432 2.43286C21.4307 3.82874 22.4964 4.9158 23.8528 5.29874" stroke="#0A3A81"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات الإداريين</h6>
            </a>
        </li>
        <li class=" @if($roadmap >= 9 && $what_school_now === 'first') active @elseif($roadmap>= 17 && $what_school_now
            === 'second') active @endif">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 9 && $what_school_now === 'first') checked @elseif($roadmap>= 17 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.4089 11.2685V6.56485C21.4089 2.11519 20.2804 1 15.7424 1H6.66647C2.12849 1 1 2.11519 1 6.56485V18.9974C1 21.9344 6.7385 21.4265 8.8034 21.4265"
                            stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.40247 6.52075H16.0066" stroke="#0A3A81" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.48816 10.937H14.8061M6.48816 14.8803H14.8061" stroke="#0A3A81" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M18.6609 15.1002L14.411 19.0089C14.243 19.1634 14.0869 19.4505 14.0509 19.6603L13.8228 21.1509C13.7388 21.6919 14.1469 22.0673 14.7352 21.99L16.3559 21.7802C16.584 21.7471 16.9081 21.6036 17.0642 21.449L21.3141 17.5404C22.0464 16.8668 22.3945 16.0829 21.3141 15.0892C20.2456 14.1065 19.3932 14.4267 18.6609 15.1002Z"
                            stroke="#0A3A81" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18.0465 15.6633C18.4067 16.8558 19.4151 17.7833 20.7117 18.1145" stroke="#0A3A81"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>
                <h6 class="mb-0 d-none d-md-block">بيانات اخري</h6>
            </a>
        </li>
        <li class=" @if($roadmap >= 9 && $what_school_now === 'first') active @elseif($roadmap>= 18 && $what_school_now
            === 'second') active @endif">
            <a class="d-flex align-items-center">
                <div class="icon-circle d-flex align-items-center justify-content-center me-2 @if($roadmap >= 10 && $what_school_now === 'first') checked @elseif($roadmap>= 18 && $what_school_now
                    === 'second') checked @endif">
                    <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.80798 9.61022L16.6417 0L18.1546 1.47849L6.80798 12.5672L0 5.91401L1.51288 4.43553L6.80798 9.61022Z"
                            fill="#134085" />
                    </svg>

                </div>
                <h6 class="mb-0 d-none d-md-block">انتهينا</h6>
            </a>
        </li>
    </ul>
</ul>
<!-- End of Sidebar -->