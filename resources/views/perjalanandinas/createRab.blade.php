@extends('layouts.panel')
@section('content')
    <div class="page-heading" id="rab">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>RAB perjalanan Dinas</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            {{-- Alert --}}
            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible show fade"><i class="bi bi-check-circle"></i>
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible show fade"><i class="bi bi-file-excel"></i>
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($penugasan->pengikut->count() > 0)
                <div class="text-end mb-2">
                    <button class="btn btn-primary pengikutRab" data-bs-toggle="modal" data-bs-target="#createRAB">

                        <span>{{ $penugasan->pengikut->count() }}</span>
                        Pengikut

                    </button>
                </div>
            @endif

            <form action="{{ route('perjalanan-dinas.storeRab') }}" method="POST">
                <input type="hidden" value="{{ $penugasan->id }}" name="penugasan_id">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-3">
                                @csrf
                                <button type="submit">submit</button>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Tiket Perjalanan!</h1>
                                    <p>{{ $penugasan->pengikut[0]->user->name }}</p>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Nama maskapai</label>
                                        <input name='maskapai[]' type="text" placeholder="nama maskapai"
                                            class="form-control @error('maskapai') is-invalid @enderror"
                                            value="{{ old('maskapai') }}">
                                        @error('maskapai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Harga Tiket</label>
                                        <input name='harga_tiket[]' id="hargatiket" type="text" placeholder="Harga Tiket"
                                            class="form-control @error('harga_tiket') is-invalid @enderror"
                                            v-model="yangditugaskan.harga_tiket">
                                        @error('harga_tiket')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Dari</label>
                                        <input name='tempat_berangkat[]' type="text" placeholder="Tempat berangkat"
                                            class="form-control @error('tempat_berangkat') is-invalid @enderror"
                                            value="{{ old('tempat_berangkat') }}">
                                        @error('tempat_berangkat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Ke</label>
                                        <input name='tempat_tujuan[]' type="text" placeholder="Tujuan"
                                            class="form-control @error('tempat_tujuan') is-invalid @enderror"
                                            value="{{ old('tempat_tujuan') }}">
                                        @error('tempat_tujuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Charge</label>
                                    <input class="form-control @error('charge') is-invalid @enderror" name='charge[]'
                                        id="charge" type="text" placeholder="Charge" v-model="yangditugaskan.charge">
                                    @error('charge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Jumlah</label>
                                    <input class="form-control" readonly id="jumlah_harga" name="jumlah_harga[]"
                                        placeholder="NaN" :value="jumlah_tiket(yangditugaskan)">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Biaya Harian</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Lama Hari</label>
                                        <input id="lama_hari" readonly type="text" class="form-control"
                                            v-model="yangditugaskan.lama_hari">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Biaya harian</label>
                                        <input name='biaya_harian[]' id="biaya_harian" type="text"
                                            placeholder="Biaya Harian"
                                            class="form-control @error('biaya_harian') is-invalid @enderror"
                                            v-model="yangditugaskan.biaya_harian">
                                        @error('biaya_harian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Jumlah</label>
                                    <input class="form-control" readonly id="hasilharian" name="jumlah_biaya_harian[]"
                                        placeholder="NaN" :value="jumlah_harian(yangditugaskan)">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Biaya penginapan!</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Lama Hari</label>
                                        <input name="qty_penginapan[]" id="qtypenginap" type="text"
                                            class="form-control @error('qty_penginapan') is-invalid @enderror"
                                            placeholder="jumlah" v-model="yangditugaskan.lama_hari_penginap">
                                        @error('qty_penginapan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Biaya Penginapan</label>
                                        <input name='biaya_penginapan[]' id="biaya_penginapan" type="text"
                                            placeholder="Biaya Penginapan"
                                            class="form-control @error('biaya_penginapan') is-invalid @enderror"
                                            v-model="yangditugaskan.biaya_penginapan">
                                        @error('biaya_penginapan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Jumlah</label>
                                    <input class="form-control" readonly id="hasilpenginapan"
                                        name="jumlah_biaya_penginapan[]" placeholder="NaN"
                                        :value="jumlah_penginapan(yangditugaskan)">
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
                                            <input class="btn btn-primary " type="button" id="tambah" value="Tambah"
                                                @click="tambahBiayaLain(yangditugaskan)">
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
                                                    <tr v-for="(value, i) in yangditugaskan.biaya_lain"
                                                        :key="i">
                                                        <td><input name="qty_lain[]" :id="'qtyLain' + i" type="text"
                                                                v-model="value.qty" class="form-control"
                                                                placeholder="jumlah">
                                                        </td>
                                                        <td><input name="jenis[]" type="text" v-model="value.jenis"
                                                                class="form-control" placeholder="jenis biaya lainnya">
                                                        </td>
                                                        <td><input name="biaya_lain[]" :id="'biaya_lain' + i"
                                                                type="text" v-model="value.biaya" class="form-control"
                                                                placeholder="harga biaya lain">
                                                        </td>
                                                        <td>

                                                            <button class="hapus btn btn-danger mr-2" type="button"
                                                                id="hapus"
                                                                @click="yangditugaskan.biaya_lain.splice(i, 1)">Hapus</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah</label>
                                        <input class="form-control" name="jumlah_biaya_lain[]" readonly id="hasillain"
                                            placeholder="NaN" :value="jumlah_lain(yangditugaskan)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Total</label>
                                    <input class="form-control" readonly id="totalsemua" placeholder="NaN"
                                        :value="jumlah_keseluruhan(yangditugaskan)" name="total[]">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                {{-- rab pengikut --}}
                <div v-if="data_pengikut.length">
                    <div class="row" v-for="(pengikut,i) in data_pengikut" :key="i">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-3">
                                    <div>
                                        <p>pengikut <span></span></p>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tiket Perjalanan!</h1>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="form-control-label">Nama maskapai</label>
                                            <input name='maskapai[]' type="text" placeholder="nama maskapai"
                                                class="form-control" readonly :value="pengikut.maskapai">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-control-label">Harga Tiket</label>
                                            <input name='harga_tiket[]' id="hargatiket" type="text"
                                                placeholder="Harga Tiket" class="form-control" readonly
                                                :value="pengikut.harga_tiket">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="form-control-label">Dari</label>
                                            <input name='tempat_berangkat[]' type="text"
                                                placeholder="Tempat berangkat" class="form-control" readonly
                                                :value="pengikut.dari">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-control-label">Ke</label>
                                            <input name='tempat_tujuan[]' type="text" placeholder="Tujuan"
                                                class="form-control" readonly :value="pengikut.ke">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Charge</label>
                                        <input class="form-control" name='charge[]' id="charge" type="text"
                                            placeholder="Charge" readonly :value="pengikut.charge">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah</label>
                                        <input class="form-control" readonly id="jumlah_harga" name="jumlah_harga[]"
                                            placeholder="NaN" :value="pengikut.jumlah_tiket">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Biaya Harian</h1>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="form-control-label">Lama Hari</label>
                                            <input id="lama_hari" readonly type="text" class="form-control"
                                                :value="pengikut.lama_hari">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-control-label">Biaya harian</label>
                                            <input name='biaya_harian[]' id="biaya_harian" type="text"
                                                placeholder="Biaya Harian" readonly class="form-control"
                                                :value="pengikut.biaya_harian">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah</label>
                                        <input class="form-control" readonly id="hasilharian"
                                            name="jumlah_biaya_harian[]" placeholder="NaN"
                                            :value="pengikut.jumlah_harian">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Biaya penginapan!</h1>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="form-control-label">Lama Hari</label>
                                            <input name="qty_penginapan[]" id="qtypenginap" type="text"
                                                class="form-control" readonly placeholder="jumlah"
                                                :value="pengikut.lama_hari_penginap">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-control-label">Biaya Penginapan</label>
                                            <input name='biaya_penginapan[]' id="biaya_penginapan" type="text"
                                                placeholder="Biaya Penginapan" readonly class="form-control"
                                                :value="pengikut.biaya_penginapan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah</label>
                                        <input class="form-control" readonly id="hasilpenginapan"
                                            name="jumlah_biaya_penginapan[]" placeholder="NaN"
                                            :value="pengikut.jumlah_penginapan">
                                    </div>
                                    <div class="form-group" id="showBiayaLain">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Biaya lainnya!</h1>
                                        </div>
                                        <div class="form-row">
                                            <div class="table-responsive">
                                                <table class="table" id="tabellain">
                                                    <thead>
                                                        <tr>
                                                            <th>Quantity</th>
                                                            <th>jenis</th>
                                                            <th>Biaya</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(lain, i) in pengikut.biaya_lain"
                                                            :key="i">
                                                            <td><input name="qty_lain[]" :id="'qtyLain' + i"
                                                                    type="text" :value="lain.qty"
                                                                    class="form-control" readonly placeholder="jumlah">
                                                            </td>
                                                            <td><input name="jenis[]" type="text"
                                                                    :value="lain.jenis" class="form-control" readonly
                                                                    placeholder="jenis biaya lainnya">
                                                            </td>
                                                            <td><input name="biaya_lain[]" :id="'biaya_lain' + i"
                                                                    type="text" :value="lain.biaya" readonly
                                                                    class="form-control" placeholder="harga biaya lain">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Jumlah</label>
                                            <input class="form-control" name="jumlah_biaya_lain[]" readonly
                                                id="hasillain" placeholder="NaN" :value="pengikut.jumlah_lain">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Total</label>
                                        <input class="form-control" readonly id="totalsemua" placeholder="NaN"
                                            :value="pengikut.jumlah_keseluruhan" name="total[]">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </section>
        <!--RAB Modal -->
        <div class="modal fade text-left" id="createRAB" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title white" id="myModalLabel160">
                            RAB Perjalanan Dinas
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <form action="{{ route('perjalanan-dinas.storeRab') }}" method="POST">
                                        @csrf
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Tiket Perjalanan!</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Nama maskapai</label>
                                                <input name='maskapai' type="text" placeholder="nama maskapai"
                                                    class="form-control @error('maskapai') is-invalid @enderror"
                                                    v-model="pengikut.maskapai">
                                                @error('maskapai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Harga Tiket</label>
                                                <input name='harga_tiket' id="hargatiket" type="text"
                                                    placeholder="Harga Tiket"
                                                    class="form-control @error('harga_tiket') is-invalid @enderror"
                                                    v-model="pengikut.harga_tiket">
                                                @error('harga_tiket')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Dari</label>
                                                <input name='tempat_berangkat' type="text"
                                                    placeholder="Tempat berangkat"
                                                    class="form-control @error('tempat_berangkat') is-invalid @enderror"
                                                    v-model="pengikut.dari">
                                                @error('tempat_berangkat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Ke</label>
                                                <input name='tempat_tujuan' type="text" placeholder="Tujuan"
                                                    class="form-control @error('tempat_tujuan') is-invalid @enderror"
                                                    v-model="pengikut.ke">
                                                @error('tempat_tujuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Charge</label>
                                            <input class="form-control @error('charge') is-invalid @enderror"
                                                name='charge' id="charge" type="text" placeholder="Charge"
                                                v-model="pengikut.charge">
                                            @error('charge')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label">Jumlah</label>
                                            <input class="form-control" readonly id="jumlah_harga" name="jumlah_harga"
                                                placeholder="NaN" :value="jumlah_tiket(pengikut)">
                                        </div>
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Biaya Harian</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Lama Hari</label>
                                                <input id="p_lama_hari" readonly type="text" class="form-control"
                                                    v-model="pengikut.lama_hari">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Biaya harian</label>
                                                <input name='biaya_harian' id="biaya_harian" type="text"
                                                    placeholder="Biaya Harian"
                                                    class="form-control @error('biaya_harian') is-invalid @enderror"
                                                    v-model="pengikut.biaya_harian">
                                                @error('biaya_harian')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Jumlah</label>
                                            <input class="form-control" readonly id="hasilharian"
                                                name="jumlah_biaya_harian" placeholder="NaN"
                                                :value="jumlah_harian(pengikut)">
                                        </div>
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Biaya penginapan!</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Lama Hari</label>
                                                <input name="qty_penginapan" id="qtypenginap" type="text"
                                                    class="form-control @error('qty_penginapan') is-invalid @enderror"
                                                    placeholder="jumlah" v-model="pengikut.lama_hari_penginap">
                                                @error('qty_penginapan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Biaya Penginapan</label>
                                                <input name='biaya_penginapan' id="biaya_penginapan" type="text"
                                                    placeholder="Biaya Penginapan"
                                                    class="form-control @error('biaya_penginapan') is-invalid @enderror"
                                                    v-model="pengikut.biaya_penginapan">
                                                @error('biaya_penginapan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Jumlah</label>
                                            <input class="form-control" readonly id="hasilpenginapan"
                                                name="jumlah_biaya_penginapan" placeholder="NaN"
                                                :value="jumlah_penginapan(pengikut)">
                                        </div>
                                        <div>
                                            <a onclick="biayaLainLain()">Apakah ada Biaya Lainnya?<span
                                                    class="text-primary">click</span></a>
                                        </div>
                                        <div class="form-group" style="display: none" id="showBiayaLainLain">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Biaya lainnya!</h1>
                                            </div>
                                            <div class="form-row">
                                                <div class="text-right">
                                                    <input class="btn btn-primary " type="button" id="tambah"
                                                        value="Tambah" @click="tambahBiayaLain(pengikut)">
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
                                                            <tr v-for="(value, i) in pengikut.biaya_lain"
                                                                :key="i">
                                                                <td><input name="qty_lain[]" :id="'qtyLain' + i"
                                                                        type="text" v-model="value.qty"
                                                                        class="form-control" placeholder="jumlah">
                                                                </td>
                                                                <td><input name="jenis[]" type="text"
                                                                        v-model="value.jenis" class="form-control"
                                                                        placeholder="jenis biaya lainnya">
                                                                </td>
                                                                <td><input name="biaya_lain[]" :id="'biaya_lain' + i"
                                                                        type="text" v-model="value.biaya"
                                                                        class="form-control"
                                                                        placeholder="harga biaya lain">
                                                                </td>
                                                                <td>

                                                                    <button class="hapus btn btn-danger mr-2"
                                                                        type="button" id="hapus"
                                                                        @click="pengikut.biaya_lain.splice(i, 1)">Hapus</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Jumlah</label>
                                                <input class="form-control" name="jumlah_biaya_lain[]" readonly
                                                    id="hasillain" placeholder="NaN" :value="jumlah_lain(pengikut)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Total</label>
                                            <input class="form-control" readonly id="totalsemua" placeholder="NaN"
                                                :value="jumlah_keseluruhan(pengikut)">
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
                        <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal"
                            @click="simpanDataPengikut()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end RAB modal --}}
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    {{-- script show biaya lain --}}
    <script type='text/javascript'>
        function biayaLain() {
            var text = document.getElementById("showBiayaLain");
            if (!text.style.display) {
                text.style.display = "none";
            }
            if (text.style.display === "none") {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }

        function biayaLainLain() {
            var text = document.getElementById("showBiayaLainLain");
            if (!text.style.display) {
                text.style.display = "none";
            }
            if (text.style.display === "none") {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
    </script>
    <script>
        let vue = Vue.createApp({
            data() {
                return {
                    yangditugaskan: {
                        biaya_lain: [{
                            qty: null,
                            jenis: null,
                            biaya: null
                        }],
                        harga_tiket: null,
                        charge: null,
                        lama_hari: {!! $penugasan->lama_hari !!},
                        biaya_harian: null,
                        lama_hari_penginap: null,
                        biaya_penginapan: null,
                    },
                    pengikut: {
                        biaya_lain: [{
                            qty: null,
                            jenis: null,
                            biaya: null
                        }],
                        harga_tiket: null,
                        ke: null,
                        dari: null,
                        charge: null,
                        lama_hari: {!! $penugasan->lama_hari !!},
                        biaya_harian: null,
                        lama_hari_penginap: null,
                        biaya_penginapan: null,
                        maskapai: null
                    },
                    data_pengikut: []
                }
            },
            methods: {
                jumlah_tiket(variable) {
                    return +variable.harga_tiket + (+variable.charge ?? 0);
                },
                jumlah_lain(variable) {
                    let count = 0
                    variable.biaya_lain.map(function(val) {
                        count += (+val.qty * +val.biaya)
                    });
                    return count;
                },
                jumlah_harian(variable) {
                    return +variable.lama_hari * +variable.biaya_harian;
                },
                jumlah_penginapan(variable) {
                    return (+variable.lama_hari_penginap ?? 0) * (+variable
                        .biaya_penginapan ?? 0);
                },
                jumlah_keseluruhan(variable) {
                    return this.jumlah_lain(variable) + this.jumlah_harian(variable) + this.jumlah_tiket(variable) +
                        this
                        .jumlah_penginapan(variable);
                },
                tambahBiayaLain(variable) {
                    console.log('tambahBiayaLain')
                    let biaya_lain = {
                        qty: null,
                        jenis: null,
                        biaya: null
                    };

                    variable.biaya_lain.push(biaya_lain);
                },
                simpanDataPengikut() {
                    this.data_pengikut.push({
                        ...this.pengikut,
                        jumlah_tiket: this.jumlah_tiket(this.pengikut),
                        jumlah_lain: this.jumlah_lain(this.pengikut),
                        jumlah_harian: this.jumlah_harian(this.pengikut),
                        jumlah_penginapan: this.jumlah_penginapan(this.pengikut),
                        jumlah_keseluruhan: this.jumlah_keseluruhan(this.pengikut),
                    })
                    this.pengikut = {
                        biaya_lain: [{
                            qty: null,
                            jenis: null,
                            biaya: null
                        }],
                        harga_tiket: null,
                        ke: null,
                        dari: null,
                        charge: null,
                        lama_hari: {!! $penugasan->lama_hari !!},
                        biaya_harian: null,
                        lama_hari_penginap: null,
                        biaya_penginapan: null,
                        maskapai: null
                    }
                }
            }
        }).mount('#rab')
    </script>
@endpush
