
<button type="button" class="btn btn-outline-success  btn-sm " data-bs-toggle="modal" data-bs-target="#userDetail{{ $user->id }}">
    <i class="bx bx-info-circle "></i>
</button>
<div id="userDetail{{ $user->id }}" class="modal fade" tabindex="-1" aria-labelledby="userDetail{{ $user->id }}Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body" style="white-space: normal !important;">

                <div class="text-center">
                    <h5 class="modal-title" id="userDetail{{ $user->id }}Label">User Detail</h5>

                </div>
                <div class="card">
                    <div class="card-body r ">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr>
                                    <th class="ps-0" scope="row">Full Name :</th>
                                    <td class="text-end ">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Phone :</th>
                                    <td class="text-end ">{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Email :</th>
                                    <td class="text-end ">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Joining Date</th>
                                    <td class="text-end ">{{ $user->created_at->format('d M Y') }}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div>

                <div class="text-end mt-3 ">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">GO BACK</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
