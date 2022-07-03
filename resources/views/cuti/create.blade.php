<!--Create cuti form Modal -->

<div class="modal fade" id="createcuti" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Pengajuan Cuti
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengajuan-cuti.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label class="form-control-label">Jenis Cuti</label>
                                            <select onchange="fileCutiSakit(this)" name="jenis_cuti"
                                                class="form-control @error('jenis_cuti') is-invalid @enderror">
                                                <option selected disabled>Pilih Jenis Cuti</option>
                                                <option value="Cuti tahunan"
                                                    @if (old('jenis_cuti') == 'Cuti tahunan') selected="selected" @endif>Cuti
                                                    tahunan
                                                </option>
                                                <option value="Cuti besar"
                                                    @if (old('jenis_cuti') == 'Cuti besar') selected="selected" @endif>Cuti
                                                    besar</option>
                                                <option value="Cuti bersalin"
                                                    @if (old('jenis_cuti') == 'Cuti bersalin') selected="selected" @endif>Cuti
                                                    bersalin</option>
                                                <option value="Cuti sakit"
                                                    @if (old('jenis_cuti') == 'Cuti sakit') selected="selected" @endif>Cuti
                                                    sakit</option>
                                            </select>
                                            @error('jenis_cuti')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label class="form-control-label">Tanggal mulai</label>
                                            <input name="tanggal_mulai" type="date"
                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                value="{{ old('tanggal_mulai') }}" placeholder="Tanggal Mulai Cuti" />
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label class="form-control-label">Tanggal Selesai</label>
                                            <input name="tanggal_selesai" type="date"
                                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                value="{{ old('tanggal_selesai') }}" placeholder="Berapa Hari Cuti" />
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label class="form-control-label">keterangan</label>
                                            <textarea name="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                                placeholder="Isi keterangan cuti" />{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 mb-3 mb-sm-0" id="ifYes" style="display: none;">
                                            <label class="form-control-label">Surat Dokter(jika melebihi 2-14
                                                hari)</label>
                                            <input name="file_surat_dokter" id="file_surat_dokter" type="file"
                                                placeholder="jika memilih cuti sakit" class="form-control">
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
