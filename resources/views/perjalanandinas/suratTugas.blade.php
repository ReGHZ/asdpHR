@extends('layouts.panel')
{{-- css surat penugasan --}}
@section('css')
    <style>
        .container {
            max-width: 980px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 64px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .header {
            border: 1px #242424 solid;
            opacity: 0.5;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 40px;
        }

        .header__left {
            padding-left: 20px;
            display: flex;
            align-items: center;
            justify-content: left;
            grid-column: 1 / 3;
            border-right: 1px #242424 solid;
        }

        .header__logo {
            width: 120px;
        }

        .header__title {
            color: #242424;
            font-size: 26px;
            text-align: center;
            flex-grow: 1;
        }

        .header__detail {
            display: grid;
            grid-template-rows: 1fr 1fr 1fr 1fr;
            align-items: center;
            grid-column: 3 / 4;
        }

        .header__item {
            display: flex;
            width: 100%;
            padding: 0 12px;
        }

        .header__item:not(:last-child) {
            border-bottom: 1px #242424 solid;
        }

        .header__key,
        .header__value {
            flex: 1;
        }

        .sender {
            border: 1px #242424 solid;
            padding-top: 24;
        }

        .sender__detail {
            border: 1px red solid;
            display: grid;
            grid-template-rows: repeat(8, 1fr);
            grid-template-columns: 64px 1fr;
            margin-left: auto;
            width: 50%;
        }

        .sender__detail-prefix {
            justify-self: end;
            grid-row: 3 / 4;
            grid-column: 1 / 2;
            margin-right: 16px;
        }

        .sender__data:nth-child(2) {
            grid-row: 1 / 3;
        }

        .sender__data {
            grid-column: 2 / 3;
        }

        .content {
            padding-top: 32px;
        }

        .content__item {
            display: grid;
            grid-template-columns: 32px 1fr;
            padding: 8px 0;
        }

        .content__detail {
            /*padding-left: 64px;*/
            margin-bottom: 20px;
        }

        .detail__profile {
            /*padding: 16px 0 16px 64px;*/
        }

        .detail__profile-item {
            display: grid;
            grid-template-columns: 160px 32px 1fr;
        }

        .detail__departure {
            margin-top: 20px;
        }

        .detail__departure-item {
            display: grid;
            grid-template-columns: 160px 32px 1fr;
        }

        .signature {
            display: flex;
            padding-top: 64px;
            align-items: stretch;
            justify-content: center;
            height: 224px;
        }

        .signature {
            padding-top: 64px;
            margin-top: 40px;
        }

        .signature__title,
        .signature__name {
            text-align: center;
        }

        .signature__item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .consideration {
            padding-top: 64px;
        }

        .consideration__field {
            height: 20px;
            margin-left: 32px;
            border-bottom: 2px #242424 dotted;
        }

        .note {
            padding-top: 64px;
        }

        .sign-note {
            font-size: 15px;
        }

        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endsection
{{-- content surat penugasan --}}
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Surat Tugas</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form surat tugas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('perjalanan-dinas') }}" class="btn icon btn-primary"><i data-feather="arrow-left"></i>
                    Kembali
                </a>

                <a id="btnPrint" class="btn icon btn-secondary me-1"><i data-feather="printer"></i>
                    Cetak
                </a>

            </div>

        </div>
        <div class="container mb-4 mt-4">
            <div id="printDinas">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}"
                            alt="logo" />
                        <h1 class="header__title">FORMULIR SURAT PENUGASAN PERJALANAN DINAS</h1>
                    </div>
                    <div class="header__detail">
                        <div class="header__item">
                            <span class="header__key">No. Dokumen</span>
                            <span class="header__value">: PPU-204.00.01</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Revisi</span>
                            <span class="header__value">: 00</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Berlaku Efektif</span>
                            <span class="header__value">: {{ \Carbon\Carbon::now()->year }}</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Halaman</span>
                            <span class="header__value">: 1 dari 1</span>
                        </div>
                    </div>
                </header>
                <center>
                    <h3><u>SURAT PENUGASAN PERJALANAN DINAS</u></h3>
                </center>
                <center>No : SPEN.{{ $penugasan->nomor_surat }} / UM.102 / ASDP-KTP / {{ \Carbon\Carbon::now()->year }}
                </center>
                <main class="content">
                    Diberikan Surat Penugasan Perjalanan Dinas kepada :
                    <div class="content__detail">
                        <div class="detail__profile">
                            <div class="detail__profile-item">
                                <span>Nama</span><span>:</span><span>{{ $penugasan->pengikut[0]->user->name }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>Pangkat</span><span>:</span><span>{{ $penugasan->pengikut[0]->user->pangkat }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>Jabatan</span><span>:</span><span>{{ $penugasan->pengikut[0]->user->jabatan->nama_jabatan }}</span>
                            </div>
                        </div>
                    </div>
                    Untuk :
                    <br>
                    {{ $penugasan->perihal }}
                    <br>
                    <br>
                    Biaya perjalanan dinas dibebankan pada :
                    <br>
                    Divisi {{ $penugasan->pembebanan_biaya }}
                    <div class="detail__departure">
                        <div class="detail__departure-item">
                            <span>Berangkat
                                tgl</span><span>:</span><span>{{ tanggal_indonesia($penugasan->tanggal_keberangkatan) }}</span>
                        </div>
                        <div class="detail__departure-item">
                            <span>Berlaku
                                s/d</span><span>:</span><span>{{ tanggal_indonesia($penugasan->tanggal_kembali) }}</span>
                        </div>
                        @if (isset($penugasan->jenis_kendaraan))
                            <div class="detail__departure-item">
                                <span>Berkendaraan</span><span>:</span><span>{{ $penugasan->jenis_kendaraan }}</span>
                            </div>
                        @else
                            <div class="detail__departure-item">
                                <span>Berkendaraan</span><span>:</span><span>-</span>
                            </div>
                        @endif
                        @if (isset($penugasan->keterangan))
                            <div class="detail__departure-item">
                                <span>Keterangan lain</span><span>:</span><span>{{ $penugasan->keterangan }}</span>
                            </div>
                        @else
                            <div class="detail__departure-item">
                                <span>Keterangan lain</span><span>:</span><span>-</span>
                            </div>
                        @endif
                        @if (isset($pengikut))
                            <div class="detail__departure-item">
                                <span>Pengikut</span>
                                <span>:</span>
                                @foreach ($pengikut as $i => $pengikut)
                                    @if ($i > 0)
                                        <span>{{ $pengikut->user->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="detail__departure-item">
                                <span>Pengikut</span><span>:</span><span>-</span>
                            </div>
                        @endif

                    </div>
                </main>
                <section class="signature">
                    <div class="signature__item">
                    </div>
                    <div class="signature__item">
                        <span class="signature__title">
                            <span class="sign-note">Dikeluarkan di : </span>
                            @foreach ($manajer as $item)
                                <span class="sign-note">{{ $item->pegawai->segmen }}</span>
                            @endforeach
                            <br>
                            <span class="sign-note">Tanggal : </span><span
                                class="sign-note">{{ tanggal_indonesia($penugasan->tanggal_surat) }}</span>
                            <br>
                            <strong>General Manager</strong>
                        </span>
                        @foreach ($manajer as $item)
                            <span class="signature__name">
                                <u><strong>{{ $item->name }}</strong></u>
                            </span>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

{{-- script js --}}
@push('scripts')
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printDinas"));
            window.print();
        }

        function printElement(elem, append, delimiter) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            if (append !== true) {
                $printSection.innerHTML = "";
            } else if (append === true) {
                if (typeof(delimiter) === "string") {
                    $printSection.innerHTML += delimiter;
                } else if (typeof(delimiter) === "object") {
                    $printSection.appendChild(delimiter);
                }
            }

            $printSection.appendChild(domClone);
        }
    </script>
@endpush
