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


            <div class="row mb-2">
                <div class="col">
                    <a href="{{ route('perjalanan-dinas') }}" class="btn icon btn-primary me-1"><i
                            data-feather="arrow-left"></i>
                        Kembali
                    </a>

                    <button class="btn btn-success pengikutRab" data-bs-toggle="modal" data-bs-target="#createRAB">
                        Tambah RAB
                    </button>

                </div>
            </div>


            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah tiket</th>
                                <th>Jumlah harian</th>
                                <th>Jumlah Penginapan</th>
                                <th>jumlah Lainnya</th>
                                <th>Total</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rab as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->pengikut->user->name }}</td>
                                    <td>{{ $row->jumlah_harga_tiket }}</td>
                                    <td>{{ $row->jumlah_biaya_harian }}</td>
                                    <td>{{ $row->jumlah_biaya_penginapan }}</td>
                                    <td>{{ $row->jumlah_biaya_lain }}</td>
                                    <td>{{ $row->total }}</td>
                                    <td>
                                        <div class="dropdown position-static">
                                            <a class="dropdown" href="#" role="button" id="actionlink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>

                                            <ul class="dropdown-menu shadow" aria-labelledby="actionlink"
                                                style="min-width:inherit;">
                                                @role('admin|manajer')
                                                    <li><a href="{{ route('perjalanan-dinas.rab', $row->id) }}"
                                                            class="dropdown-item"><i class="bi bi-eye text-success"></i>
                                                            Lihat form RAB</a></li>
                                                    <li>
                                                    @endrole

                                                    @role('admin|manajer')
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="{{ $row->id }}" class="dropdown-item btnRabDel"><i
                                                                class="bi bi-exclamation-circle text-danger"></i>
                                                            Hapus
                                                        </button>

                                                    </li>
                                                @endrole
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

        <!--RAB Modal -->
        <div class="modal fade text-left" id="createRAB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
            aria-hidden="true">
            <form action="{{ route('perjalanan-dinas.storeRab') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $penugasan->id }}" name="penugasan_id">
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
                                        <div class="form-group">
                                            <label class="form-control-label">Nama Pegawai</label>
                                            <select class="form-control" name="pengikut_id">
                                                <option selected disabled>Pilih Pegawai</option>
                                                @foreach ($penugasan->pengikut as $item)
                                                    <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pengikut_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Tiket Perjalanan!</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Nama maskapai</label>
                                                <input name='maskapai' type="text" placeholder="nama maskapai"
                                                    class="form-control @error('maskapai') is-invalid @enderror"
                                                    v-model="yangditugaskan.maskapai">
                                                @error('maskapai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Harga Tiket</label>
                                                <input name='harga_tiket' id="hargatiket" type="text"
                                                    placeholder="Harga Tiket"
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
                                                <input name='tempat_berangkat' type="text"
                                                    placeholder="Tempat berangkat"
                                                    class="form-control @error('tempat_berangkat') is-invalid @enderror"
                                                    v-model="yangditugaskan.dari">
                                                @error('tempat_berangkat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Ke</label>
                                                <input name='tempat_tujuan' type="text" placeholder="Tujuan"
                                                    class="form-control @error('tempat_tujuan') is-invalid @enderror"
                                                    v-model="yangditugaskan.ke">
                                                @error('tempat_tujuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Charge</label>
                                            <input class="form-control @error('charge') is-invalid @enderror"
                                                name='charge' id="charge" type="text" placeholder="Charge"
                                                v-model="yangditugaskan.charge">
                                            @error('charge')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label">Jumlah</label>
                                            <input class="form-control" readonly id="jumlah_harga"
                                                name="jumlah_harga_tiket" placeholder="NaN"
                                                :value="jumlah_tiket(yangditugaskan)">
                                        </div>
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Biaya Harian</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Lama Hari</label>
                                                <input id="p_lama_hari" readonly type="text" class="form-control"
                                                    v-model="yangditugaskan.lama_hari">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Biaya harian</label>
                                                <input name='biaya_harian' id="biaya_harian" type="text"
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
                                            <input class="form-control" readonly id="hasilharian"
                                                name="jumlah_biaya_harian" placeholder="NaN"
                                                :value="jumlah_harian(yangditugaskan)">
                                        </div>
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Biaya penginapan!</h1>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label class="form-control-label">Lama Hari</label>
                                                <input name="lama_hari_penginap" id="qtypenginap" type="text"
                                                    class="form-control @error('lama_hari_penginap') is-invalid @enderror"
                                                    placeholder="jumlah" v-model="yangditugaskan.lama_hari_penginap">
                                                @error('lama_hari_penginap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-control-label">Biaya Penginapan</label>
                                                <input name='biaya_penginapan' id="biaya_penginapan" type="text"
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
                                                name="jumlah_biaya_penginapan" placeholder="NaN"
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
                                                    <input class="btn btn-primary " type="button" id="tambah"
                                                        value="Tambah" @click="tambahBiayaLain(yangditugaskan)">
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
                                                                <td><input name="qty[]" :id="'qtyLain' + i"
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
                                                                        @click="yangditugaskan.biaya_lain.splice(i, 1)">Hapus</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Jumlah</label>
                                                <input class="form-control" name="jumlah_biaya_lain" readonly
                                                    id="hasillain" placeholder="NaN" :value="jumlah_lain(yangditugaskan)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Total</label>
                                            <input name="total" class="form-control" readonly id="totalsemua"
                                                placeholder="NaN" :value="jumlah_keseluruhan(yangditugaskan)">
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
                    </div>
                </div>
            </form>
        </div>
        {{-- end RAB modal --}}

        <!-- Delete RAB Modal -->
        <div class="modal fade text-left" id="rabDelete" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">Hapus RAB perjalanan Dinas
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('perjalanan-dinas.destroyRab') }}" method="post">
                            @method('delete')
                            @csrf
                            <p class="text-center">Apakah kamu ingin menghapus RAB ?</p>
                            <input type="hidden" name="rab_id" id="rab_id">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-light-secondary rounded-pill"
                                        data-bs-dismiss="modal" style="min-width:200px; padding:10px 20px">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger ml-1 rounded-pill"
                                        data-bs-dismiss="modal" style="min-width:200px; padding:10px 20px">
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
        {{-- end Delete RAB modal --}}
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

        $(document).on('click', '.btnRabDel', function() {
            var rab_id = $(this).val();
            // alert(cuti_id);
            $('#rabDelete').modal('show');
            $('#rab_id').val(rab_id);
        });
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
                    }
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
                }
            }
        }).mount('#rab')
    </script>
@endpush
