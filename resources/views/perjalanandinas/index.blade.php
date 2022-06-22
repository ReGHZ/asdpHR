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
                                <th>keterangan</th>
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
                                    @if ($row->tanggal_berangkat == null)
                                        <td><span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>Pending
                                            </span>
                                        </td>
                                    @else
                                        <td>{{ tanggal_indonesia($row->tanggal_keberangkatan) }}</td>
                                    @endif
                                    @if ($row->tanggal_kembali == null)
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>Pending
                                            </span>
                                        </td>
                                    @else
                                        <td>{{ tanggal_indonesia($row->tanggal_kembali) }}</td>
                                    @endif
                                    @if ($row->tujuan == null)
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>Pending
                                            </span>
                                        </td>
                                    @else
                                        <td>{{ $row->tujuan }} Hari</td>
                                    @endif
                                    @if ($row->keterangan == null)
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>Pending
                                            </span>
                                        </td>
                                    @else
                                        <td>{{ $row->keterangan }}</td>
                                    @endif
                                    @if ($row->status == 'pending')
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
                                                <li><a href="" class="dropdown-item" id="show-cuti"><i
                                                            class="bi bi-pencil text-secondary"></i>
                                                        Buat Form penugasan</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><button value="" class="dropdown-item btnCutiDel"><i
                                                            class="bi bi-exclamation-circle text-danger"></i>
                                                        Hapus
                                                    </button>

                                                </li>
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
    </div>
@endsection
