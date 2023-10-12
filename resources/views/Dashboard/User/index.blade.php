@extends('Dashboard.layouts.app')
@section('search')
    <!-- App Search-->
    <form class="app-search d-none d-md-block" action="{{ route('user.index') }}" method="get">
        <div class="position-relative">
            <input type="text" name="keyword" class="form-control" placeholder="Search..." autocomplete="off"
                   id="search-options" value="{{ request()->keyword ?? '' }}">
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                  id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('user_index','active')
@section('main_content')

    <div class="page-content" data-aos="fade-up ">
        <div class="container-fluid" >
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex" data-aos="fade-up">
                        <h4 class="card-title mb-0 flex-grow-1"  >User List</h4>
                    </div><!-- end card header -->

                    <div class="card-body" >
                        <div class="table-responsive table-card">
                            <table
                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $i=>$user)
                                    <tr class="{{ $user->role == 1 ? 'table-success' : '' }}">
                                        <td>{{ $i+1 }}</td>
                                        <td>
                                            <span>{{ $user->name }}</span>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            @include('Dashboard.User.detail')
                                           @if($user->role == 0)
                                                <button class="btn btn-danger btn-sm " onclick="confirm('{{ $user->name }}','{{ $user->id }}')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                                <form action="{{ route('user.destroy',$user->id) }}" id="BrandDel{{ $user->id }}" method="post">
                                                    @csrf @method("DELETE")
                                                </form>
                                           @endif
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
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

                            <div class="text-right mt-3 d-flex justify-content-end mx-4 ">
                                {{ $users->links() }}
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
                text: ` ${value} user will be delete!`,
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
