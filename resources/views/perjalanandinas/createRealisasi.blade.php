<!--Real RAB Modal -->
<div class="modal fade text-left" id="createRealisasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel160">Realisasi Biaya Perjalanan Dinas
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" id="realisasi_id" name="realisasi_id">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Tiket Perjalanan!</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Nama maskapai</label>
                                        <input id="maskapai" name='maskapai' type="text" placeholder="nama maskapai"
                                            class="form-control @error('maskapai') is-invalid @enderror"
                                            value="{{ old('maskapai') }}">
                                        @error('maskapai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Harga Tiket</label>
                                        <input name='harga_tiket' id="harga_tiket" type="text"
                                            placeholder="Harga Tiket"
                                            class="form-control @error('harga_tiket') is-invalid @enderror"
                                            value="{{ old('harga_tiket') }}">
                                        @error('harga_tiket')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Dari</label>
                                        <input id="tempat_berangkat" name='tempat_berangkat' type="text"
                                            placeholder="Tempat berangkat"
                                            class="form-control @error('tempat_berangkat') is-invalid @enderror"
                                            value="{{ old('tempat_berangkat') }}">
                                        @error('tempat_berangkat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Ke</label>
                                        <input id="tempat_tujuan" name='tempat_tujuan' type="text"
                                            placeholder="Tujuan"
                                            class="form-control @error('tempat_tujuan') is-invalid @enderror"
                                            value="{{ old('tempat_tujuan') }}">
                                        @error('tempat_tujuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Charge</label>
                                    <input class="form-control @error('charge') is-invalid @enderror" name='charge'
                                        id="charge" type="text" placeholder="Charge"
                                        value="{{ old('charge') }}">
                                    @error('charge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Jumlah</label>
                                    <input class="form-control" readonly id="jumlah_harga" name="jumlah_harga"
                                        placeholder="NaN">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Biaya Harian</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Lama Hari</label>
                                        <input id="lama_hari" readonly type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Biaya harian</label>
                                        <input name='biaya_harian' id="biaya_harian" type="text"
                                            placeholder="Biaya Harian"
                                            class="form-control @error('biaya_harian') is-invalid @enderror"
                                            value="{{ old('biaya_harian') }}">
                                        @error('biaya_harian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Total</label>
                                    <input class="form-control" readonly id="hasilharian" name="jumlah_biaya_harian"
                                        placeholder="NaN">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Biaya penginapan!</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">quantity</label>
                                        <input name="qty_penginapan" id="qtypenginap" type="text"
                                            class="form-control @error('qty_penginapan') is-invalid @enderror"
                                            placeholder="jumlah" value="{{ old('qty_penginapan') }}">
                                        @error('qty_penginapan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Biaya Penginapan</label>
                                        <input name='biaya_penginapan' id="biaya_penginapan" type="text"
                                            placeholder="Biaya Penginapan"
                                            class="form-control @error('biaya_penginapan') is-invalid @enderror"
                                            value="{{ old('biaya_penginapan') }}">
                                        @error('biaya_penginapan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Jumlah</label>
                                    <input class="form-control" readonly id="hasilpenginapan"
                                        name="jumlah_biaya_penginapan" placeholder="NaN">
                                </div>
                                <div>
                                    <a onclick="biayaLain()">Apakah ada Biaya Lainnya?<span
                                            class="text-primary">click</span></a>
                                </div>
                                <div class="form-group" style="display: none" id="showBiayaLain">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Biaya lainnya!</h1>
                                    </div>
                                    <div class="form-row">
                                        <div class="text-right">
                                            <input class="btn btn-primary " type="button" data-bs-toggle="modal"
                                                data-bs-target="#lain" value="Tambah">
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="tabellain">
                                                <thead>
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <th>jenis</th>
                                                        <th>Biaya</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($biayaLain as $item)
                                                        <tr>
                                                            <td><input name="qty_lain[]" id="qtyLain"
                                                                    type="text" value="{{ $item->qty }}"
                                                                    class="form-control" placeholder="jumlah"></td>
                                                            <td><input name="jenis[]" type="text"
                                                                    value="{{ $item->jenis }}" class="form-control"
                                                                    placeholder="jenis biaya lainnya"></td>
                                                            <td><input name="biaya_lain[]" id="biaya_lain"
                                                                    type="text" value="{{ $item->biaya }}"
                                                                    class="form-control"
                                                                    placeholder="harga biaya lain">
                                                            </td>
                                                            <td>

                                                                <input class="hapus btn btn-danger mr-2 hapus"
                                                                    type="button" data-id="{{ $item->id }}"
                                                                    id="hapus" value="Hapus">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah</label>
                                        <input class="form-control" name="jumlah_biaya_lain[]" readonly
                                            id="hasillain" placeholder="NaN">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Total</label>
                                    <input class="form-control" readonly id="totalsemua" placeholder="NaN">
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
                <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- <!--Lain Modal -->
<div class="modal fade text-left" id="lain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel160">Biaya Lain
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" id="perjalanan_dinas_id" name="perjalanan_dinas_id"
                                    value="{{ $penugasan->id }}">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity</label>
                                    <input class="form-control" id="hasilpenginapan" name="qty"
                                        placeholder="jumlah">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">jenis</label>
                                    <input class="form-control" id="hasilpenginapan" name="jenis"
                                        placeholder="jenis biaya lain">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Biaya</label>
                                    <input class="form-control" id="hasilpenginapan" name="biaya"
                                        placeholder="harga biaya lain">
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
                <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block simpan">Simpan</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
