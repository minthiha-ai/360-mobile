<button type="button" class="btn btn-outline-warning  btn-sm " data-bs-toggle="modal"
    data-bs-target="#editDeliveryfee{{ $deliveryfee->id }}">
    <i class="bx bx-edit "></i>
</button>
<div id="editDeliveryfee{{ $deliveryfee->id }}" class="modal fade" tabindex="-1"
    aria-labelledby="editDeliveryfee{{ $deliveryfee->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeliveryfee{{ $deliveryfee->id }}Label">Edit Delivery Fees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('deliveryfee.update', $deliveryfee->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label for="basiInput" class="form-label">Region</label>
                        <select name="region_id" id="" class="form-select">
                            <option value="" selected disabled>choose your Region</option>
                            @forelse(\App\Models\Region::all() as $r)
                                <option value="{{ $r->id }}" {{ old('region_id',$deliveryfee->region_id) == $r->id ? 'selected' : '' }} > {{ $r->name }}</option>
                            @empty
                                <option value="">NO DATA FOUND</option>
                            @endforelse
                        </select>
                        @error('region_id')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 ">
                        <label for="exampleDataList" class="form-label">Township</label>
                        <input type="text" value="{{ $deliveryfee->township }}" class="form-control" name="township"
                            id="township">

                    </div>
                    <div class="mb-4 ">
                        <label for="exampleDataList" class="form-label">Delivery Fees</label>
                        <input type="text" value="{{ $deliveryfee->fees }}" class="form-control" name="fees"
                            id="fees">

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
