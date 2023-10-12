
<button type="button" class="btn btn-outline-warning  btn-sm " data-bs-toggle="modal" data-bs-target="#editPayment{{ $payment->id }}">
    <i class="bx bx-edit "></i>
</button>
<div id="editPayment{{ $payment->id }}" class="modal fade" tabindex="-1" aria-labelledby="editPayment{{ $payment->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPayment{{ $payment->id }}Label">Edit Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.update',$payment->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4 ">
                        <label for="exampleDataList" class="form-label">Payment Name</label>
                        <input type="text" value="{{ $payment->payment_name }}"  class="form-control" name="payment_name" id="name">

                    </div>

                    <div class="mb-3 ">
                        <label for="basiInput" class="form-label">Payment Number</label>
                        <input type="text" value="{{ $payment->payment_number}}"  class="form-control" name="payment_number" id="address">
                    </div>

                    {{-- <div class="mb-3 ">
                        <label for="basiInput" class="form-label">Payment Image</label>
                        <input type="file"   class="form-control" name="pimage" id="pimage">
                    </div> --}}

                    <div class="mb-3 ">
                        <label for="basiInput" class="form-label">Payment Image</label>
                        <img src="{{ asset('storage/payment_photo/'.$payment->payment_image) }}" id="previewImg" onclick="document.getElementById('pimage').click()" width="150" alt="">
                        <input type="file" hidden  class="form-control" name="pimage" id="pimage" onchange="chageImg()">
                    </div>


                    <div class="mb-3 ">
                        <label for="basiInput" class="form-label">Payment Qr</label>
                        <img src="{{ asset('storage/payment_photo/'.$payment->payment_qr) }}" id="previewImgqr" onclick="document.getElementById('qrimage').click()" width="150" alt="">
                        <input type="file" hidden  class="form-control" name="qrimage" id="qrimage" onchange="chageImgqr()">
                    </div>

                    {{-- <div class="mb-3 ">

                        <input type="file"   class="form-control" name="qrimage" id="qrimage">
                    </div> --}}

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
        let file = document.getElementById('pimage').files[0];
        let reader = new FileReader();

        reader.addEventListener("load",function (){
            preview.src = reader.result;
        })

        if(file){
            reader.readAsDataURL(file);
        }
        console.log(file);
    }

    function chageImgqr()
    {
        let previewQr = document.getElementById('previewImgqr');
        let file = document.getElementById('qrimage').files[0];
        let reader = new FileReader();

        reader.addEventListener("load",function (){
            previewQr.src = reader.result;
        })

        if(file){
            reader.readAsDataURL(file);
        }
        console.log(file);
    }
</script>
