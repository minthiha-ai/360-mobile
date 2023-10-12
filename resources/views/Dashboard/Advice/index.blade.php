@extends('Dashboard.layouts.app')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none d-md-block" action="{{ route('advice.index') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off"
                   id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                  id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('advice_create','active')
@section('main_content')

    <div class="page-content" data-aos="fade-up ">
        <div class="container-fluid" >
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex" data-aos="fade-up">
                        <h4 class="card-title mb-0 flex-grow-1"  >Advice List</h4>
                    </div><!-- end card header -->

                    <div class="card-body" >
                        <div class="table-responsive table-card">
                            <table
                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col"> ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($advices as $d=>$advice)
                                    <tr >
                                        <td>{{ $d+1 }}</td>
                                        <td>
                                            <span>{{ $advice->user->name }}</span>
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($advice->title,50) }}
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($advice->description,50) }}
                                        </td>
                                        <td>
                                            @include('Dashboard.Advice.detail')
                                            <button class="btn btn-danger btn-sm " onclick="confirm('{{ $advice->name }}','{{ $advice->id }}')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                            <form action="{{ route('advice.destroy',$advice->id) }}" id="BrandDel{{ $advice->id }}" method="post">
                                                @csrf @method("DELETE")
                                            </form>
                                        </td>
                                        <td>{{ $advice->created_at->diffForHumans() }}</td>
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
                        <div class="d-flex justify-content-end mt-4 ">
                            {{ $advices->appends(request()->all())->links() }}
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
                text: ` ${value} advice will be delete!`,
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
                    document.getElementById('BrandDel'+id).submit()

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
