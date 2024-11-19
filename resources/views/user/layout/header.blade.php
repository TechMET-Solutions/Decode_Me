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
    <!-- Love Ya Like A Sister Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">

    <!-- Rubik Font  -->
    <link
        href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!-- Jocky One Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">

    <!--Lottie Files-->

    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <link href="{{ asset('user/assets/summernotes/summernote-lite.min.css') }}" rel="stylesheet">

</head>

<body class="app"
    style="background-image: url('{{ asset('admin/assets/images/bg.png') }}'); background-repeat:no-repeat;background-size: cover;">
    <header class="fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-end align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#"
                                style="color:#000;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div><!--//col-->
                    </div>
                </div>
            </div>
        </div>
        @include('user.layout.sidebar')
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
        }, 3000);
    </script>
