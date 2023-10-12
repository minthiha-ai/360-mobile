@extends('Dashboard.layouts.app')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none d-md-block" action="{{ route('category.create') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off"
                   id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                  id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('category_create','active')
@section('main_content')

    <div class="page-content" data-aos="fade-up ">
        <div class="container-fluid" >
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex" data-aos="fade-up">
                        <h4 class="card-title mb-0 flex-grow-1"  >Banner List</h4>
                        <div class="flex-shrink-0">

                            <!-- Default Modals -->
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Create Banner</button>
                            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Create Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3 ">
                                                    <label for="basiInput" class="form-label">Photo</label>
                                                    <input type="file" required class="form-control" name="photo" id="name">
                                                </div>

                                                <div class="text-end mt-3 ">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary ">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body" >
                        <div class="table-responsive table-card">
                            <table
                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col"> ID</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr >
                                            <td>{{ $banner->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/banner_photo/'.$banner->photo) }}" height="50" alt="">
                                            </td>
                                            <td>
                                                @include('Dashboard.Banner.edit')

                                                <button class="btn btn-danger btn-sm " onclick="confirm('{{ $banner->name }}','{{ $banner->id }}')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                                <form action="{{ route('banner.destroy',$banner->id) }}" id="catDel{{ $banner->id }}" method="post">
                                                    @csrf @method("DELETE")
                                                </form>
                                            </td>
                                            <td>{{ $banner->created_at->diffForHumans() }}</td>
                                            <td>{{ $banner->updated_at->diffForHumans() }}</td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="6">
                                                <img src="{{ asset('assets/images/nodata.webp') }}" width="300" alt="">
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div>
                </div> <!-- .card-->
            </div>
        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')

    <script>

        function confirm(value,id){
            Swal.fire({
                title: "Are you sure?",
                text: ` ${value} category will be delete!`,
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
                    document.getElementById('catDel'+id).submit()

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
