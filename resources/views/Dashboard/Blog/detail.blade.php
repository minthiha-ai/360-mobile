@extends('Dashboard.layouts.app')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none d-md-block" action="{{ route('blog.index') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off"
                   id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                  id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('style')
    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('blog_index','active')

@section('main_content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Blog Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Blog Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <img src="{{ asset('storage/blog_photo/'.$blog->photo)}}" alt="{{ $blog->title }}" class="img-fluid d-block" />
                                </div>
                                <!-- end col -->

                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h4>{{ $blog->title }}</h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div><a href="#" class="text-primary d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a></div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Published : <span
                                                            class="text-body fw-medium">{{ $blog->created_at->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>
                                                    <a href="{{ route('blog.edit',$blog->id) }}"
                                                       class="btn btn-light" data-bs-toggle="tooltip"
                                                       data-bs-placement="top" title="Edit"><i
                                                            class="ri-pencil-fill align-bottom"></i></a>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row mt-4">
                                            <div class="col-md-4   mb-3 ">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Sub Title :</p>
                                                            <h5 class="mb-0">{{ $blog->subTitle  }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="mt-4 text-muted">
                                            <h5 class="fs-15">Description :</h5>
                                            <p>
                                                {{ $blog->description }}
                                            </p>
                                        </div>



{{--
                                        <div class="product-content mt-5">
                                            <h5 class="fs-15 mb-3">Product Description :</h5>
                                            <nav>
                                                <ul class="nav nav-tabs nav-tabs-custom nav-success"
                                                    id="nav-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="nav-speci-tab"
                                                           data-bs-toggle="tab" href="#nav-speci" role="tab"
                                                           aria-controls="nav-speci"
                                                           aria-selected="true">Specification</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="nav-detail-tab"
                                                           data-bs-toggle="tab" href="#nav-detail" role="tab"
                                                           aria-controls="nav-detail"
                                                           aria-selected="false">Details</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="tab-content border border-top-0 p-4"
                                                 id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-speci"
                                                     role="tabpanel" aria-labelledby="nav-speci-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">Name</th>
                                                                <td>{{ $product->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 200px;">
                                                                    Category</th>
                                                                <td>{{ $product->Category->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Brand</th>
                                                                <td>{{ $product->Brand->name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Stock</th>
                                                                <td>
                                                                    <span class="{{ $product->stock == 0 ? 'badge badge-soft-danger' : '' }}">{{ $product->stock == 0 ? "OUT OF STOCK" : $product->stock }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Size</th>
                                                                <td>{{ $product->size }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                                     aria-labelledby="nav-detail-tab">
                                                    <div>
                                                       {{ $product->detail }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <!-- product-content -->


                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script>
        var productNavSlider = new Swiper(".product-nav-slider", {
                // loop: !1,
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: !0,
                watchSlidesProgress: !0,

            }),
            productThubnailSlider = new Swiper(".product-thumbnail-slider", {
                loop: !1,
                spaceBetween: 24,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: { swiper: productNavSlider },
            });

        function confirm(value,id){
            Swal.fire({
                title: "Are you sure?",
                text: ` ${value} product will be delete!`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function (t) {
                t.value
                    ?
                    document.getElementById('ProductDel'+id).submit()

                    : t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary mt-2",
                        buttonsStyling: !1,
                    });
            });
        }

    </script>

@endsection
