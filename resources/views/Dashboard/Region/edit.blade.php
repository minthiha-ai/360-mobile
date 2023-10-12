<button type="button" class="btn btn-outline-warning  btn-sm " data-bs-toggle="modal"
    data-bs-target="#editRegion{{ $region->id }}">
    <i class="bx bx-edit "></i>
</button>
<div id="editRegion{{ $region->id }}" class="modal fade" tabindex="-1"
    aria-labelledby="editRegion{{ $region->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRegion{{ $region->id }}Label">Edit Region</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('region.update', $region->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4 ">
                        <label for="exampleDataList" class="form-label">Region Name</label>
                        <input type="text" value="{{ $region->name }}" class="form-control" name="name"
                            id="name" required>

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
