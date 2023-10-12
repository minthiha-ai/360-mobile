@extends('auth.auth_layout.main')

@section('content')

    <!-- Begin page -->
    <div class="layout-wrapper landing"  style="border-radius: 10px;overflow: hidden">

        <!-- start hero section -->
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern rounded " ></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10 mb-5 ">
                        <div class="text-center">
                            <h1 class="fw-bolder  " >
                                WELCOME
                                <div class="p h6 ">to 360 mobile</div>
                            </h1>
                            <img src="{{ asset('images/logo.png') }}" width="350" alt="">

                            <div class="d-flex gap-2 justify-content-center ">
                                    @auth
                                        <a href="{{ route('home') }}" class="btn btn-success"> Home <i class="ri-home-2-line  align-middle ms-1"></i></a>
                                        <form c method="post" action="{{ route('logout') }}" style="cursor: pointer">
                                            @csrf
                                            <button class=" btn btn-danger" data-key="t-logout" type="submit">
                                                Logout
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">Get Started <i class="ri-arrow-right-line align-middle ms-1"></i></a>
                                    @endauth

                                </div>
                        </div>

                    </div>
                    <div class="text-end mb-2">
                        <a href="{{ route('policy') }}" class="link-primary small">
                            Privacy and policy
                        </a>
                    </div>
                </div>
                <!-- end row -->
            </div>

        </section>
        <!-- end hero section -->

    </div>


@endsection
