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
                <a href="" class="btn icon btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createcuti">
                    <i data-feather="user-plus"></i>
                    Tambah
                </a>
            </div>
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
                                <th>Status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataCuti as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->usercuti->name }}</td>
                                    <td>{{ $row->usercuti->nik }}</td>
                                    <td>{{ $row->jenis_cuti }}</td>
                                    <td>{{ $row->lama_hari }}</td>
                                    <td>{{ $row->status }}</td>

                                    <td class="d-flex">
                                        <a href="" class="btn icon icon-left btn-secondary me-2"><i
                                                class="bi bi-eye"></i>
                                            Lihat</a>
                                        <form action="" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn icon icon-left btn-danger"><i
                                                    class="bi bi-exclamation-circle"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- {{ $user }} -->
        @include('cuti.create', ['user' => $user])
    </div>
@endsection
@section('script')
    <script></script>
@endsection
