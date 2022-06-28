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
                        data-bs-target="#createpegawai"><i data-feather="user-plus"></i>
                        Tambah</a>
                    <a href="{{ url('roles') }}" class="btn btn-secondary pull-right"><i class="fas fa-user-cog me-2"></i>
                        Role user</a>
                </div>
            @endrole

            {{-- Tabel pegawai --}}
            <div class="card shadow-lg">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Masa Kerja</th>
                                <th>Masa Jabatan</th>
                                @role('admin|manajer')
                                    <th>action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $i => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->masa_kerja }}</td>
                                    <td>{{ $row->masa_jabatan }}</td>
                                    @role('admin|manajer')
                                        <td>
                                            <div class="dropdown position-static">
                                                <a class="dropdown" href="#" role="button" id="actionlink"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>

                                                <ul class="dropdown-menu shadow" aria-labelledby="actionlink"
                                                    style="min-width:inherit;">
                                                    <li><a href="{{ route('employee.show', $row->id) }}"
                                                            class="dropdown-item"><i class="bi bi-eye text-success"></i>
                                                            Lihat</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="{{ $row->id }}" class="dropdown-item btnEmpDel"><i
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
        @include('employee.create')
        @include('employee.delete')
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.btnEmpDel', function() {
            var user_id = $(this).val();
            // alert(user_id);
            $('#pegawaiDelete').modal('show');
            $('#user_id').val(user_id);
        });
    </script>
@endpush
