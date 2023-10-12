@extends('Dashboard.layouts.app')
@section('order','active')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none " action="{{ route('home') }}" method="get">
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
                <!-- end page title -->
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="card " id="demo">
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-sm-flex justify-content-between align-items-center ">
                                    <div class="">
                                        <img src="{{ asset('images/logo.png') }}" class="card-logo card-logo-dark"
                                             alt="logo dark" height="170">
                                        <img src="{{ asset('images/logo.png') }}" class="card-logo card-logo-light"
                                             alt="logo light" height="170">

                                    </div>
                                    <div class=" mt-sm-0 mt-3 d-none d-md-block  ">

                                       <table class="table table-bordered mb-0 ">
                                        <tr>
                                            <td>
                                                <div class=" px-2 d-flex justify-content-between  align-items-center  ">
                                                    <span class="bg-soft-info mx-3 px-3 rounded">CUSTOMER NAME</span>
                                                    <span class=" mx-3 px-3 rounded  bg-soft-success ">{{ $orders->user->name }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                       <tr>
                                           <td>
                                               <div class=" px-2 d-flex justify-content-between  align-items-center  ">
                                                   <span class="bg-soft-info mx-3 px-3 rounded">PHONE NO</span>
                                                   <span class=" mx-3 px-3 rounded  bg-soft-success ">{{ $orders->user->phone }}</span>
                                               </div>
                                           </td>
                                       </tr>
                                           <tr>
                                               <td>
                                                   <div class=" px-2 d-flex justify-content-between  align-items-center  ">
                                                       <span class="bg-soft-info mx-3 px-3 rounded">ORDER ID</span>
                                                       <span class=" mx-3 px-3 rounded  bg-soft-success ">{{ $orders->unique_id }}</span>
                                                   </div>
                                               </td>
                                           </tr>
                                       </table>

                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->

                            <!--end card-body-->
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table
                                        class="table table-borderless text-center table-nowrap align-middle mb-0 {{ $orders->status == 3 ? 'bg-soft-danger' : "" }}">
                                        <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Price (MMK)</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col" class="text-end">Sub Price </th>
                                        </tr>
                                        </thead>
                                        <tbody id="products-list">

                                        @foreach($orders->orderProduct as $e=>$order)
                                            <tr>
                                                <th scope="row">{{ $e+1 }}</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $order->product->name }}</span>
                                                </td>
                                                <td>
                                                     {{ $order->product->Category->name }}
                                                </td>
                                                <td>
                                                    {{ $order->product->Brand->name }}
                                                </td>
                                                <td>
                                                    {{ $order->product->size }}
                                                </td>
                                                <td>{{ number_format($order->product_price) }}  </td>
                                                <td>{{ $order->quantity }}  </td>
                                                <td class="text-end">{{ number_format($order->sub_price) }}</td>
                                            </tr>
                                            @endforeach

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="6"></td>
                                            <td colspan="2" class="fw-medium p-0">
                                                <table
                                                    class="table table-borderless text-start table-nowrap align-middle mb-0">
                                                    <tbody>

                                                    <tr class="border-top border-top-dashed h3">
                                                        <th scope="row">Total Amount</th>
                                                        <td class="text-end ">{{ number_format($totalPrice) }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->

                                <div class="hstack gap-2 justify-content-between d-print-none mt-4">
                                    @if($orders->status != '3')

                                        @if($orders->status != 0)
                                            @else
                                            <a href="{{ route('order.reject',$orders->unique_id) }}" class="btn btn-soft-danger link-danger"> Reject </a>

                                        @endif
                                            <div class="">

                                                <a href="{{ route('order_admin.update',$orders->unique_id) }}" class="btn
                                             @switch($orders->status)

                                                @case('0')
                                                    btn btn-soft-warning link-warning"> Pending </a>
                                                @break

                                                @case('1')
                                                btn btn-soft-info link-info">confirmed </a>
                                                @break

                                                @case('2')
                                                btn btn-soft-success link-success disabled">Completed </a>
                                                @break

                                                @endswitch

                                                <a href="javascript:window.print()" class="btn btn-success"><i
                                                        class="ri-printer-line align-bottom me-1"></i> Print</a>

                                            </div>

                                    @endif
                                </div>
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


    <script>


    </script>

@endsection
