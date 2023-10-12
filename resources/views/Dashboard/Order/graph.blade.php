@extends('Dashboard.layouts.app')
@section('order','active')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none " action="{{ route('home') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('main_content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- end page title -->
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="card" id="demo">
                        <div class="card-header border-bottom-dashed p-md-4 p-0 ">
                            <div class=" d-flex justify-content-between " data-aos="fade-up">
                                <h3 class="fw-bolder mb-0 "> Monthly Earning Graph </h3>
                                <div class="">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end" style="">

                                            @foreach($years as $y)
                                                <a class="dropdown-item" href="{{ url('order_admin_graph?year='.now()->subYear(2)->addYears($y['month'])->format('Y')) }}">
                                                    <i class="ri-calendar-2-line align-bottom me-2 text-muted"></i>
                                                    {{ now()->subYear(2)->addYears($y['month'])->format('Y') }}
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->

                        <!--end card-body-->
                        <div class="card-body p-4">
                            <canvas id="myChart" height="100"></canvas>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->


@endsection

@section('script')

    <!-- Chart JS -->
    <script src="{{ asset('assets/libs/chart.js/chart.min.js') }}"></script>

    <script>

            let data = @json($years);

            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
            label: 'Orders Earning',
            data: data.map(el=>el.price),
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
        },
            options: {
            scales: {
            y: {
            beginAtZero: true
        }
        }
        }
        });
    </script>

@endsection
