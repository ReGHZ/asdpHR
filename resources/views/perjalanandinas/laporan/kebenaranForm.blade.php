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

            margin-bottom: 70px;
        }

        .header__left {
            padding-left: 20px;
            display: flex;
            align-items: center;
            justify-content: left;
            /*gap: 40px;*/
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
        }

        .basic_content {
            margin-top: 20px;
            margin-bottom: 20px;
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
                    <h3>Form Pernyataan Kebenaran</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form pernyataan kebenaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                @role('admin|manajer')
                    <a href="{{ route('perjalanan-dinas.createRab', $rab->perjalananDinas->id) }}"
                        class="btn icon btn-primary"><i data-feather="arrow-left"></i>
                        Kembali
                    </a>
                @endrole
                @role('user')
                    <a href="{{ route('laporan-dinas') }}" class="btn icon btn-primary me-1"><i data-feather="arrow-left"></i>
                        Kembali
                    </a>
                @endrole
                <a id="btnPrint" class="btn icon btn-secondary me-1"><i data-feather="printer"></i>
                    Cetak
                </a>
            </div>
        </div>

        <div class="container mb-4 mt-4">
            <div id="kebenaranPrint">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}" alt="logo" />
                        <h1 class="header__title">FORMULIR SURAT PERNYATAAN KEBERNARAN </h1>
                    </div>

                </header>
                <main class="content">
                    <div class="basic_content">
                        Kami yang bertanda tangan di bawah ini :
                    </div>
                    <div class="content__detail">
                        <div class="detail__profile">
                            <div class="detail__profile-item">
                                <span>Nama</span><span>:</span><span>{{ $rab->pengikut->user->name }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>Jabatan</span><span>:</span><span>{{ $rab->pengikut->user->pegawai->Jabatan }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>NIK</span><span>:</span><span>{{ $rab->pengikut->user->nik }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="basic_content">
                        Selanjutnya disebut dengan "Pemberi Pernyataan".
                    </div>
                    <div class="basic_content">
                        Dengan ini menyatakan hal-hal sebagai berikut :
                    </div>
                    <div class="basic_content">
                        Bahwa Pemberi Pernyataan menyatakan adalah benar biaya-biaya yang dikeluarkan oleh Pemberi
                        Pernyataan dengan rincian sebagai berikut :
                    </div>
                    <table id="tabel">
                        <tr>
                            <td>1.</td>
                            <td>Biaya Tiket Pesawat, sebesar</td>
                            <td>:</td>
                            <td>Rp</td>
                            <td>{{ $realisasi->jumlah_harga_tiket }}</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Biaya Hotel, sebesar</td>
                            <td>:</td>
                            <td>Rp</td>
                            <td>{{ $realisasi->jumlah_biaya_penginapan }}</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Biaya Harian, sebesar</td>
                            <td>:</td>
                            <td>Rp</td>
                            <td>{{ $realisasi->jumlah_biaya_harian }}</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Biaya lainnya, sebesar</td>
                            <td>:</td>
                            <td>Rp</td>
                            <td>{{ $realisasi->jumlah_biaya_lain }}</td>
                        </tr>
                    </table>
                    <div class="basic_content">
                        Dalam rangka Perjalanan Dinas untuk :
                    </div>
                    <div class="basic_content">
                        Biaya Perjalanan Dinas Ke {{ $rab->perjalananDinas->tujuan }}
                    </div>
                    <div class="basic_content">
                        Demikian Surat Pernyataan ini dibuat dengan sebenar-benarnya oleh Pemberi Pernyataan dan oleh
                        karenanya Pemberi Pernyataan menjadmin kebenarannya serta siap dibuktikan kebenarannya.
                    </div>

                </main>
                <section class="signature">
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong></strong>
                            <br />
                            <strong></strong>
                        </span>
                        <span class="signature__name">
                            <u><strong></strong></u>
                        </span>
                    </div>
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>Ketapang, {{ tanggal_indonesia($rab->perjalananDinas->tanggal_surat) }}</strong>
                        </span>
                        <span class="signature__name">
                            <u><strong>{{ $rab->pengikut->user->name }}</strong></u>
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
            printElement(document.getElementById("kebenaranPrint"));
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
