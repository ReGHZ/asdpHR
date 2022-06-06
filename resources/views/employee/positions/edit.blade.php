<!--Edit jabatan form Modal -->

<div class="modal fade" id="jabatanedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Jabatan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jabatan.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="jab_id" id="jab_id" />

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label class="form-control-label">Jabatan</label>
                                            <input name="nama_jabatan" id="nama_jabatan" type="text"
                                                class="form-control @error('nama_jabatan') is-invalid @enderror"
                                                value="{{ old('nama_jabatan') }}" placeholder="Jabatan" />
                                            @error('nama_jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label class="form-control-label">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                                value="{{ old('deskripsi') }}"
                                                placeholder="Keterangan Jabatan" /></textarea>
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
                    <span class="d-none d-sm-block">Update

                    </span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
