<div id="app-sidepanel" class="app-sidepanel" style="border: none;">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column" style="  background: #FFE235; ">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="card"
            style="background-color: #fff;border:none; margin:0 30px; border-bottom-left-radius:50px;border-bottom-right-radius:50px; text-align:center;">

            <div class="d-flex flex-column align-items-center ">
                <img class="logo-icon me-2 " src="{{ asset('admin/assets/images/adminlogo.png') }}" style="width: 45%;"
                    alt="logo">
                <div class="app-branding">
                    <a class="app-logo" href="index.html"><span class="logo-text "
                            style="color:#FFE235;font-size:22px; font-weight:bold;">{{ Auth::user()->name }}</span></a>
                </div>
            </div>
        </div>


        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mt-4">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion" style="  background: #FFE235;">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.home') ? ' active' : '' }}" href="{{ route('admin.home') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon1.png') }}" width="22%" alt="">

                        </span>
                        <span class="nav-link-text">&nbsp;Dashboard</span>
                    </a>
                </li>

                @php
                    $isActiveSchoolSubMenu2 =
                        Route::is('admin.schoollist') || Route::is('admin.addschool') || Route::is('admin.editschool');
                @endphp

                <li class="nav-item has-submenu{{ $isActiveSchoolSubMenu2 ? ' show' : '' }}">
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-2" aria-expanded="{{ $isActiveSchoolSubMenu2 ? 'true' : 'false' }}"
                        aria-controls="submenu-2">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/school.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text" style="margin-left: 4px;">Schools</span>
                        <span class="submenu-arrow mt-2{{ $isActiveSchoolSubMenu2 ? ' rotate' : '' }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" style="color: #000;" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-2" class="collapse submenu submenu-2{{ $isActiveSchoolSubMenu2 ? ' show' : '' }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ (Route::is('admin.schoollist') ? ' active' : '' || Route::is('admin.editschool')) ? ' active' : '' }}"
                                    href="{{ route('admin.schoollist') }}"><i class='fas fa-caret-right'
                                        style='font-size:18px;margin-right:10px;'></i>School List</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Route::is('admin.addschool') ? ' active' : '' }}"
                                    href="{{ route('admin.addschool') }}"><i class='fas fa-caret-right'
                                        style='font-size:18px;margin-right:10px; '></i>Add New School</a></li>
                        </ul>
                    </div>
                </li><!--//nav-item-->

                @php
                    $isActiveSubMenu =
                        Route::is('admin.studentlist') ||
                        Route::is('admin.addstudent') ||
                        Route::is('admin.editstudent') ||
                        Route::is('admin.showstudent');
                @endphp

                <li class="nav-item has-submenu{{ $isActiveSubMenu ? ' show' : '' }}">

                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-1" aria-expanded="{{ $isActiveSubMenu ? 'true' : 'false' }}"
                        aria-controls="submenu-1">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/students2.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text" style="margin-left: 4px;">Students</span>
                        <span class="submenu-arrow mt-2{{ $isActiveSubMenu ? ' rotate' : '' }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" style="color: #000;" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>

                    <div id="submenu-1" class="collapse submenu submenu-1{{ $isActiveSubMenu ? ' show' : '' }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ ((Route::is('admin.studentlist') ? ' active' : '' || Route::is('admin.editstudent')) ? ' active' : '' || Route::is('admin.showstudent')) ? ' active' : '' }}"
                                    href="{{ route('admin.studentlist') }}"><i class='fas fa-caret-right'
                                        style='font-size:18px;margin-right:10px;'></i>Students List</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Route::is('admin.addstudent') ? ' active' : '' }}"
                                    href="{{ route('admin.addstudent') }}"><i class='fas fa-caret-right'
                                        style='font-size:18px;margin-right:10px; '></i>Add New Student</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ (Route::is('admin.addexpert') ? ' active' : '' || Route::is('admin.expert')) ? ' active' : '' }}"
                        href="{{ route('admin.expert') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon4.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">
                            &nbsp;Expert</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

                <li class="nav-item" style="background: #FFE235;">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ ((Route::is('admin.addworkshop') ? ' active' : '' || Route::is('admin.workshop')) ? ' active' : '' || Route::is('admin.attendance')) ? ' active' : '' }}"
                        href="{{ route('admin.workshop') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon2.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">&nbsp;Workshop</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link {{ (Route::is('admin.previousTaskList') ? ' active' : '' || Route::is('admin.taskList')) ? ' active' : '' }}"
                        href="{{ route('admin.previousTaskList') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon5.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">
                            &nbsp;DM Task</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link {{ ((Route::is('admin.dmsession') ? ' active' : '' || Route::is('admin.dmsessionlist')) ? ' active' : '' || Route::is('admin.adddmsession')) ? ' active' : '' }}"
                        href="{{ route('admin.dmsessionlist') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon6.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">
                            &nbsp;DM Session</span>
                    </a>
                </li>
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ (Route::is('admin.careerlist') ? ' active' : '' || Route::is('admin.subcareerlist')) ? ' active' : '' }}"
                        href="{{ route('admin.careerlist') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon7.png') }}" width="22%"
                                alt="">

                        </span>
                        <span class="nav-link-text">
                            &nbsp;Career List</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                {{-- <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ Route::is('admin.studentcareeroptions') ? ' active' : '' }}"
                        href="{{ route('admin.studentcareeroptions') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon8.png') }}" width="22%"
                                alt="">

                        </span>
                        <span class="nav-link-text">
                            &nbsp;Student Career Option</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item--> --}}
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ Route::is('admin.careerclub') ? ' active' : '' }}"
                        href="{{ route('admin.careerclub') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon9.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">
                            &nbsp;Career Club</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ ((Route::is('admin.internshiplist') ? ' active' : '' || Route::is('admin.addinternship')) ? ' active' : '' || Route::is('admin.editinternship')) ? ' active' : '' }}"
                        href="{{ route('admin.internshiplist') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon10.png') }}" width="22%"
                                alt="">
                        </span>
                        <span class="nav-link-text">
                            &nbsp;Internship</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ Route::is('admin.aiportal') ? ' active' : '' }} "
                        href="{{ route('admin.aiportal') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon11.png') }}" width="22%"
                                alt="">

                        </span>
                        <span class="nav-link-text">
                            &nbsp;AI Portal</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ Route::is('admin.progressVideo') ? ' active' : '' }} "
                        href="{{ route('admin.progressVideo') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/icon11.png') }}" width="22%"
                                alt="">

                        </span>
                        <span class="nav-link-text">
                            &nbsp;Parent's Wisdom</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item" style="background: #FFE235;">
                    <a class="nav-link{{ Route::is('admin.venue') ? ' active' : '' }} "
                        href="{{ route('admin.venue') }}">

                        <span class="nav-icon">
                            <img src="{{ asset('admin/assets/images/icons/mdi_location.png') }}" width="12%"
                                alt="">

                        </span>
                        <span class="nav-link-text">
                            &nbsp;Venues</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

            </ul><!--//app-menu-->
        </nav><!--//app-nav-->


    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->
