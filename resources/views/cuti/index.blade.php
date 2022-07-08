@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Pengajuan Cuti</h3>
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


            <div class="pb-3">
                <a href="" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createcuti">
                    <i class="fas fa-suitcase-rolling"></i>
                    Tambah
                </a>
            </div>

            @role('admin|manajer')
                {{-- Statistik cuti --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2"><i class="bi bi-briefcase me-2"></i>Cuti Tahunan</h6>
                            </div>
                            <h4>{{ $dataCuti->where('jenis_cuti', 'Cuti tahunan')->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2"><i class="bi bi-send me-2"></i>Cuti Besar</h6>
                            </div>
                            <h4>{{ $dataCuti->where('jenis_cuti', 'Cuti besar')->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2"><i class="bi bi-balloon me-2"></i>Cuti Bersalin</h6>
                            </div>
                            <h4>{{ $dataCuti->where('jenis_cuti', 'Cuti bersalin')->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2"><i class="bi bi-heart-pulse me-2"></i>Cuti Sakit</h6>
                            </div>
                            <h4>{{ $dataCuti->where('jenis_cuti', 'Cuti sakit')->count() }}</h4>
                        </div>
                    </div>
                </div>

                {{-- statistik persetujuan cuti --}}
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="card text-center bg-success shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2 text-white"><i class="bi bi-check2-circle me-2"></i>Cuti Disetujui</h6>
                            </div>
                            <h4 class="text-white">{{ $dataCuti->where('status', 'Disetujui')->count() }}</h4>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-center bg-danger shadow">
                            <div class="card-title shadow-sm">
                                <h6 class="mt-2 text-white"><i class="bi bi-x-circle me-2"></i>Cuti Ditolak</h6>
                            </div>
                            <h4 class="text-white">{{ $dataCuti->where('status', 'Ditolak')->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            @endrole

            {{-- Tabel permohonan cuti --}}
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Jenis Cuti</th>
                                <th>Lama Hari</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataCuti as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->user->nik }}</td>
                                    <td>{{ $row->jenis_cuti }}</td>
                                    <td>{{ $row->lama_hari }} Hari</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_mulai) }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_selesai) }}</td>
                                    @if ($row->status == 'Menunggu konfirmasi')
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Disetujui')
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check2-circle me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Ditolak')
                                        <td>
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-2">
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

                                                <li><a href="{{ route('pengajuan-cuti.show', $row->id) }}"
                                                        class="dropdown-item" id="show-cuti"><i
                                                            class="bi bi-eye text-success"></i>
                                                        Lihat</a></li>

                                                @role('admin|manajer')
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="{{ $row->id }}" class="dropdown-item btnCutiDel"><i
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
        @include('cuti.create')
        @include('cuti.editDeleteCuti')
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.btnCutiDel', function() {
            var cuti_id = $(this).val();
            // alert(cuti_id);
            $('#cutiDelete').modal('show');
            $('#cuti_id').val(cuti_id);
        });
    </script>
    <script>
        function fileCutiSakit(that) {
            if (that.value == "Cuti sakit") {
                // alert("check");
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>
@endpush
