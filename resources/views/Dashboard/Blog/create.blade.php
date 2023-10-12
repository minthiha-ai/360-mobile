@extends('Dashboard.layouts.app')
@section('style')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/js/image-uploader/image-uploader.min.css') }}">
@endsection
@section('search')
    <!-- App Search-->
    <form class="app-search d-none " action="{{ route('blog.index') }}" method="get">
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
                        <div class="card-body">
                            <form action="{{ route('blog.store') }}" id="createBlog" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-center ">Create Blog</h3>

                                <div class="row ">
                                    <div class="mb-3 col-6">
                                        <label for="basiInput" class="form-label">Tilte</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="basiInput" class="form-label">Sub Title</label>
                                        <input type="text" class="form-control" name="subTitle"
                                            value="{{ old('subTitle') }}">
                                        @error('subTitle')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3 ">
                                    <label for="basiInput" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"> {{ old('description') }}</textarea>
                                    @error('description')
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
                            <div class="form-group">
                                <label for="image"> Blog Photos
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="input-images"></div>
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
    {{--    <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}

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
            extensions: ['.jpg', '.jpeg', '.png', '.svg', '.JPG', '.JPEG', '.PNG'],
            imagesInputName: 'photo'
        });

        $(document).ready(function() {

            document.querySelector('input[type="file"]').setAttribute('form', 'createBlog');
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
