
<button type="button" class="btn btn-outline-warning  btn-sm " data-bs-toggle="modal" data-bs-target="#editCategory{{ $banner->id }}">
    <i class="bx bx-edit "></i>
</button>
<div id="editCategory{{ $banner->id }}" class="modal fade" tabindex="-1" aria-labelledby="editCategory{{ $banner->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategory{{ $banner->id }}Label">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('banner.update',$banner->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')


                    <div class="mb-3 ">
                        <img src="{{ asset('storage/banner_photo/'.$banner->photo) }}" id="previewImg" onclick="document.getElementById('photo').click()" width="150" alt="">
                        <input type="file" hidden  class="form-control" name="photo" id="photo" onchange="chageImg()">
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

<script>

    function chageImg()
    {
        let preview = document.getElementById('previewImg');
        let file = document.getElementById('photo').files[0];
        let reader = new FileReader();

        reader.addEventListener("load",function (){
            preview.src = reader.result;
        })

        if(file){
            reader.readAsDataURL(file);
        }
        console.log(file);
    }
</script>
