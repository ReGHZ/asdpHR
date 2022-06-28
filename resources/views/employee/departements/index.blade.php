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

            @role('admin|manajer')
                <div class="pb-3">
                    <a href="" class="btn icon btn-primary pull-right" data-bs-toggle="modal"
                        data-bs-target="#exampleModalScrollable"><i data-feather="plus"></i>
                        Tambah</a>
                </div>
            @endrole
            {{-- Tabel divisi --}}
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Divisi</th>
                                <th>Deskripsi</th>
                                @role('admin|manajer')
                                    <th>action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisi as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->nama_divisi }}</td>
                                    <td>{{ $row->deskripsi }}</td>
                                    @role('admin|manajer')
                                        <td>
                                            <div class="dropdown position-static">
                                                <a class="dropdown" href="#" role="button" id="actionlink"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>

                                                <ul class="dropdown-menu shadow" aria-labelledby="actionlink"
                                                    style="min-width:inherit;">
                                                    <li><button value="{{ $row->id }}" class="dropdown-item editbtn"><i
                                                                class="bi bi-pencil text-secondary"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="{{ $row->id }}" class="dropdown-item btnDivDel"><i
                                                                class="bi bi-exclamation-circle text-danger"></i>
                                                            Hapus
                                                        </button>

                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        @include('employee.departements.create')
        @include('employee.departements.edit')
        @include('employee.departements.delete')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.btnDivDel', function() {
            var divisi_id = $(this).val();
            // alert(divisi_id);
            $('#divisiDelete').modal('show');
            $('#divisi_id').val(divisi_id);
        });

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
@endpush
