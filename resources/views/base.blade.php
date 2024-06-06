<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DRX Stock">
    <meta name="keyword" content="DRX Stock">
    <title>DRX Stock</title>
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/al.style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/dataTables.min.css') }}">


    <!-- project layout css file -->
    <link rel="stylesheet" href="{{ asset('/assets/css/layout.p.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>

<body>

    <div id="layout-p" class="theme-cyan">

        <!-- Navigation -->
        <div class="header fixed-top">
            <div class="container-fluid">
                <nav class="navbar navbar-light px-md-2">

                    <!-- Brand -->
                    <a href="{{ route('dashboard') }}" class="brand-icon d-flex align-items-center me-2 me-lg-4">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 64 80" fill="none">
                            <path d="M58.8996 22.7L26.9996 2.2C23.4996 -0.0999999 18.9996 0 15.5996 2.5C12.1996 5 10.6996 9.2 11.7996 13.3L15.7996 26.8L3.49962 39.9C-3.30038 47.7 3.79962 54.5 3.89962 54.6L3.99962 54.7L36.3996 78.5C36.4996 78.6 36.5996 78.6 36.6996 78.7C37.8996 79.2 39.1996 79.4 40.3996 79.4C42.9996 79.4 45.4996 78.4 47.4996 76.4C50.2996 73.5 51.1996 69.4 49.6996 65.6L45.1996 51.8L58.9996 39.4C61.7996 37.5 63.3996 34.4 63.3996 31.1C63.4996 27.7 61.7996 24.5 58.8996 22.7ZM46.7996 66.7V66.8C48.0996 69.9 46.8996 72.7 45.2996 74.3C43.7996 75.9 41.0996 77.1 37.9996 76L5.89961 52.3C5.29961 51.7 1.09962 47.3 5.79962 42L16.8996 30.1L23.4996 52.1C24.3996 55.2 26.5996 57.7 29.5996 58.8C30.7996 59.2 31.9996 59.5 33.1996 59.5C35.0996 59.5 36.9996 58.9 38.6996 57.8C38.7996 57.8 38.7996 57.7 38.8996 57.7L42.7996 54.2L46.7996 66.7ZM57.2996 36.9C57.1996 36.9 57.1996 37 57.0996 37L44.0996 48.7L36.4996 25.5V25.4C35.1996 22.2 32.3996 20 28.9996 19.3C25.5996 18.7 22.1996 19.8 19.8996 22.3L18.2996 24L14.7996 12.3C13.8996 8.9 15.4996 6.2 17.3996 4.8C18.4996 4 19.8996 3.4 21.4996 3.4C22.6996 3.4 23.9996 3.7 25.2996 4.6L57.1996 25.1C59.1996 26.4 60.2996 28.6 60.2996 30.9C60.3996 33.4 59.2996 35.6 57.2996 36.9Z" fill="black"></path>
                        </svg>
                        <span class="fs-5 text-primary fw-bold d-none d-md-block">DRX</span>
                    </a>

                    <!-- Search -->
                    <div class="h-left d-flex flex-grow-1 me-md-4 me-0">
                        <ul class="nav nav-tabs inbox-tab tab-card border-bottom-0 me-sm-2" role="tablist">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Administrator</a>
                                <div class="dropdown-menu rounded-4 shadow border-0 w240 p-0 overflow-hidden">
                                    <div class="list-group list-group-custom list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                            <h6 class="mb-1">Administrator</h6>
                                            <p class="mb-1 small">You are logged in as Administrator</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- header rightbar icon -->
                    <div class="h-right justify-content-end d-flex align-items-center">
                        <div class="dropdown user-profile ms-2">
                            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown">
                                <img class="avatar rounded-circle p-1" src="{{ asset('/assets/images/profile_av.png') }}" alt="">
                            </a>
                            <div class="dropdown-menu rounded-lg shadow border-0 dropdown-menu-end">
                                <div class="card border-0 w240">
                                    <div class="card-body border-bottom">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle" src="{{ asset('/assets/images/profile_av.png') }}" alt="">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0 text-muted"><span class="fw-bold">{{ Auth::user()->name }}</span></p>
                                                <small class="text-muted">{{ Auth::user()->email }}</small>
                                                <div>
                                                    <a href="{{ route('logout') }}" class="card-link">Sign out</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group m-2">
                                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-user"></i>Profile &amp; account</a>
                                        <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-gear"></i>Settings</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary d-none menu-toggle ms-3" type="button"><i class="fa fa-bars"></i></button>
                    </div>

                </nav>
            </div>
        </div>

        <!-- sidebar tab menu -->
        <div class="sidebar px-3 py-1">
            <div class="d-flex flex-column h-100">
                <h5 class="sidebar-title mb-4 mt-2">DRX<span> - Administrator</span></h5>

                @include("nav")

                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link text-primary sidebar-mini-btn">
                    <span><i class="fa fa-arrow-left"></i></span>
                </button>
            </div>
        </div>

        <div class="main">
            <!-- main body area -->
            @yield("content")

            <!-- Body: Footer -->
            <div class="body-footer px-xl-4 px-md-2">
                <div class="container-fluid">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <p class="font-size-sm mb-0">© DRX Stock. <span class="d-none d-sm-inline-block">
                                            <script>
                                                document.write(/\d{4}/.exec(Date())[0])
                                            </script> Speczone.
                                        </span></p>
                                </div>
                                <div class="col-auto">
                                    <ul class="list-inline d-flex justify-content-end mb-0">
                                        <li class="list-inline-item"><a class="list-separator-link" href="https://devieh.com" target="_blank">Devi Eye Hospitals</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('/assets/bundles/select2.bundle.js') }}"></script>
    <script src="{{ asset('/assets/bundles/dataTables.bundle.js') }}"></script>
    <!-- Plugin Js -->
    <!--<script src="{{ asset('/assets/bundles/apexcharts.bundle.js') }}"></script>-->

    <!-- Jquery Page Js -->
    <!--<script src="{{ asset('/assets/js/template.js') }}"></script>
    <script src="{{ asset('/assets/js/page/index.js') }}"></script>-->
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    @include("message")
</body>

</html>