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
            margin-bottom: 10px;
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

            display: flex;
            align-items: stretch;
            justify-content: center;
            height: auto;
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

        table,
        tr,
        td {
            /*border: 1px red solid;*/
            border-collapse: collapse;
            text-align: center;
        }

        #tabel_pertama tr td {
            border: 1px black solid;
            border-collapse: collapse;
            text-align: center;
        }

        #hariankiri {
            border-collapse: collapse;
        }

        .garisbawah {
            border: 1px black solid;
        }

        #lainlain tr td {
            /*border: 1px red solid;*/
            /*border-collapse: collapse;*/
            text-align: left;
        }

        #lainlain {
            margin-top: 30px;

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
                    <h3>Form Perhitungan Biaya</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form perhitungan biaya</li>
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
            <div id="printRAB">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}"
                            alt="logo" />
                        <h1 class="header__title">FORMULIR PERHITUNGAN BIAYA PERJALANAN DINAS</h1>
                    </div>
                    <div class="header__detail">
                        <div class="header__item">
                            <span class="header__key">No. Dokumen</span>
                            <span class="header__value">: PPU-204.00.02</span>
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
                <div class="basic_content">
                    DAFTAR PERHITUNGAN BIAYA PERJALANAN DINAS
                </div>
                <hr>
                <section class="sender">
                    <div class="sender__detail" id="senderkiri">
                        <table style="width:100%">
                            <tr>
                                <td>1.</td>
                                <td>SPPD No</td>
                                <td>:</td>
                                <td>SPEN.{{ $penugasan->nomor_surat }}/UM.102/ASDP-KTP/{{ \Carbon\Carbon::now()->year }}
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>{{ $penugasan->user->name }}</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Tempat Asal</td>
                                <td>:</td>
                                <td>Ketapang</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Tanggal Berangkat</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($penugasan->tanggal_keberangkatan) }}</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Jumlah Hari</td>
                                <td>:</td>
                                <td>{{ $penugasan->lama_hari }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="sender__detail" id="senderkanan">
                        <table style="width:100%; height:80%" id="tabelkanan">
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($penugasan->tanggal_surat) }}</td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td>:</td>
                                <td>D</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>:</td>
                                <td>{{ $penugasan->tujuan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kembali</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($penugasan->tanggal_kembali) }}</td>
                            </tr>
                        </table>
                    </div>
                </section>
                <hr>
                <main class="content">
                    <div class="content__item">
                        <span>A.</span>
                        <span>PERJALANAN DARI TEMPAT ASAL, TUJUAN, TIKET DAN AIRPORT CHARGE DLL:</span>
                    </div>
                    <table id="tabel_pertama" style="width:100%">
                        <tr>
                            <td rowspan="2">Tanggal</td>
                            <td rowspan="2" style="width:15%">Perusahaan Penerbangan</td>
                            <td rowspan="2" style="width:10%">Dari</td>
                            <td rowspan="2" style="width:10%">Ke</td>
                            <td colspan="2">Harga</td>
                            <!--PLACEHOLDER-->
                            <td rowspan="2">Jumlah (Rp)</td>
                        </tr>
                        <tr>
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <td style="width:10%">Tiket</td>
                            <td style="width:10%">Charge</td>
                            <!--PLACEHOLDER-->
                        </tr>
                        <tr>
                            <td>{{ $penugasan->tanggal_keberangkatan }}</td>
                            <td>{{ $penugasan->tiketPerjalanan->maskapai }}</td>
                            <td></td>
                            <td>{{ $penugasan->tujuan }}</td>
                            <td>{{ $penugasan->tiketPerjalanan->harga_tiket }}</td>
                            <td>{{ $penugasan->tiketPerjalanan->charge }}</td>
                            <td>{{ $penugasan->tiketPerjalanan->total }}</td>
                        </tr>
                        <tr>
                            <td>{{ $penugasan->tanggal_kembali }}</td>
                            <td></td>
                            <td>{{ $penugasan->tujuan }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <!--PLACEHOLDER-->
                            <td>Jumlah</td>
                            <td>{{ $penugasan->tiketPerjalanan->total }}</td>
                        </tr>
                    </table>
                    <div class="content__item">
                        <span>B.</span>
                        <span>BIAYA HARIAN</span>
                    </div>

                    <section class="sender">
                        <div class="sender__detail" id="senderkiri">
                            <table id="hariankiri" style="width:100%">
                                <tr style="border-bottom: 1pt solid black">
                                    <td>1.</td>
                                    <td>{{ $penugasan->lama_hari }} x {{ $penugasan->biayaHarian->biaya }}</td>

                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>2.</td>
                                    <td></td>

                                </tr>
                            </table>
                        </div>
                        <div class="sender__detail" id="hariankanan">
                            <table style="width:100%">
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>{{ $penugasan->biayaHarian->total }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>-</td>
                                </tr>
                            </table>
                        </div>
                    </section>

                    <div class="content__item">
                        <span>C.</span>
                        <span>BIAYA PENGINAPAN</span>
                    </div>
                    <section class="sender">
                        <div class="sender__detail" id="senderkiri">
                            <table id="hariankiri" style="width:100%">
                                <tr style="border-bottom: 1pt solid black">
                                    <td>1.</td>
                                    <td>{{ $penugasan->biayaPenginapan->jumlah }} x
                                        {{ $penugasan->biayaPenginapan->biaya }} </td>
                                </tr>
                            </table>
                        </div>
                        <div class="sender__detail" id="hariankanan">
                            <table style="width:100%">
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>{{ $penugasan->biayaPenginapan->total }} </td>
                                </tr>
                            </table>
                        </div>
                    </section>
                    <div class="content__item">
                        <span>D.</span>
                        <span>
                            LAIN-LAIN
                        </span>
                    </div>
                    <section class="sender">
                        <div class="sender__detail" id="senderkiri">
                            <table id="hariankiri" style="width:100%">
                                <tr style="border-bottom: 1pt solid black">
                                    <td>1.</td>
                                    <td></td>
                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>2.</td>
                                    <td></td>
                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>3.</td>
                                    <td> </td>
                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>.</td>
                                    <td>-</td>
                                </tr>
                            </table>
                        </div>
                        <div class="sender__detail" id="hariankanan">
                            <table style="width:100%">
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>Jumlah</td>
                                    <td>10.000.000</td>
                                </tr>
                            </table>
                        </div>
                    </section>
                    <table id="lainlain" style="width:100%">
                        <tr>
                            <td>E.</td>
                            <td style="width:30%">JUMLAH A s/d D</td>
                            <td style="width:30%">:..............................................</td>
                            <td>Jumlah</td>
                            <td>3.900.000</td>
                        </tr>
                        <tr style="border-bottom: 1pt solid black">
                            <td></td>
                            <td style="width:30%">Uang Muka Tanggal</td>
                            <td style="width:30%">:..............................................</td>
                            <td>Jumlah</td>
                            <td>3.900.000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width:30%">Untuk Distor kembali ke KAS</td>
                            <td style="width:30%">...............................................</td>
                            <td>Jumlah</td>
                            <td>3.900.000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width:30%">Untuk dibayarkan kepada Ybs</td>
                            <td style="width:30%">...............................................</td>
                            <td>Jumlah</td>
                            <td>3.900.000</td>
                        </tr>
                    </table>
                </main>
                <section class="signature">
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>YANG BEPERGIAN</strong>
                        </span>
                        <span class="signature__name">
                            <u><strong>{{ $penugasan->user->name }}</strong></u>
                        </span>
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
@section('script')
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printRAB"));
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
@endsection
