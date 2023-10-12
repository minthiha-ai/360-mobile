
<button type="button" class="btn btn-outline-warning  btn-sm " data-bs-toggle="modal" data-bs-target="#editCategory{{ $cat->id }}">
    <i class="bx bx-edit "></i>
</button>
<div id="editCategory{{ $cat->id }}" class="modal fade" tabindex="-1" aria-labelledby="editCategory{{ $cat->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategory{{ $cat->id }}Label">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.update',$cat->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3 ">
                        <label for="basiInput" class="form-label">Name</label>
                        <input type="text" required class="form-control" name="name" id="name" value="{{ $cat->name }}">
                    </div>

                    <div class="mb-3 ">
                        @if($cat->photo == 'cat.png')
                            <img src="{{ asset('assets/images/brands/'.$cat->photo) }}" id="previewImg{{ $cat->id }}" onclick="document.getElementById('photo'+{{ $cat->id }}).click()" width="150" style="object-fit: cover" alt="">
                        @else
                            <img src="{{ asset('storage/category_photo/'.$cat->photo) }}" id="previewImg{{ $cat->id }}" onclick="document.getElementById('photo'+{{ $cat->id }}).click()" width="150" alt="">
                        @endif
                        <input type="file" hidden  class="form-control" name="photo" id="photo{{ $cat->id }}" onchange="chageImg('{{ $cat->id }}')">
                    </div>

                    <div class="text-end mt-3 ">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


