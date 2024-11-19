<!DOCTYPE html>
<html lang="en">

<head>
    <title>Decode Me</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Decode Me">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('admin/assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Love Ya Like A Sister Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">

    <!-- Rubik Font  -->
    <link
        href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('admin/assets/css/portal.css') }}">
    <link href="{{ asset('summernotes/summernote-lite.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body class="app">
    <header class="app-header fixed-top"
        style="background: #95949E; border-top-right-radius:15px;
    border-bottom-right-radius:15px;">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#"
                                style="color:#fff;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div><!--//col-->
                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-notifications-dropdown dropdown">
                                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"
                                    title="Notifications" style="color:#fff;">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                        <path fill-rule="evenodd"
                                            d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                    <span class="icon-badge">3</span>
                                </a><!--//dropdown-toggle-->
                            </div><!--//app-utility-item-->


                            <div class="app-utility-item app-user-dropdown dropdown" style="margin:0 0px;">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown"
                                    href="#" role="button" aria-expanded="false" style="color:#fff;"><img
                                        src="{{ asset('admin/assets/images/adminlogo.png') }}" alt="user profile"
                                        style="margin-right: 10px; "></a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li style="margin-left: 30px;"><a class="dropdown-item"
                                            href="account.html">Account</a></li>
                                    {{--  <li>
                                        <hr class="dropdown-divider">
                                    </li>  --}}
                                    <li style="margin-left: 30px;"><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.sidebar')
    </header><!--//app-header-->
    <script>
        function removeElementsByClass(className) {
            const elements = document.getElementsByClassName(className);
            while (elements.length > 0) {
                elements[0].parentNode.removeChild(elements[0]);
            }
        }
        setTimeout(() => {
            removeElementsByClass('decodeme');
        }, 4000);
    </script>
