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

        #tabel_a tr td {
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
            /*border: 1px gray solid;*/
            /*border-collapse: collapse;*/
            text-align: center;
        }

        #hariankanan tr td {
            /*border: 1px red solid;*/
            /*border-collapse: collapse;*/
        }

        #penginapankanan tr td {
            /*border: 1px blue solid;*/
            /*border-collapse: collapse;*/
        }

        #tabeljumlah tr td {
            /*border: 1px brown solid;*/
            /*border-collapse: collapse;*/
        }

        #lainlain {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .alignkanan {
            text-align: right;
            padding-right: 15px;
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
                    <h3>Form Realisai Perhitungan Biaya</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form realisasi perhitungan biaya</li>
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
            <div id="printRAB">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}" alt="logo" />
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
                            <span class="header__value">: 2019</span>
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
                                <td>SPEN.{{ $rab->perjalananDinas->nomor_surat }}/UM.102/ASDP-KTP/{{ \Carbon\Carbon::now()->year }}
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>{{ $rab->pengikut->user->name }}</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Tempat Asal</td>
                                <td>:</td>
                                @foreach ($manajer as $item)
                                    <td>{{ $item->segmen }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Tanggal Berangkat</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($rab->perjalananDinas->tanggal_keberangkatan) }}</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Jumlah Hari</td>
                                <td>:</td>
                                <td>{{ $realisasi->lama_hari }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="sender__detail" id="senderkanan">
                        <table style="width:100%; height:80%" id="tabelkanan">
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($rab->perjalananDinas->tanggal_surat) }}</td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td>:</td>
                                <td>{{ $rab->pengikut->user->pegawai->golongan }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>:</td>
                                <td>{{ $rab->perjalananDinas->tujuan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kembali</td>
                                <td>:</td>
                                <td>{{ tanggal_indonesia($rab->perjalananDinas->tanggal_kembali) }}</td>
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
                    @if (isset($realisasi->maskapai))
                        <table id="tabel_a" style="width:100%">
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
                                <td>{{ $rab->perjalananDinas->tanggal_keberangkatan }}</td>
                                <td>{{ $realisasi->maskapai }}</td>
                                <td>{{ $realisasi->tempat_berangkat }}</td>
                                <td>{{ $realisasi->tempat_tujuan }}</td>
                                <td>{{ $realisasi->harga_tiket }}</td>
                                @if (isset($realisasi->charge))
                                    <td>{{ $realisasi->charge }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if (isset($realisasi->jumlah_harga_tiket))
                                    <td>{{ $realisasi->jumlah_harga_tiket }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>{{ $rab->perjalananDinas->tanggal_kembali }}</td>
                                <td></td>
                                <td></td>
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
                                @if (isset($realisasi->jumlah_harga_tiket))
                                    <td>{{ $realisasi->jumlah_harga_tiket }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        </table>
                    @else
                        <table id="tabel_a" style="width:100%">
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
                                <td>{{ $rab->perjalananDinas->tanggal_keberangkatan }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>{{ $rab->perjalananDinas->tanggal_kembali }}</td>
                                <td></td>
                                <td></td>
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
                                <td></td>
                            </tr>
                        </table>
                    @endif
                    <div class="content__item">
                        <span>B.</span>
                        <span>BIAYA HARIAN</span>
                    </div>

                    <section class="sender">
                        <div class="sender__detail">
                            <table id="hariankiri" style="width:100%">
                                <tr style="border-bottom: 1pt solid black">
                                    <td>1.</td>
                                    <td>{{ $realisasi->lama_hari }}x{{ $realisasi->biaya_harian }}</td>
                                </tr>
                                <tr style="border-bottom: 1pt solid black">
                                    <td>2.</td>
                                    <td>-</td>
                                </tr>
                            </table>
                        </div>
                        <div class="sender__detail">
                            <table id="hariankanan" style="width:100%">
                                <tr>
                                    <td class="alignkanan" style="width:50%">-</td>
                                    <td style="width:50%">-</td>
                                </tr>
                                <tr>
                                    <td class="alignkanan" style="width:50%">Jumlah</td>
                                    <td>{{ $realisasi->jumlah_biaya_harian }}</td>
                                </tr>
                                <tr>
                                    <td class="alignkanan" style="width:50%">Jumlah</td>
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
                        <div class="sender__detail">
                            <table id="penginapankiri" style="width:100%">
                                @if (isset($realisasi->biaya_penginapan))
                                    <tr style="border-bottom: 1pt solid black">
                                        <td>1.</td>
                                        <td> {{ $realisasi->lama_hari_penginap }}x{{ $realisasi->biaya_penginapan }}
                                        </td>
                                    </tr>
                                @else
                                    <tr style="border-bottom: 1pt solid black">
                                        <td>1.</td>
                                        <td>............. x ...........</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="sender__detail">
                            <table id="penginapankanan" style="width:100%">
                                <tr>
                                    <td class="alignkanan" style="width:50%">-</td>
                                    <td style="width:50%">-</td>
                                </tr>
                                <tr>
                                    <td class="alignkanan" style="width:50%">Jumlah</td>
                                    @if (isset($realisasi->biaya_penginapan))
                                        <td>{{ $realisasi->jumlah_biaya_penginapan }}</td>
                                    @else
                                        <td style="width:50%"></td>
                                    @endif
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
                        @if (isset($realisasi->realisasiBLain))
                            <table id="lainlain" style="width:100%">
                                @foreach ($realisasi->realisasiBLain as $i => $item)
                                    <tr style="border-bottom: 1pt solid black">
                                        <td>{{ ++$i }}</td>

                                        <td style="width:60%">{{ $item->qty }} x
                                            {{ $item->jenis }}</td>
                                        <td style="width:10%">Jumlah</td>
                                        <td style="width:25%">{{ $item->biaya_lain }}</td>
                                    </tr>
                                @endforeach

                                <tr style="border-bottom: 1pt solid black">
                                    <td>-</td>
                                    <td style="width:60%">-</td>
                                    <td style="width:10%">Jumlah</td>
                                    @if (isset($realisasi->jumlah_biaya_lain))
                                        <td style="width:25%">{{ $realisasi->jumlah_biaya_lain }}</td>
                                    @else
                                        <td style="width:25%"></td>
                                    @endif
                                </tr>
                            </table>
                        @endif
                    </section>
                    <table id="tabeljumlah" style="width:100%">
                        <tr>
                            <td>E.</td>
                            <td style="width:30%">JUMLAH A s/d D</td>
                            <td>:................................................</td>
                            <td style="width:10%">Jumlah</td>
                            <td style="width:25%">{{ $realisasi->total }}</td>
                        </tr>
                        <tr style="border-bottom: 1pt solid black">
                            @if (isset($realisasi->tanggal_uang_muka))
                                <td></td>
                                <td>Uang Muka Tanggal</td>
                                <td>:{{ $realisasi->tanggal_uang_muka }}</td>
                                <td>Jumlah</td>
                                <td>{{ $realisasi->biaya_kas }}</td>
                            @else
                                <td></td>
                                <td>Uang Muka</td>
                                <td>:................................................</td>
                                <td>Jumlah</td>
                                <td>-</td>
                            @endif
                        </tr>
                        <tr>
                            @if (isset($realisasi->biaya_kas))
                                <td></td>
                                <td>Untuk Distor kembali ke KAS</td>
                                <td>.................................................</td>
                                <td>Jumlah</td>
                                <td>{{ $realisasi->biaya_kas }}</td>
                            @else
                                <td></td>
                                <td>Untuk Distor kembali ke KAS</td>
                                <td>.................................................</td>
                                <td>Jumlah</td>
                                <td>-</td>
                            @endif

                        </tr>
                        <tr>
                            @if (isset($realisasi->biaya_ybs))
                                <td></td>
                                <td>Untuk dibayarkan kepada Ybs</td>
                                <td>.................................................</td>
                                <td>Jumlah</td>
                                <td>{{ $realisasi->biaya_ybs }}</td>
                            @else
                                <td></td>
                                <td>Untuk dibayarkan kepada Ybs</td>
                                <td>.................................................</td>
                                <td>Jumlah</td>
                                <td>-</td>
                            @endif
                        </tr>
                    </table>
                </main>
                <section class="signature">
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>YANG BEPERGIAN</strong>
                        </span>
                        <span class="signature__name">
                            <u><strong>{{ $rab->pengikut->user->name }}</strong></u>
                        </span>
                    </div>
                    <div class="signature__item">
                        <span class="signature__title">
                            <span class="sign-note">Dikeluarkan di : </span>
                            @foreach ($manajer as $item)
                                <span class="sign-note">{{ $item->segmen }}</span>
                            @endforeach
                            <br>
                            <span class="sign-note">Tanggal : </span><span
                                class="sign-note">{{ tanggal_indonesia($rab->perjalananDinas->tanggal_surat) }}</span>
                            <br>
                            <strong>General Manager</strong>
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
@endpush
