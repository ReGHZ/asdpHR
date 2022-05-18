@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Pegawai</h3>
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
            <div class="pb-3">
                <a href="" class="btn btn-primary pull-right" data-bs-toggle="modal"
                    data-bs-target="#exampleModalScrollable">
                    Tambah</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Masa Kerja</th>
                                <th>Masa Jabatan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->masa_kerja }}</td>
                                    <td>{{ $row->masa_jabatan }}</td>

                                    <td class="d-flex">
                                        <a href="{{ route('employee.show', $row->id) }}"
                                            class="btn icon icon-left btn-secondary me-2"><i data-feather="user"></i>
                                            Lihat</a>
                                        <form action="{{ route('employee.destroy', $row->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn icon icon-left btn-danger"><i
                                                    data-feather="alert-circle"></i>
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        @include('employee.create')
    </div>
@endsection
