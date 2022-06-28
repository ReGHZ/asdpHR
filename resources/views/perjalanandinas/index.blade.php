@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Perjalanan Dinas</h3>
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
            @role('manajer|admin')
                <div class="pb-3">
                    <button value="" class="btn btn-primary pull-right" data-bs-toggle="modal"
                        data-bs-target="#createperdinas">
                        <i class="fas fa-plane"></i>
                        Tambah penugasan
                    </button>
                </div>
            @endrole
            {{-- Tabel perjalanan dinas --}}
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Tanggal berangkat</th>
                                <th>Tanggal kembali</th>
                                <th>tujuan</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penugasan as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->user->nik }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_keberangkatan) }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_kembali) }}</td>
                                    <td>{{ $row->tujuan }}</td>
                                    @if ($row->status == 'Menunggu RAB')
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Menunggu realisasi RAB')
                                        <td>
                                            <span class="badge bg-warning">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Berlangsung')
                                        <td>
                                            <span class="badge bg-primary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Selesai')
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check2-circle me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="dropdown position-static">
                                            <a class="dropdown" href="#" role="button" id="actionlink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>

                                            <ul class="dropdown-menu shadow" aria-labelledby="actionlink"
                                                style="min-width:inherit;">
                                                @role('admin|manajer')
                                                    <li><a href="{{ route('perjalanan-dinas.show', $row->id) }}"
                                                            class="dropdown-item"><i class="bi bi-eye text-success"></i>
                                                            Lihat Surat penugasan</a></li>
                                                    <li>
                                                    @endrole
                                                    @role('admin')
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    @if ($row->status == 'Menunggu RAB')
                                                        <li><button value="{{ $row->id }}"
                                                                class="dropdown-item createrab"><i
                                                                    class="bi bi-pencil text-secondary"></i>
                                                                Buat RAB</button>
                                                        </li>
                                                    @elseif($row->status == 'Menunggu realisasi RAB')
                                                        <li><a href="{{ route('perjalanan-dinas.rab', $row->id) }}"
                                                                class="dropdown-item"><i class="bi bi-eye text-secondary"></i>
                                                                lihat RAB</a>
                                                        </li>
                                                    @endif
                                                @endrole
                                                @role('admin|manajer')
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="" class="dropdown-item btnCutiDel"><i
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
        @include('perjalanandinas.create')
    </div>
@endsection
@push('scripts')
    {{-- script show pengikut --}}
    <script type='text/javascript'>
        function pengikut() {
            var text = document.getElementById("show");
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
    </script>

    {{-- get data perjalanan dinas --}}
    <script>
        $(document).ready(function() {

            $(document).on('click', '.createrab', function() {
                var dispo_id = $(this).val();
                // alert(dispo_id);
                $('#createRAB').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/perjalanan-dinas/" + dispo_id + "/getPenugasan",
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response.penugasan.jabatan);
                        $('#dispo_id').val(response.penugasan.id);
                        $('#lama_hari').val(response.penugasan.lama_hari);
                    }
                });
            });
        });
    </script>

    {{-- perhitungan rab --}}
    <script>
        function set_biayatiket() {
            var hargatiket = parseInt($("#hargatiket").val());
            var charge = parseInt($("#charge").val());
            var jumlah_harga = charge + hargatiket;
            $("#jumlah_harga").val(jumlah_harga);
        }
        $(document).ready(function() {
            $("#charge").keyup(function() {
                set_biayatiket();

            });
            $("#hargatiket").keyup(function() {
                set_biayatiket();

            });
        });

        function set_biayaHarian() {

            var biaya_harian = parseInt($("#biaya_harian").val());
            var lama_hari = parseInt($("#lama_hari").val());
            var hasilharian = lama_hari * biaya_harian;
            $("#hasilharian").val(hasilharian);
        }
        $(document).ready(function() {
            $("#lama_hari").keyup(function() {
                set_biayaHarian();
            });
            $("#biaya_harian").keyup(function() {
                set_biayaHarian();
            });
        });

        function set_biayaHotel() {

            var qtypenginap = parseInt($("#qtypenginap").val());
            var biaya_penginapan = parseInt($("#biaya_penginapan").val());
            var hasilpenginapan = qtypenginap * biaya_penginapan;
            $("#hasilpenginapan").val(hasilpenginapan);
        }
        $(document).ready(function() {
            $("#qtypenginap").keyup(function() {
                set_biayaHotel();
            });
            $("#biaya_penginapan").keyup(function() {
                set_biayaHotel();
            });
        });

        function set_biayaLain() {

            var qtyLain = parseInt($("#qtyLain").val());
            var biaya_lain = parseInt($("#biaya_lain").val());
            var hasillain = qtyLain * biaya_lain;
            $("#hasillain").val(hasillain);
        }
        $(document).ready(function() {
            $("#qtyLain").keyup(function() {
                set_biayaLain();
            });
            $("#biaya_lain").keyup(function() {
                set_biayaLain();
            });
        });
    </script>

    {{-- menambah row input lain --}}
    <script>
        $(document).ready(function() {
            var x = 1;
            $("#tambah").click(function() {
                $("#tabellain").append(`<tr>
                                                        <td><input name="qty_lain[]" id="qtyLain" type="text"
                                                                value="" class="form-control"
                                                                placeholder="jumlah"></td>
                                                        <td><input name="jenis[]" type="text" value=""
                                                                class="form-control"
                                                                placeholder="jenis biaya lainnya"></td>
                                                        <td><input name="biaya_lain[]" id="biaya_lain" type="text"
                                                                value="" class="form-control"
                                                                placeholder="harga biaya lain">
                                                        </td>
                                                        <td>

                                                            <input class="hapus btn btn-danger mr-2" type="button"
                                                                name="hapus" id="hapus" value="Hapus">
                                                        </td>
                                                    </tr>`);
                $("#tabellain").on('click', '#hapus', function() {
                    $(this).closest('tr').remove();
                })
            });
        });
    </script>
@endpush
