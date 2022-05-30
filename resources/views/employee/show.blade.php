@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pegawai</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="content-types">
            <div class="pb-3">
                <a href="{{ route('employee') }}" class="btn icon btn-primary pull-right"><i
                        data-feather="arrow-left"></i>
                    Kembali</a>
            </div>
            <!-- SOLO PAGE -->
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Profile</h1>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <!-- FIRST -->
                                        <div style="margin-left: 7mm;">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Divisi</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->divisi->nama_divisi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jabatan</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->Jabatan->nama_jabatan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor HP</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->no_hp }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir/Tanggal Lahir</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->tempat_lahir }}/{{ $pegawai->tanggal_lahir }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>usia</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->usia }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->jenis_kelamin }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- END FIRST -->
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- SECOND -->
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Kepegawaian</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Diterima Kerja</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->tanggal_masuk_kerja }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Masa Kerja</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->masa_kerja }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Menjabat</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->tanggal_pilih_jabatan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Masa Jabatan</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->masa_jabatan }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <!-- END SECOND -->
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button value="{{ $pegawai->id }}"
                                            class="btn icon icon-left btn-secondary editbtn"><i
                                                data-feather="edit"></i>Edit</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SOLO PAGE -->

            <!-- DOUBLE PAGE -->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <!-- FIRST PAGE -->
                    <div class="card o-hidden border-0 shadow-lg my-4">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div style="margin-bottom: 4mm;">
                                            <h4>Informasi Personal</h4>
                                        </div>
                                        <table class="table">
                                            <tbody>

                                                <tr>
                                                    <td>Status Keluarga</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->status_keluarga }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pendidikan Terakhir</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->pendidikan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jurusan</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->jurusan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>KTP</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->nik_ktp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS Kesehatan</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->no_bpjs_kesehatan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS Ketenagakerjaan</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->no_bpjs_ketenagakerjaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Rekening</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->no_rek }}</td>
                                                </tr>
                                                <tr>
                                                    <td>npwp</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->npwp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ukuran Baju</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->ukuran_baju }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ukuran Sepatu</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->ukuran_sepatu }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button value="{{ $pegawai->id }}"
                                                class="btn icon icon-left btn-secondary editbtnpersonal"><i
                                                    data-feather="edit"></i>Edit</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END FIRST PAGE -->
                </div>
                <div class="col-sm-6">
                    <!-- SECOND PAGE -->
                    <div class="card o-hidden border-0 shadow-lg my-4">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div style="margin-bottom: 4mm;">
                                            <h4>Data Kantor</h4>
                                        </div>
                                        <table class="table">
                                            <tbody>

                                                <tr>
                                                    <td>SK</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->sk }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Segmen</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->segmen }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Inhealth</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->no_inhealth }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Unit Kerja</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->darat_laut_lokasi }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala THT</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->gol_skala_tht }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Skala THT</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->skala_tht }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala PHDP</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->gol_skala_phdp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan PHDP</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->gol_phdp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Skala Gaji</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->gol_skala_gaji }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan Gaji</td>
                                                    <td>:</td>
                                                    <td>{{ $pegawai->pegawai->gol_gaji }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button value="{{ $pegawai->id }}"
                                                class="btn icon icon-left btn-secondary editbtnkantor"><i
                                                    data-feather="edit"></i>Edit</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SECOND PAGE -->
                </div>
            </div>
            <!-- END DOUBLE PAGE -->

        </section>
        @include('employee.edit')
    </div>
@endsection

@section('script')
    {{-- edit profile --}}
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtn', function() {
                var emp_id = $(this).val();
                // alert(emp_id);
                $('#empedit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/employee/" + emp_id + "/edit",
                    success: function(response) {
                        // console.log(response.user.password);
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
                    url: "/employee/" + per_id + "/edit",
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
                    url: "/employee/" + kan_id + "/edit",
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
                    }
                });
            });
        });
    </script>
@endsection
