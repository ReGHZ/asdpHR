@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Jabatan</h3>
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
                <a href="" class="btn icon btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createjabatan"><i
                        data-feather="plus"></i>
                    Tambah</a>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Jabatan</th>
                                <th>Deskripsi</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->nama_jabatan }}</td>
                                    <td>{{ $row->deskripsi }}</td>


                                    <td class="d-flex">
                                        <button value="{{ $row->id }}"
                                            class="btn icon icon-left btn-secondary me-2 editbtn"><i
                                                data-feather="edit"></i>
                                            Edit</button>
                                        <form action="{{ route('jabatan.destroy', $row->id) }}" method="post">
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
        @include('employee.positions.create')
        @include('employee.positions.edit')
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtn', function() {
                var jab_id = $(this).val();
                // alert(jab_id);
                $('#jabatanedit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "jabatan/" + jab_id + "/edit",
                    success: function(response) {
                        // console.log(response.jabatan.nama_jabatan);
                        $('#jab_id').val(response.jabatan.id);
                        $('#nama_jabatan').val(response.jabatan.nama_jabatan);
                        $('#deskripsi').val(response.jabatan.deskripsi);
                    }
                });
            });
        });
    </script>
@endsection
