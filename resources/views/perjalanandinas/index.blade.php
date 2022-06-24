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
            @role('manajer')
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
                                    @if ($row->status == 'menunggu RAB')
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'berlangsung')
                                        <td>
                                            <span class="badge bg-primary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'selesai')
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
                                                    @if ($row->status == 'menunggu RAB')
                                                        <li><a href="" class="dropdown-item" id=""><i
                                                                    class="bi bi-pencil text-secondary"></i>
                                                                Buat RAB</a>
                                                        </li>
                                                    @elseif($row->status == 'berlangsung')
                                                        <li><a href="" class="dropdown-item"><i
                                                                    class="bi bi-pencil text-secondary"></i>
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
@section('script')
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
@endsection
