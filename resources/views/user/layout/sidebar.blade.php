<div id="app-sidepanel" class="app-sidepanel" style="border: none;border-bottom-right-radius:50px;">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column" style="background: #FFE235;border-bottom-right-radius:50px;">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="card"
            style="background-color: #fff;border:none; margin:0 20px; border-bottom-left-radius:24px;border-bottom-right-radius:24px; text-align:center;">

            <div class="d-flex flex-column align-items-center">
                <h2 class="logo-text me-2"> <img class="logo-icon me-2 mt-2"
                        src="{{ asset('user/assets/images/decode me logo.png') }}" style="width: 60%;" alt="logo">
                    {{--  <img src="{{ asset('user/assets/images/decode me logo.png') }}"
                        alt="">  --}}
                </h2>
                {{-- <img class="logo-icon me-2 " src="{{ asset('admin/assets/images/user.png') }}" style="width: 40%;"
                    alt="logo"> --}}
                <div class="profileImage">
                    {{-- <div style="width: 248px; height: 0px; border: 2px #FFE235 solid"></div> --}}
                    {{--  <img style="" src="{{ asset('stud_images/' . Auth::user()->profile) }}" />  --}}
                    <img style=""
                        src=" {{ Auth::user()->profile ? asset('stud_images/' . Auth::user()->profile) : asset('stud_images/DefaultUserimg.png') }}" />
                    {{-- <div style="width: 248px; height: 0px; border: 2px #FFE235 solid"></div> --}}
                </div>
                <div class="app-branding">
                    <a class="app-logo" href="#"><span class="logo-text">{{ Auth::user()->name }}</span></a>
                </div>

                <div style="line-height:1px;">
                    <p>Std: {{ Auth::user()->std }}</p>
                    <p>Email: </p>
                    <p style="font-size: 10px;">{{ Auth::user()->email }}</p>
                    <a href="{{ route('myProfile') }}"><button class="btn btn-success mb-2"
                            style="background: #442D00;color:#FFED7E;border-radius:18px;">My
                            Profile</button></a>
                </div>
            </div>
        </div>
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mt-4">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion" style="  background: #FFE235;">
                <li class="nav-item" style="  background: #FFE235;">
                    <a class="nav-link  {{ request()->is('home') ? ' active' : '' }}" href="{{ route('home') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img1.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;Dashboard</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('careerOptionRank') ? ' active' : '' }}"
                        href="{{ route('careerClubRank') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img6.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;My Career Option</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('workshop') ? ' active' : '' }}"
                        href="{{ route('workshop') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img2.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;Workshop</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('counselling') ? ' active' : '' }}"
                        href="{{ route('counselling') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img3.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;DM Session</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tasks') ? ' active' : '' }}" href="{{ route('tasks') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img4.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;DM Tasks</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('internship') ? ' active' : '' }}"
                        href="{{ route('internship') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img5.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;Internships</span>
                    </a><!--//nav-link-->
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('careerClub') ? ' active' : '' }}"
                        href="{{ route('careerGoal') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img9.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;Career Club</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('aiPortal') ? ' active' : '' }}"
                        href="{{ route('aiPortal') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img7.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;AI Portals</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('progressVideo') ? ' active' : '' }}"
                        href="{{ route('progressVideo') }}">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img10.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text">&nbsp;Parent's Wisdom</span>
                    </a><!--//nav-link-->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="nav-icon">
                            <img src="{{ asset('assets/images/sidebar/img8.png') }}" alt="" width="20%;">
                        </span>
                        <span class="nav-link-text" style="color: #FC542D">&nbsp;LOG OUT</span>
                    </a><!--//nav-link-->
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>
    </div>
</div>
