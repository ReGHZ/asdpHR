<!--Delete divisi Modal -->
<div class="modal fade text-left" id="divisiDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel120">Hapus Divisi
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('divisi.destroy') }}" method="post">
                    @method('delete')
                    @csrf
                    <p class="text-center">Apakah kamu ingin menghapus Divisi ?</p>
                    <input type="hidden" name="divisi_id" id="divisi_id">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-light-secondary rounded-pill" data-bs-dismiss="modal"
                                style="min-width:200px; padding:10px 20px">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger ml-1 rounded-pill" data-bs-dismiss="modal"
                                style="min-width:200px; padding:10px 20px">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Hapus</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
