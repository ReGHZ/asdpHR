@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Divisi</h3>
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
                <a href="" class="btn icon btn-primary pull-right" data-bs-toggle="modal"
                    data-bs-target="#exampleModalScrollable"><i data-feather="plus"></i>
                    Tambah</a>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Divisi</th>
                                <th>Deskripsi</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisi as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->nama_divisi }}</td>
                                    <td>{{ $row->deskripsi }}</td>


                                    <td class="d-flex">
                                        <button value="{{ $row->id }}"
                                            class="btn icon icon-left btn-secondary me-2 editbtn"><i
                                                data-feather="edit"></i>
                                            Edit</button>
                                        <form action="{{ route('divisi.destroy', $row->id) }}" method="post">
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
        @include('employee.departements.create')
        @include('employee.departements.edit')
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtn', function() {
                var div_id = $(this).val();
                // alert(div_id);
                $('#divisiedit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "divisi/" + div_id + "/edit",
                    success: function(response) {
                        // console.log(response.divisi.nama_divisi);
                        $('#div_id').val(response.divisi.id);
                        $('#nama_divisi').val(response.divisi.nama_divisi);
                        $('#deskripsi').val(response.divisi.deskripsi);
                    }
                });
            });
        });
    </script>
@endsection
