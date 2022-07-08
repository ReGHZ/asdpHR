<!--penugasan perjalanan dinas Modal -->
<div class="modal fade text-left" id="createperdinas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Penugasan Perjalanan Dinas
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat pengajuan Pegawai!</h1>
                            </div>
                            <form action="{{ route('perjalanan-dinas.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Nama Pegawai</label>
                                    <select class="form-control" name="user_id">
                                        <option selected disabled>Pilih Pegawai</option>
                                        @foreach ($pegawai as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('user_id') == $item->id ? 'selected' : null }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <a onclick="pengikut()">Apakah ada pengikut?<span
                                            class="text-primary">click</span></a>

                                </div>
                                <div class="form-group" style="display: none" id="show">
                                    <label class="form-control-label">Nama Pengikut</label>
                                    <select class="form-control selectpicker" multiple name="pengikut[]">
                                        <option disabled>Pilih Pengikut</option>
                                        @foreach ($pegawai as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('pengikut') == $item->id ? 'selected' : null }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pengikut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Tujuan</label>
                                    <input name="tujuan" id="tujuan" type="text"
                                        placeholder="Tempat tujuan Penugasan"
                                        class="form-control @error('tujuan') is-invalid @enderror"
                                        value="{{ old('tujuan') }}">
                                    @error('tujuan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Perihal</label>
                                    <textarea name="perihal" type="text" class="form-control @error('perihal') is-invalid @enderror"
                                        placeholder="Isi perihal penugasan" />{{ old('perihal') }}</textarea>
                                    @error('perihal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Pembebanan Biaya</label>
                                    <select class="form-control" name="pembebanan_biaya">
                                        <option selected disabled>Pilih pembebanan biaya</option>
                                        @foreach ($divisi as $item)
                                            <option value="{{ $item->nama_divisi }}"
                                                {{ old('pembebanan_biaya') == $item->nama_divisi ? 'selected' : null }}>
                                                {{ $item->nama_divisi }}</option>
                                        @endforeach
                                    </select>
                                    @error('pembebanan_biaya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Tanggal Keberangkatan</label>
                                        <input name="tanggal_keberangkatan" type="date"
                                            class="form-control @error('tanggal_keberangkatan') is-invalid @enderror"
                                            value="{{ old('tanggal_keberangkatan') }}">
                                        @error('tanggal_keberangkatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Tanggal kembali</label>
                                        <input name="tanggal_kembali" type="date"
                                            class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                            value="{{ old('tanggal_kembali') }}">
                                        @error('tanggal_kembali')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Berkendaraan</label>
                                        <input name="jenis_kendaraan" type="text" placeholder="jenis kendaraan"
                                            class="form-control @error('jenis_kendaraan') is-invalid @enderror"
                                            value="{{ old('jenis_kendaraan') }}">
                                        @error('jenis_kendaraan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Keterangan Lain ?</label>
                                        <input name='keterangan' type="text" placeholder="Keterangan lain"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            value="{{ old('keterangan') }}">
                                        @error('keterangan')
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
                    <span class="d-none d-sm-block">Tidak</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
