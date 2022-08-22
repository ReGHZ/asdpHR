@extends('layouts.panel')
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
            margin-bottom: 30px;
        }

        .header__left {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
            grid-column: 1 / 3;
            border-right: 1px #242424 solid;
            margin-left: 20px;
        }

        .header__logo {
            width: 120px;
        }

        .header__title {
            color: #242424;
            font-size: 22px;
            text-align: center;
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

            display: flex;
            align-items: stretch;
            justify-content: center;
            height: 225px;
        }

        .sender__detail {

            display: flex;
            flex-direction: column;
            /*justify-content: space-between;*/
            flex: 1;
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

            padding-top: 0px;
        }

        .content__item {
            font-weight: bold;
            display: grid;
            grid-template-columns: 32px 1fr;
            padding: 8px 0;
        }

        .content__detail {
            padding-left: 32px;
        }

        .detail__profile {}

        .detail__profile-item {
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

        .consideration {}

        .consideration__field {

            height: 20px;
            margin-left: 32px;
            border-bottom: 2px #242424 dotted;
        }

        .note {
            padding-top: 64px;
        }

        #senderkanan {
            padding-left: 120px;
        }

        #tabel {
            width: 100%;
            padding-left: 30px;
        }

        .basic_content {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #tebal {
            font-weight: bold;
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
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Laporan Realisasi RAB</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Laporan realisasi rab</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('perjalanan-dinas.createRab', $rab->perjalananDinas->id) }}"
                    class="btn icon btn-primary"><i data-feather="arrow-left"></i>
                    Kembali
                </a>
                <a id="btnPrint" class="btn icon btn-secondary me-1"><i data-feather="printer"></i>
                    Cetak
                </a>

            </div>
        </div>

        <div class="container mb-4 mt-4">
            <div id="printRealisasi">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}" alt="logo" />
                        <h1 class="header__title">FORMULIR PERHITUNGAN REALISASI BIAYA PERJALANAN DINAS</h1>
                    </div>
                    <div class="header__detail">
                        <div class="header__item">
                            <span class="header__key">No. Dokumen</span>
                            <span class="header__value">: PPU-204.00.04</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Revisi</span>
                            <span class="header__value">: 02</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Berlaku Efektif</span>
                            <span class="header__value">: 2019</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Halaman</span>
                            <span class="header__value">: 1 dari 1</span>
                        </div>
                    </div>
                </header>
                <main class="content">
                    <table style="width:70%; margin-bottom:20px">
                        <tr>
                            <td>SPPD NO</td>
                            <td>:</td>
                            <td>SPEN.{{ $rab->perjalananDinas->nomor_surat }}/UM.102/ASDP-KTP/{{ \Carbon\Carbon::now()->year }}
                            </td>
                        </tr>
                        <tr>
                            <td>ATAS NAMA</td>
                            <td>:</td>
                            <td>{{ $rab->pengikut->user->name }}</td>
                        </tr>
                        <tr>
                            <td>TEMPAT ASAL</td>
                            <td>:</td>
                            @foreach ($manajer as $item)
                                <td>{{ $item->segmen }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>TGL BERANGKAT</td>
                            <td>:</td>
                            <td>{{ tanggal_indonesia($rab->perjalananDinas->tanggal_keberangkatan) }}</td>
                        </tr>
                        <tr>
                            <td>TGL SELESAI</td>
                            <td>:</td>
                            <td>{{ tanggal_indonesia($rab->perjalananDinas->tanggal_kembali) }}</td>
                        </tr>
                        <tr>
                            <td>JUMLAH HARI BERANGKAT</td>
                            <td>:</td>
                            <td>{{ $rab->lama_hari }}</td>
                        </tr>
                    </table>
                    <div class="content__item">
                        <span>1.</span>
                        <span>
                            REALISASI BIAYA HARIAN
                        </span>
                    </div>
                    <table id="tabel">
                        <tr>
                            <td>PENERIMAAN</td>
                            <td>Rp</td>
                            <td>{{ $rab->jumlah_biaya_harian }}</td>
                            <td>HARI</td>
                            <td>{{ $rab->lama_hari }}</td>
                        </tr>
                        <tr>
                            <td>REALISASI</td>
                            <td>Rp</td>
                            <td>{{ $realisasi->jumlah_biaya_harian }}</td>
                            <td>HARI</td>
                            <td>{{ $realisasi->lama_hari }}</td>
                        </tr>
                        <tr>
                            <td>KURANG</td>
                            <td>Rp</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>TAMBAH</td>
                            <td>Rp</td>
                            <td>-</td>
                        </tr>
                    </table>
                    <div class="content__item">
                        <span>2.</span>
                        <span>
                            REALISASI BIAYA PESAWAT
                        </span>
                    </div>
                    <table id="tabel">
                        @if (isset($rab->jumlah_harga_tiket))
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>{{ $rab->jumlah_harga_tiket }}</td>
                                <td>HARI</td>
                                <td>{{ $rab->lama_hari }}</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>{{ $realisasi->jumlah_harga_tiket }}</td>
                                <td>HARI</td>
                                <td>{{ $realisasi->lama_hari }}</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                            </tr>
                        @else
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                            </tr>
                        @endif
                    </table>
                    <div class="content__item">
                        <span>3.</span>
                        <span>
                            REALISASI BIAYA HOTEL
                        </span>
                    </div>
                    <table id="tabel">
                        @if (isset($rab->jumlah_biaya_penginapan))
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>{{ $rab->jumlah_biaya_penginapan }}</td>
                                <td>HARI</td>
                                <td>{{ $rab->lama_hari_penginap }}</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>{{ $rab->jumlah_biaya_penginapan }}</td>
                                <td>HARI</td>
                                <td>{{ $rab->lama_hari_penginap }}</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                        @else
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                        @endif
                    </table>
                    <div class="content__item">
                        <span>4.</span>
                        <span>
                            REALISASI BIAYA LAIN-LAIN
                        </span>
                    </div>
                    <table id="tabel">
                        @if (isset($rab->jumlah_biaya_lain))
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>{{ $rab->jumlah_biaya_lain }}</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>{{ $realisasi->jumlah_biaya_lain }}</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                        @else
                            <tr>
                                <td>PENERIMAAN</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>REALISASI</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>KURANG</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TAMBAH</td>
                                <td>Rp</td>
                                <td>-</td>
                                <td>HARI</td>
                                <td>-</td>
                            </tr>
                        @endif
                    </table>
                    <hr>
                    <table style="width:68.5%">
                        <tr>
                            <td id="tebal">I.</td>
                            <td id="tebal">TOTAL SELISIH KURANG</td>
                            <td>:</td>
                            <td style="width:10%">Rp</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td id="tebal">II.</td>
                            <td id="tebal">TOTAL SELISIH TAMBAH</td>
                            <td>:</td>
                            <td style="width:10%">Rp</td>
                            <td>-</td>
                        </tr>
                    </table>
                    <hr>
                    <table style="width:74%">
                        <tr>
                            <td id="tebal">III.</td>
                            <td id="tebal">TOTAL SELISIH</td>
                            <td>:</td>
                            <td style="width:10%">Rp</td>
                            <td>{{ $rab->total }}</td>
                        </tr>
                    </table>


                </main>
                <section class="signature">
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>PELAKSANA PERJALANAN DINAS</strong>
                            <br />
                            <strong></strong>
                        </span>
                        <span class="signature__name">
                            <u><strong>{{ $rab->pengikut->user->name }}</strong></u>
                        </span>
                    </div>
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>PIMPINAN UNIT KERJA/FUNGSI</strong>
                            <br>
                            <strong>GENERAL MANAGER</strong>
                        </span>
                        <span class="signature__name">
                            @foreach ($manajer as $item)
                                <u><strong>{{ $item->name }}</strong></u>
                            @endforeach
                        </span>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printRealisasi"));
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
