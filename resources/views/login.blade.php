<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DRX Stock">
    <meta name="keyword" content="DRX Stock">
    <title>DRX Stock - Login</title>
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('/assets/css/al.style.min.css') }}">


    <!-- project layout css file -->
    <link rel="stylesheet" href="{{ asset('/assets/css/layout.p.min.css') }}">
</head>

<body>

    <div id="layout-a" class="theme-cyan">

        <!-- main body area -->
        <div class="main auth-div p-2 py-3 p-xl-5">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-fluid">

                    <div class="row g-0">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-4 p-md-5 card border-0" style="max-width: 32rem;">
                                <!-- Form -->
                                {{ html()->form('POST', route('signin'))->class("")->open() }}
                                <div class="col-12 text-center mb-5">
                                    <img src="{{ asset('/assets/images/auth-two-step.svg') }}" class="w240 mb-4" alt="" />
                                    <h1>DRX STOCK PORTAL LOGIN</h1>
                                </div>
                                <div class="col-12">
                                    <label for="SquareInput" class="form-label req">Username</label>
                                    {{ html()->text("username", old('username'))->class("form-control form-control-lg")->placeholder("username") }}
                                    @error('username')
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="SquareInput" class="form-label req">Password</label>
                                    {{ html()->password("password", "")->class("form-control form-control-lg")->placeholder("******") }}
                                    @error('password')
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    {{ html()->submit("Login")->class("btn btn-submit btn-dark btn-lg w-100") }}
                                </div>
                                {{ html()->form()->close() }}
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->

                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('/assets/bundles/libscripts.bundle.js') }}"></script>

    <!-- Jquery Page Js 
    <script src="{{ asset('/assets/js/template.js') }}"></script>-->
    @include("message")
</body>

</html>