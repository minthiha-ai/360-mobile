@extends('Dashboard.layouts.app')
@section('style')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/js/image-uploader/image-uploader.min.css') }}">

@endsection
@section('search')
    <!-- App Search-->
    <form class="app-search d-none " action="{{ route('user.index') }}" method="get">
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
                <div class="col-md-7  ">
                    <div class="card">
                        <div class="card-body" >
                            <form action="{{ route('product.store') }}" id="createProduct"  method="post"  enctype="multipart/form-data" >
                                @csrf
                                <h3 class="text-center ">Create Product</h3>

                                <div class="row ">
                                    <div class="mb-3 col-6">
                                        <label for="basiInput" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="basiInput" class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                        @error('price')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-6 ">
                                        <label for="basiInput" class="form-label">Stock</label>
                                        <input type="number" class="form-control" name="stock" value="{{ old('stock') }}">
                                        @error('stock')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-6 ">
                                        <label for="basiInput" class="form-label">Color</label>
                                        <textarea name="color" class="form-control " id="" cols="10" rows="1" placeholder="product color">{{ old('color') }}</textarea>
                                        @error('color')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-6 ">
                                        <label for="basiInput" class="form-label">Category</label>
                                        <select name="category_id" id="" class="form-select">
                                            <option value="" selected disabled>choose your product category</option>
                                            @forelse(\App\Models\Category::all() as $c)
                                                <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }} > {{ $c->name }}</option>
                                            @empty
                                                <option value="">NO DATA FOUND</option>
                                            @endforelse
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6 ">
                                        <label for="basiInput" class="form-label">Brand</label>
                                        <select name="brand_id" id="" class="form-select">
                                            <option value="" selected disabled>choose your product brand</option>
                                            @forelse(\App\Models\Brand::all() as $b)
                                                <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }} > {{ $b->name }}</option>
                                            @empty
                                                <option value="" class="disabled">NO DATA FOUND</option>
                                            @endforelse
                                        </select>
                                        @error('brand_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3 ">
                                    <label for="basiInput" class="form-label">Detail</label>
                                    <textarea name="detail" class="form-control" id="" cols="30" rows="10"> {{ old('detail') }}</textarea>
                                    @error('detail')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>



                               <div class="text-end">
                                   <button type="submit" class="btn btn-danger ">SUBMIT</button>
                               </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" >
                                <label for="images"> Product Photos
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="input-images" id="images"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    @include('Dashboard.Alert.imageModal')

@endsection


@section('script')

    <script src="{{ asset('assets/js/image-uploader/image-uploader.min.js') }}"></script>
{{--    <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>--}}

    <script>
        // $("#summernote").summernote({
        //     toolbar: [
        //         // [groupName, [list of button]]
        //         ["style", ["bold", "italic", "underline", "clear"]],
        //         ["font", ["strikethrough", "superscript", "subscript"]],
        //         ["fontsize", ["fontsize"]],
        //         ["color", ["color"]],
        //         ["para", ["ul", "ol", "paragraph"]],
        //         ["height", ["height"]],
        //     ],
        //     height: 200,
        // });

        $(".input-images").imageUploader({
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10,
            extensions:['.jpg', '.jpeg', '.png','.svg','.JPG','.JPEG','.PNG']
        });

        $(document).ready(function() {

            document.querySelector('input[type="file"]').setAttribute('form','createProduct');
        });

        // document.querySelector("#ckeditor-classic") &&
        // ClassicEditor.create(document.querySelector("#ckeditor-classic"))
        //     .then(function (e) {
        //         e.ui.view.editable.element.style.height = "200px";
        //     })
        //     .catch(function (e) {
        //         console.error(e);
        //     });
    </script>
@endsection
