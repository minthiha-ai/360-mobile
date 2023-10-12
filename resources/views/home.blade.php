@extends('Dashboard.layouts.app')
@section('dashboard','active')
@section('style')
    @if(isset(request()->status))
        <style>
            .progress{
                background-color: #183564 !important;
            }
        </style>
    @endif
@endsection
@section('search')
    <!-- App Search-->
    <form class="app-search d-none d-md-block" action="{{ route('home') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off"
                   id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                  id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('main_content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-duration="500">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-exchange-dollar-line  fs-13 align-middle"></i>
                                        LAK
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span class="counter-value" data-target="{{ (int)$totalEarning  }}">
                                            {{ $totalEarning  }}
                                        </span>
                                    </h4>
                                    <a href="{{ route('order_admin.graph') }}" class="text-decoration-underline">
                                        View net earnings
                                    </a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Orders</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span class="counter-value" data-target="{{ $orderCount }}">
                                            {{ $orderCount }}
                                        </span>
                                    </h4>
                                    <a href="" class="text-decoration-underline">View all orders</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                   <span class="avatar-title bg-soft-info rounded fs-3">
                                       <i class="bx bx-shopping-bag text-info"></i>
                                   </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-duration="1100">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Customers</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span class="counter-value" data-target="{{ $user }}">
                                            {{ $user }}
                                        </span>
                                    </h4>
                                    <a href="{{ route('user.index') }}" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                     <span class="avatar-title bg-soft-warning rounded fs-3">
                                         <i class="bx bx-user-circle text-warning"></i>
                                     </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-duration="1400">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                       Total Product</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                       {{ $product }}
                                    </h4>
                                    <a href="{{ route('product.index') }}" class="text-decoration-underline">View All Product</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded fs-3">
                                                            <i class="bx bxl-product-hunt  text-primary"></i>
                                                        </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>



            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header " data-aos="fade-up" data-aos-duration="1000">
                            <div class="row">
                                <h4 class="card-title mb-0 col-6">Order List</h4>
                                <div class=" col-6 ">
                                    <div id="custom-progress-bar" class="progress-nav" >
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="{{ url('/home?status=0') }}">
                                                    <button class="nav-link rounded-pill   {{ request()->status == 0 ? 'active' : 'done'}}" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">
                                                        <i class="ri-refresh-line"></i>
                                                    </button>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="{{ url('/home?status=1') }}">
                                                    <button  class="nav-link rounded-pill  {{ request()->status != 0 ? request()->status == 1 ? 'active' : 'done' : ''}}" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">
                                                        <i class="ri-save-line"></i>
                                                    </button>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="{{ url('/home?status=2') }}">
                                                    <button  class="nav-link rounded-pill {{ request()->status == 2 ? 'active' : '' }}" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false">
                                                        <i class="ri-car-line "></i>
                                                    </button>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end card header -->
                        <div class="card-body form-steps" data-aos="fade-right" data-aos-duration="1000">

                                <div class="table-responsive table-card">
                                    <table
                                        class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Order Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('order.show',$order->id) }}"
                                                       class="fw-medium link-primary text-decoration-underline">{{ $order->unique_id }}</a>
                                                </td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>
                                                        <span  class="badge
                                                            @switch($order->status)

                                                            @case('0')
                                                               badge-soft-warning link-warning
                                                            @break

                                                            @case('1')
                                                                badge-soft-info link-info
                                                            @break

                                                            @case('2')
                                                                badge-soft-success link-success
                                                            @break

                                                            @case('3')
                                                                badge-soft-danger link-danger
                                                            @break

                                                            @endswitch
                                                                    ">{{ config('status.status.'.$order->status) }}</span>
                                                </td>
                                                <td class="small">{{ $order->created_at->format('d M Y H:i') }}</td>

                                            </tr><!-- end tr -->
                                            @empty
                                            <tr class="text-center">
                                                <td colspan="9">
                                                    <img src="{{ asset('assets/images/nodata.webp') }}" width="300" alt="">
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>

                            <div class="mt-3">
                                <a href="{{ url('/home?status=3') }}" class="btn btn-outline-danger ">Cancel</a>
                            </div>
                                <div class="text-end mt-4 d-flex justify-content-end ">
                                    {{ $orders->appends(request()->all())->links() }}
                                </div>
                                <!-- end tab content -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div><!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')


    <script>
        document.querySelector("#profile-img-file-input") &&
        document
            .querySelector("#profile-img-file-input")
            .addEventListener("change", function () {
                var e = document.querySelector(".user-profile-image"),
                    t = document.querySelector(".profile-img-file-input").files[0],
                    o = new FileReader();
                o.addEventListener(
                    "load",
                    function () {
                        e.src = o.result;
                    },
                    !1
                ),
                t && o.readAsDataURL(t);
            }),
        document.querySelectorAll(".form-steps") &&
        document.querySelectorAll(".form-steps").forEach(function (l) {
            l.querySelectorAll(".nexttab") &&
            l.querySelectorAll(".nexttab").forEach(function (t) {
                l
                    .querySelectorAll('button[data-bs-toggle="pill"]')
                    .forEach(function (e) {
                        e.addEventListener("show.bs.tab", function (e) {
                            e.target.classList.add("done");
                        });
                    }),
                    t.addEventListener("click", function () {
                        var e = t.getAttribute("data-nexttab");
                        document.getElementById(e).click();
                    });
            }),
            l.querySelectorAll(".previestab") &&
            l.querySelectorAll(".previestab").forEach(function (r) {
                r.addEventListener("click", function () {
                    for (
                        var e = r.getAttribute("data-previous"),
                            t = r
                                .closest("form")
                                .querySelectorAll(".custom-nav .done").length,
                            o = t - 1;
                        o < t;
                        o++
                    )
                        r.closest("form").querySelectorAll(".custom-nav .done")[o] &&
                        r
                            .closest("form")
                            .querySelectorAll(".custom-nav .done")
                            [o].classList.remove("done");
                    document.getElementById(e).click();
                });
            });
            var n = l.querySelectorAll('button[data-bs-toggle="pill"]');
            n &&
            n.forEach(function (o, r) {
                o.setAttribute("data-position", r),
                    o.addEventListener("click", function () {
                        var e;
                        o.getAttribute("data-progressbar") &&
                        ((e =
                            document
                                .getElementById("custom-progress-bar")
                                .querySelectorAll("li").length - 1),
                            (e = (r / e) * 100),
                            (document
                                .getElementById("custom-progress-bar")
                                .querySelector(".progress-bar").style.width = e + "%")),
                        0 < l.querySelectorAll(".custom-nav .done").length &&
                        l.querySelectorAll(".custom-nav .done").forEach(function (e) {
                            e.classList.remove("done");
                        });
                        for (var t = 0; t <= r; t++)
                            n[t].classList.contains("active")
                                ? n[t].classList.remove("done")
                                : n[t].classList.add("done");
                    });
            });
        });

    </script>

@endsection
