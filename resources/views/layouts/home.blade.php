@extends('layouts.panel')
@section('css')
    <style>
        .welcome-box {
            background-color: #fff;
            border-bottom: 1px solid #ededed;
            display: flex;
            padding: 20px;
            position: relative;
        }

        .welcome-img {
            margin-right: 15px;
        }

        .welcome-img img {
            border-radius: 8px;
            width: 60px;
        }

        .welcome-det p {
            color: #777;
            font-size: 18px;
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-md-12">
                @if (isset(Auth::user()->pegawai->foto))
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ asset('fotoPegawai/' . Auth::user()->pegawai->foto) }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Selamat Datang, {{ Auth::user()->name }}</h3>
                            <p>{{ $todayDate }}</p>
                        </div>
                    </div>
                @else
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ asset('backend/assets/images/faces/2.jpg') }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, {{ Auth::user()->name }}</h3>
                            <p>{{ $todayDate }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="page-content">
        <section>
            <div class="row">
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manajer'))
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="fas fa-suitcase-rolling"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pengajuan Cuti</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengajuanCuti->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Perjalanan Dinas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $perjalananDinas->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pegawai</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pegawai->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="fas fa-suitcase-rolling"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pengajuan Cuti</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ Auth::user()->pengajuanCuti->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Cuti Diterima</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ Auth::user()->pengajuanCuti->where('status', 'Disetujui')->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Cuti Ditolak</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ Auth::user()->pengajuanCuti->where('status', 'Ditolak')->count() }}</h6>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Perjalanan Dinas</h6>
                                        <h6 class="font-extrabold mb-0">{{ Auth::user()->perjalananDinas->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Grafik Masa Kerja</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-sm border" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne"><i class="bi bi-dash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="collapseOne">
                                    <canvas id="masaKerja"></canvas>
                                    <a id="dlmasakerja" download="grafik-masakerja.jpg" href=""
                                        class="btn btn-primary float-right bg-flat-color-1"
                                        title="download grafik masa kerja">

                                        <!-- Download Icon -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Grafik Masa jabatan</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-sm border" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTwo"><i class="bi bi-dash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="collapseTwo">
                                    <canvas id="masaJabatan"></canvas>
                                    <a id="dlmasajabatan" download="grafik-masajabatan.jpg" href=""
                                        class="btn btn-primary float-right bg-flat-color-1"
                                        title="download grafik masa jabatan">

                                        <!-- Download Icon -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Grafik Perjalanaan Dinas</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-sm border" data-bs-toggle="collapse"
                                                data-bs-target="#collapseThree"><i class="bi bi-dash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="collapseThree">
                                    <canvas id="perjadin"></canvas>
                                    <a id="dlperjadin" download="grafik-perjadin.jpg" href=""
                                        class="btn btn-primary float-right bg-flat-color-1"
                                        title="download grafik perjadin">

                                        <!-- Download Icon -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Grafik Cuti Pegawai</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-sm border" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFour"><i class="bi bi-dash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="collapseFour">
                                    <canvas id="cutiUsers"></canvas>
                                    <a id="dlcutipegawai" download="grafik-cuti-pegawai.jpg" href=""
                                        class="btn btn-primary float-right bg-flat-color-1"
                                        title="download grafik cuti pegawai">

                                        <!-- Download Icon -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Grafik Cuti</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-sm border" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFive"><i class="bi bi-dash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="collapseFive">
                                    <canvas id="cuti"></canvas>
                                    <a id="dlcuti" download="grafik-cuti.jpg" href=""
                                        class="btn btn-primary float-right bg-flat-color-1" title="download grafik cuti">

                                        <!-- Download Icon -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById('masaKerja').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
            // The data for our dataset
            data: {
                labels: {!! json_encode($grafikMasaKerja->labels) !!},
                datasets: [{
                    label: 'Grafik masa kerja',
                    backgroundColor: [
                        'rgba(9, 160, 132, 0.5)',
                        'rgba(67, 159, 399, 0.5)',
                        'rgba(0, 255, 255, 0.5)',
                    ],
                    data: {!! json_encode($grafikMasaKerja->dataset) !!},
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Grafik Masa Kerja Pegawai PT.ASDP'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var ctx = document.getElementById('masaJabatan').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: {!! json_encode($grafikMasaJabatan->labels) !!},
                datasets: [{
                    label: 'Grafik masa jabatan',
                    backgroundColor: [
                        'rgba(242, 99, 242, 0.5)',
                        'rgba(124, 55, 171, 0.5)',
                        'rgba(28, 3, 110, 0.5)',
                    ],

                    data: {!! json_encode($grafikMasaJabatan->dataset) !!},
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Grafik Masa Kerja jabatan Pegawai PT.ASDP'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var ctx = document.getElementById('cutiUsers').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: {!! json_encode($grafikCutiUsers->labels) !!},
                datasets: [{
                    label: 'Grafik cuti pegawai',
                    backgroundColor: {!! json_encode($grafikCutiUsers->warnagrafikCutiUsers) !!},

                    data: {!! json_encode($grafikCutiUsers->dataset) !!},
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Grafik Cuti Pegawai PT.ASDP'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var ctx = document.getElementById('cuti').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: {!! json_encode($grafikCuti->labels) !!},
                datasets: [{
                    label: 'Grafik cuti',
                    backgroundColor: [
                        'rgba(242, 99, 242, 0.5)',
                        'rgba(124, 55, 171, 0.5)',
                        'rgba(28, 3, 110, 0.5)',
                        'rgba(28, 3, 110, 200)',
                    ],

                    data: {!! json_encode($grafikCuti->dataset) !!},
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Grafik Cuti PT.ASDP'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var ctx = document.getElementById('perjadin').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: {!! json_encode($grafikPerjalananDinas->labels) !!},
                datasets: [{
                    label: 'Grafik perjalanan Dinas',
                    backgroundColor: {!! json_encode($grafikPerjalananDinas->warnagrafikPerjalananDinas) !!},

                    data: {!! json_encode($grafikPerjalananDinas->dataset) !!},
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Grafik Perjalanan Dinas PT.ASDP'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });


        document.getElementById("dlmasakerja").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("masaKerja").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("dlmasakerja");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
        document.getElementById("dlmasajabatan").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("masaJabatan").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("dlmasajabatan");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
        document.getElementById("dlcutipegawai").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("cutiUsers").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("dlcutipegawai");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
        document.getElementById("dlcuti").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("cuti").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("dlcuti");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
        document.getElementById("dlperjadin").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("perjadin").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("dlperjadin");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
    </script>
@endpush
