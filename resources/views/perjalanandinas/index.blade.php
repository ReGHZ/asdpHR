@extends('layouts.panel')
@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
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
                                    <td>{{ $row->pengikut[0]->user->name }}</td>
                                    <td>{{ $row->pengikut[0]->user->nik }}</td>
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
                                    @elseif ($row->status == 'Berlangsung')
                                        <td>
                                            <span class="badge bg-warning">
                                                <i class="bi bi-hourglass-split me-2">
                                                </i>{{ $row->status }}
                                            </span>
                                        </td>
                                    @elseif ($row->status == 'Menunggu Realisasi')
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
                                                        <li><a href="{{ route('perjalanan-dinas.createRab', $row->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="bi bi-pencil text-secondary"></i>
                                                                Buat RAB</a>
                                                        </li>
                                                    @elseif($row->status == 'Berlangsung')
                                                        <li><a href="{{ route('perjalanan-dinas.createRab', $row->id) }}"
                                                                class="dropdown-item"><i class="bi bi-eye text-secondary"></i>
                                                                Halaman RAB</a>
                                                        </li>
                                                    @endif
                                                @endrole
                                                @role('admin|manajer')
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><button value="{{ $row->id }}"
                                                            class="dropdown-item btnPenugasanDel"><i
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        $('select').selectpicker();

        $(document).on('click', '.btnPenugasanDel', function() {
            var penugasan_id = $(this).val();
            // alert(cuti_id);
            $('#penugasanDelete').modal('show');
            $('#penugasan_id').val(penugasan_id);
        });
    </script>
@endpush
