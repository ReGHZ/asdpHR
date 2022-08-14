<!--Create Divisi form Modal -->

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Divisi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('divisi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label class="form-control-label">Divisi</label>
                                            <input name="nama_divisi" type="text"
                                                class="form-control @error('nama_divisi') is-invalid @enderror"
                                                value="{{ old('nama_divisi') }}" placeholder="Divisi" />
                                            @error('nama_divisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label class="form-control-label">Deskripsi</label>
                                            <textarea name="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                                value="{{ old('deskripsi') }}"
                                                placeholder="Isi keterangan Divisi" /></textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tambah</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
