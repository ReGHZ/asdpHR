@extends('layouts.panel')
{{-- css surat cuti --}}
@section('css')
    <style>
        /* * {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            padding: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            margin: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            box-sizing: border-box;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } */

        /* body {
                                                                                                                                                                                                                                                                                                                font-size: 1.125rem;
                                                                                                                                                                                                                                                                                                                line-height: 1.625em;
                                                                                                                                                                                                                                                                                                                padding: 4rem;
                                                                                                                                                                                                                                                                                                                background-color: #a0a0a0;
                                                                                                                                                                                                                                                                                                            } */

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
        }

        .header__left {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 96px;
            grid-column: 1 / 3;
            border-right: 1px #242424 solid;
        }

        .header__logo {
            width: 120px;
        }

        .header__title {
            color: #242424;
            font-size: 25px;
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

{{-- content surat cuti --}}
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Permohonan Cuti</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form persetujuan cuti</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-10">
                <a href="{{ route('pengajuan-cuti') }}" class="btn icon btn-primary"><i data-feather="arrow-left"></i>
                    Kembali
                </a>
            </div>
            <div class="col-sm-2">
                <a id="btnPrint" class="btn icon btn-secondary me-1"><i data-feather="printer"></i>
                    Cetak
                </a>
            </div>

        </div>

        <div class="container mb-2 mt-4">
            <div id="printCuti">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}"
                            alt="logo" />
                        <h1 class="header__title">FORMULIR SURAT IZIN CUTI</h1>
                    </div>
                    <div class="header__detail">
                        <div class="header__item">
                            <span class="header__key">No. Dokumen</span>
                            <span class="header__value">: SDM-105.00.04</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Revisi</span>
                            <span class="header__value">: 02</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Berlaku Efektif</span>
                            <span class="header__value">: 4 September 2022</span>
                        </div>
                        <div class="header__item">
                            <span class="header__key">Halaman</span>
                            <span class="header__value">: 1 dari 1</span>
                        </div>
                    </div>
                </header>
                <section class="sender">
                    <div class="sender__detail" id="senderkiri">
                        <table style="width:45%">
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td>PA.207/8/3/ASDP-KTP/2021</td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>:</td>
                                <td>Tidak ada</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>:</td>
                                <td>Persetujuan {{ $persetujuan->pengajuanCuti->jenis_cuti }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="sender__detail" id="senderkanan">
                        <table style="width:55%" id="tabelkanan">
                            <tr>
                                <td></td>
                                <td>Ketapang, {{ tanggal_indonesia($persetujuan->tanggal_surat) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="color:white">.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Kepada:</td>
                            </tr>
                            <tr>
                                <td>Yth.</td>
                                <td>{{ $persetujuan->user->name }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{{ $persetujuan->user->jabatan->nama_jabatan }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>di</td>
                            </tr>
                            <td></td>
                            <td><u>TEMPAT</u></td>
                        </table>
                    </div>
                </section>
                <main class="content">
                    <div class="content__item">
                        <span>1.</span>
                        <span>Menindaklanjuti permohonan pokoknya ini saudara :</span>
                    </div>
                    <div class="content__detail">
                        <div class="detail__profile mb-2">
                            <div class="detail__profile-item">
                                <span>-Nama</span><span>:</span><span>{{ $persetujuan->user->name }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-N I K</span><span>:</span><span>{{ $persetujuan->user->nik }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-Jabatan</span><span>:</span><span>{{ $persetujuan->user->jabatan->nama_jabatan }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-Unit
                                    Kerja</span><span>:</span><span>{{ $persetujuan->user->pegawai->segmen }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-Tanggal</span><span>:</span><span>{{ tanggal_indonesia($persetujuan->pengajuanCuti->tanggal_mulai) }}</span>
                            </div>
                        </div>
                        dengan ini diberitahukan bahwa permohonan {{ $persetujuan->pengajuanCuti->jenis_cuti }} saudara
                        disetujui selama {{ $persetujuan->pengajuanCuti->lama_hari }}
                        ({{ terbilang($persetujuan->pengajuanCuti->lama_hari) }}) hari terhitung mulai tanggal
                        {{ tanggal_indonesia($persetujuan->pengajuanCuti->tanggal_mulai) }} s/d
                        {{ tanggal_indonesia($persetujuan->pengajuanCuti->tanggal_selesai) }}.
                    </div>
                    <div class="content__item">
                        <span>2.</span>
                        <span>
                            Sebelum menjalankan {{ $persetujuan->pengajuanCuti->jenis_cuti }} diperintahkan kepada
                            saudara agar melapor kepada atasan
                            langsung dan melaksanakan serah terima tugas kepada pengganti yang telah ditetapkan serta
                            kembali melaksanakan tugas sesuai dengan batas waktu
                            {{ $persetujuan->pengajuanCuti->jenis_cuti }} yang diberikan;.
                        </span>
                    </div>
                    <div class="content__item">
                        <span>3.</span>
                        <span>
                            Selama melaksanakan Cuti {{ $persetujuan->pengajuanCuti->jenis_cuti }} agar komunikasi tetap
                            berjalan sehingga dapat dilakukan
                            koordinasi setiap saat, dan agar siap dinas ketika dibutuhkan sewaktu-waktu;
                        </span>
                    </div>
                    <div class="content__item">
                        <span>4.</span>
                        <span>
                            Setelah selesai melaksanakan {{ $persetujuan->pengajuanCuti->jenis_cuti }}, agar
                            menginformasikan ke Bagian SDM dan melapor
                            kepada atasan langsung untuk melaksanakan tugas kedinasan kembali;
                        </span>
                    </div>
                    <div class="content__item">
                        <span>5.</span>
                        <span>
                            Apabila batas waktu {{ $persetujuan->pengajuanCuti->jenis_cuti }} sebagaimana butir 1
                            (satu) telah selesai dan saudara belum
                            kembali bertugas maka Saudara akan dikenakan sanksi sesuai dengan ketentuan / peraturan
                            perusahaan yang berlaku;
                        </span>
                    </div>
                    <div class="content__item">
                        <span>6.</span>
                        <span>
                            Demikian Surat Ijin {{ $persetujuan->pengajuanCuti->jenis_cuti }} ini diberikan untuk
                            dipergunakan sebagaimana mestinya.
                        </span>
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
                            <strong>General Manager Cabang Ketapang</strong>
                        </span>
                        <span class="signature__name">
                            @foreach ($manajer as $item)
                                <u><strong>{{ $item->name }}</strong></u>
                                <br>
                                <u><strong>NIK : {{ $item->nik }}</strong></u>
                            @endforeach
                        </span>
                    </div>
                </section>
                <section class="consideration">
                    <span class="consideration__title">
                        <strong><u>Tembusan Yth:</u></strong>
                    </span>
                    <div class="content__item">
                        <span>1.</span>
                        <span>

                        </span>
                    </div>
                    <div class="content__item">
                        <span>2.</span>
                        <span>

                        </span>
                    </div>
                    <div class="content__item">
                        <span>3.</span>
                        <span>

                        </span>
                    </div>
                    <div class="content__item">
                        <span>4.</span>
                        <span>

                        </span>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

{{-- script js --}}
@section('script')
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printCuti"));
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
