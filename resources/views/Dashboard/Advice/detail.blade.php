
<button type="button" class="btn btn-outline-success  btn-sm " data-bs-toggle="modal" data-bs-target="#adviceDetail{{ $advice->id }}">
    <i class="bx bx-info-circle "></i>
</button>
<div id="adviceDetail{{ $advice->id }}" class="modal fade" tabindex="-1" aria-labelledby="adviceDetail{{ $advice->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adviceDetail{{ $advice->id }}Label">Advice Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body" style="white-space: normal !important;">

                <div class="text-center mb-3 ">
                    <img src="{{ asset('storage/advice_photo/'.$advice->photo) }}" width="200" alt="">
                </div>

                <h3>{{ $advice->title }} </h3>

                {{ $advice->description }}

                    <h4 class="mt-3 ">Advie From : {{ $advice->user->name }}</h4>

                    <div class="text-end mt-3 ">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">GO BACK</button>
                        <button class="btn btn-danger btn-sm " onclick="confirm('{{ $advice->name }}','{{ $advice->id }}')">
                            <i class='bx bx-trash'></i>
                        </button>
                        <form action="{{ route('advice.destroy',$advice->id) }}" id="BrandDel{{ $advice->id }}" method="post">
                            @csrf @method("DELETE")
                        </form>
                    </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
