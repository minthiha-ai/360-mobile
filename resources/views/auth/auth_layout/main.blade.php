<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>

    <meta charset="utf-8" />
    <title>360 mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesbrand" name="app.com.mm" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">


    @yield('style')

<!-- Sweet Alert css-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}" />

    <style>
        body::-webkit-scrollbar {
            display: none !important; /* for Chrome, Safari, and Opera */
        }
        .loader{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0; left: 0;
            z-index: 9999;
            background: #ffffff;
            transition: 1s all ease-in;

        }
    </style>

</head>

<body>
<div id="loader" class="loader">
    <img src="{{ asset('assets/images/loading.svg') }}" width="30%" alt="">
</div>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">

        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="text-center  mb-4 text-white-50">--}}
{{--                        <div>--}}
{{--                            <a href="index.html" class="d-inline-block auth-logo">--}}
{{--                                <img src="assets/images/logo-light.png" alt="" height="20">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- end row -->

            @yield('content')
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer"  >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> 360 Mobile. Crafted with <i class="mdi mdi-heart text-danger"></i> by APP.COM.MM</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}s"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>

@yield('script')
<!-- aos js -->
<script src="{{ asset('assets/libs/aos/aos.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>
<!-- particles js -->
<script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
<!-- particles app js -->
<script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
<!-- password-addon init -->
<script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>


@include('Dashboard.Alert.alert')

<script>

    window.addEventListener("load",function (){
        let loader = document.getElementById('loader');
        loader.setAttribute('data-aos','fade-out');
        loader.setAttribute('data-aos-duration','1000');

        setTimeout(()=>{
            loader.classList.add('d-none')
        },1500)

    })

</script>
</body>

</html>
