@extends('layouts.panel')
@section('content')
    <section>
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profile Pengguna</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

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

        {{-- profile content --}}
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 shadow">
                        <div class="card-body text-center">
                            <form action="{{ route('profile.updateFotoProfile', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @method('PUT')
                                @if (isset(Auth::user()->pegawai->foto))
                                    <div class="upload mb-3">
                                        <img src="{{ asset('fotoPegawai/' . Auth::user()->pegawai->foto) }}" width=100
                                            height=100 alt="">
                                        <div class="round">
                                            <input name="foto" type="file" id="file"
                                                onchange="this.form.submit()">
                                            <i class="feather-16" data-feather="camera" style="color: white ;"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="upload mb-3">
                                        <img src="{{ asset('backend/assets/images/faces/2.jpg') }}" width=100 height=100
                                            alt="">
                                        <div class="round">
                                            <input name="foto" type="file" id="file"
                                                onchange="this.form.submit()">
                                            <i class="feather-16" data-feather="camera" style="color: white ;"></i>
                                        </div>
                                    </div>
                                @endif
                            </form>
                            <h5 class="my-3">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-1">
                                {{ Auth::user()->jabatan->nama_jabatan }} / {{ Auth::user()->divisi->nama_divisi }}
                            </p>
                            <p class="text-muted mb-4">{{ Auth::user()->alamat }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" value="{{ Auth::user()->id }}"
                                    class="btn btn-outline-primary ms-1 editbtn">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0 shadow">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Tanggal Masuk Kerja :
                                        {{ Auth::user()->tanggal_masuk_kerja }}
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Masa Kerja :
                                        {{ Auth::user()->masa_kerja }}
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Tanggal Menjabat :
                                        {{ Auth::user()->tanggal_pilih_jabatan }}
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Masa Jabatan :
                                        {{ Auth::user()->masa_jabatan }}
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Kuota cuti Tahunan:
                                        {{ Auth::user()->pegawai->kuota_cuti }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Nomor Pegawai</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ Auth::user()->nik }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Nomor HP</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ Auth::user()->no_hp }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Tempat/Tanggal Lahir</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">
                                        {{ Auth::user()->tempat_lahir }}/{{ Auth::user()->tanggal_lahir }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Usia</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ Auth::user()->usia }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Jenis Kelamin</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ Auth::user()->jenis_kelamin }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0 shadow">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">personal</span>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Status Keluarga</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->status_keluarga }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pendidikan Terakhir</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->pendidikan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jurusan</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->jurusan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>KTP</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->nik_ktp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Rekening</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->no_rek }}</td>
                                                </tr>
                                                <tr>
                                                    <td>npwp</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->npwp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ukuran Baju</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->ukuran_baju }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ukuran Sepatu</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->ukuran_sepatu }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS Kesehatan</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->no_bpjs_kesehatan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS Ketenagakerjaan</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->no_bpjs_ketenagakerjaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pangkat</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->pangkat }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button value="{{ Auth::user()->id }}"
                                            class="btn icon icon-left btn-secondary editbtnpersonal"><i
                                                data-feather="edit"></i>Edit</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0 shadow">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">data
                                            kantor</span>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>SK</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->sk }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Segmen</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->segmen }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Inhealth</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->no_inhealth }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Unit Kerja</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->darat_laut_lokasi }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala THT</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->gol_skala_tht }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Skala THT</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->skala_tht }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala PHDP</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->gol_skala_phdp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan PHDP</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->gol_phdp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala Gaji</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->gol_skala_gaji }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Gaji</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->gol_gaji }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan</td>
                                                    <td>:</td>
                                                    <td>{{ Auth::user()->pegawai->golongan }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button value="{{ Auth::user()->id }}"
                                            class="btn icon icon-left btn-secondary editbtnkantor"><i
                                                data-feather="edit"></i>Edit</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('usermanagement.edit')
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtn', function() {
                var emp_id = $(this).val();
                // alert(emp_id);
                $('#empedit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "profile/" + emp_id + "/edit",
                    success: function(response) {
                        // console.log(response.user.name);
                        $('#emp_id').val(response.user.id);
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);
                        $('#alamat').val(response.user.alamat);
                        $('#jenis_kelamin').val(response.user.jenis_kelamin);
                        $('#tanggal_lahir').val(response.user.tanggal_lahir);
                        $('#tempat_lahir').val(response.user.tempat_lahir);
                        $('#nik').val(response.user.nik);
                        $('#no_hp').val(response.user.no_hp);
                        $('#jabatan').val(response.user.jabatan);
                        $('#divisi_id').val(response.user.divisi_id);
                        $('#jabatan_id').val(response.user.jabatan_id);
                        $('#tanggal_masuk_kerja').val(response.user.tanggal_masuk_kerja);
                        $('#tanggal_pilih_jabatan').val(response.user.tanggal_pilih_jabatan);
                    }
                });
            });
        });
    </script>

    {{-- edit data personal --}}
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtnpersonal', function() {
                var per_id = $(this).val();
                // alert(per_id);
                $('#editpersonal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "profile/" + per_id + "/edit",
                    success: function(response) {
                        // console.log(response.user.pegawai.status_keluarga);
                        $('#per_id').val(response.user.id);
                        $('#status_keluarga').val(response.user.pegawai.status_keluarga);
                        $('#pendidikan').val(response.user.pegawai.pendidikan);
                        $('#jurusan').val(response.user.pegawai.jurusan);
                        $('#nik_ktp').val(response.user.pegawai.nik_ktp);
                        $('#no_bpjs_kesehatan').val(response.user.pegawai.no_bpjs_kesehatan);
                        $('#no_bpjs_ketenagakerjaan').val(response.user.pegawai
                            .no_bpjs_ketenagakerjaan);
                        $('#no_rek').val(response.user.pegawai.no_rek);
                        $('#npwp').val(response.user.pegawai.npwp);
                        $('#ukuran_baju').val(response.user.pegawai.ukuran_baju);
                        $('#ukuran_sepatu').val(response.user.pegawai.ukuran_sepatu);
                    }
                });
            });
        });
    </script>

    {{-- edit data kantor --}}
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtnkantor', function() {
                var kan_id = $(this).val();
                // alert(kan_id);
                $('#editkantor').modal('show');

                $.ajax({
                    type: "GET",
                    url: "profile/" + kan_id + "/edit",
                    success: function(response) {
                        // console.log(response.user.pegawai.sk);
                        $('#kan_id').val(response.user.id);
                        $('#sk').val(response.user.pegawai.sk);
                        $('#segmen').val(response.user.pegawai.segmen);
                        $('#no_inhealth').val(response.user.pegawai.no_inhealth);
                        $('#darat_laut_lokasi').val(response.user.pegawai.darat_laut_lokasi);
                        $('#gol_skala_tht').val(response.user.pegawai.gol_skala_tht);
                        $('#skala_tht').val(response.user.pegawai.skala_tht);
                        $('#gol_skala_phdp').val(response.user.pegawai.gol_skala_phdp);
                        $('#gol_phdp').val(response.user.pegawai.gol_phdp);
                        $('#gol_skala_gaji').val(response.user.pegawai.gol_skala_gaji);
                        $('#gol_gaji').val(response.user.pegawai.gol_gaji);
                        $('#golongan').val(response.user.pegawai.golongan);
                        $('#pangkat').val(response.user.pegawai.pangkat);
                    }
                });
            });
        });
    </script>
@endpush
