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

                <div class="col-xl-12">
                    <div class="card">
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

                            {{-- <div class="mt-3">
                                <a href="{{ url('/home?status=3') }}" class="btn btn-outline-danger ">Cancel Order</a>
                                <a href="{{ url('/home?status=1') }}" class="btn btn-outline-primary ">Complete Order</a>
                                <a href="{{ url('/home?status=2') }}" class="btn btn-outline-success ">Complete Order</a>
                            </div> --}}
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
