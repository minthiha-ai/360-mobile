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
@section('blog_index','active')
@section('main_content')

    <div class="page-content" data-aos="fade-up ">
        <div class="container-fluid" >
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header  d-flex justify-content-between " data-aos="fade-up">
                        <h4 class=" mb-0 "  >Blog List</h4>
{{--
                       <div class="">
                           <div class="dropdown">
                               <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                               </button>

                               <div class="dropdown-menu dropdown-menu-end" style="">
                                   <a class="dropdown-item" href="{{ route('blog.index') }}"><i class="ri-profile-line align-bottom me-2 text-muted"></i>
                                       All</a>
                                   <a class="dropdown-item" href="{{ url('product?status=0') }}"><i class="ri-stock-line text-danger align-bottom me-2 text-muted"></i>
                                       Out Of Stock</a>
                                   <div class="dropdown-divider"></div>
                                   <a class="dropdown-item" href="{{ route('product.create') }}" ><i class="ri-add-box-line  align-bottom me-2 text-muted"></i>
                                       Create Product</a>
                               </div>
                           </div>
                       </div> --}}
                    </div><!-- end card header -->

                    <div class="card-body" >
                        <div class="table-responsive table-card">
                            <table
                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col"> ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sub Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($blogs as $key=>$blog)
                                    <tr >
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <span>{{ $blog->title }}</span>
                                        </td>
                                        <td>{{ $blog->subTitle }}</td>

                                        <td> {{ \Illuminate\Support\Str::limit($blog->description,50) }}</td>
                                        <td>

                                            <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-warning btn-sm " >
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <a href="{{ route('blog.show',$blog->id) }}" class="btn btn-success btn-sm " >
                                                <i class='bx bx-info-circle'></i>
                                            </a>

                                                <button class="btn btn-danger btn-sm " onclick="confirm('{{ $blog->title }}','{{ $blog->id }}')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                                <form action="{{ route('blog.destroy',$blog->id) }}" id="BlogDel{{ $blog->id }}" method="post">
                                                    @csrf @method("DELETE")
                                                </form>

                                        </td>
                                        <td>{{ $blog->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="9">
                                            <img src="{{ asset('assets/images/nodata.webp') }}" width="300" alt="">
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->

                            <div class="text-right mt-3 d-flex justify-content-end mx-4 ">
                                {{ $blogs->links() }}
                            </div>
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
                    document.getElementById('BlogDel'+id).submit()

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
