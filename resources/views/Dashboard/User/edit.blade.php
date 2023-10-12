@extends('Dashboard.layouts.app')
@section('style')


    <!-- dropzone css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}" type="text/css" />
@endsection
@section('main_content')

    <div class="page-content">
        <div class="container-fluid">

           <div class="row">
               <div class="col-md-7 ">
                  <div class="card">

                      <div class="card-body" >
                          <form action="{{ route('user.update',$user->id) }}" method="post" class="">
                              @csrf @method('PUT')
                             <div class="text-center ">
                                 <img src="{{ asset('assets/images/user-illustarator-1.png') }}"  width="200" alt="">
                                 <h3 class="text-center fw-bolder mt-4  ">Edit Profile</h3>
                             </div>
                              <div class="mb-3 ">
                                  <label for="basiInput" class="form-label">Name</label>
                                  <input type="text" class="form-control" name="name" id="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                              </div>
                              <div class="mb-3 ">
                                  <label for="basiInput" class="form-label">Email</label>
                                  <input type="email" class="form-control" name="email" id="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                              </div>
                              <div class="mb-3 ">
                                  <label for="basiInput" class="form-label">Phone</label>
                                  <input type="text" class="form-control" name="phone" id="phone" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}">
                              </div>
                              <div class="mb-3 ">
                                  <label for="basiInput" class="form-label">Password</label>
                                  <input type="password" class="form-control" name="password" id="password" placeholder="****">
                              </div>


                              <div class="d-flex justify-content-end">
                                  <button class="btn btn-danger ">SUBMIT</button>
                              </div>
                          </form>
                      </div>
                  </div>
               </div>
               <div class="col-md-5">
                   <div class="card">
                       <div class="card-body" >
                           <h3 class="fw-bold mb-5 text-center"> Information</h3>
                           <form action="{{ route('user.detail') }}" method="post" class="">
                               @csrf

                               <div class="mb-3 ">
                                   <label for="messager_id" class="form-label">Messager ID</label>
                                   <input type="text" class="form-control" name="messager_id" id="messager_id" value="{{ \Illuminate\Support\Facades\Auth::user()->detail->messager_id ?? '' }}">
                               </div>
                               <div class="mb-3 ">
                                   <label for="page_id" class="form-label">Page ID</label>
                                   <input type="text" class="form-control" name="page_id" id="page_id" value="{{ \Illuminate\Support\Facades\Auth::user()->detail->page_id ?? '' }}">
                               </div>
                               <div class="mb-3 ">
                                   <label for="address" class="form-label">Address</label>
                                   <input type="text" class="form-control" name="address" id="address" value="{{ \Illuminate\Support\Facades\Auth::user()->detail->address ?? '' }}">
                               </div>


                               <div class="d-flex justify-content-end">
                                   <button class="btn btn-danger ">SUBMIT</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')
    <!-- dropzone min -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
@endsection
