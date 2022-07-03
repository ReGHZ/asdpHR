@extends('layouts.panel')
{{-- css surat cuti --}}
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

            padding-top: 24;
        }

        .sender__detail {

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
            padding-left: 64px;
        }

        .detail__profile {
            padding: 16px 0 16px 64px;
        }

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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <li class="breadcrumb-item active" aria-current="page">Form permohonan cuti</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('pengajuan-cuti') }}" class="btn icon btn-primary"><i data-feather="arrow-left"></i>
                    Kembali
                </a>

                <a id="btnPrint" class="btn icon btn-secondary me-1"><i data-feather="printer"></i>
                    Cetak
                </a>
                @role('admin|manajer')
                    @if (isset($pengajuan->status) && $pengajuan->status == 'Menunggu konfirmasi')
                        <button value="{{ $pengajuan->id }}" class="btn icon btn-danger me-1 rejectbtn"><i
                                data-feather="x-circle"></i>
                            Tolak
                        </button>
                    @endif
                    @if (isset($pengajuan->status) && $pengajuan->status == 'Menunggu konfirmasi')
                        <button value="{{ $pengajuan->id }}" class="btn icon btn-success approvebtn"><i
                                data-feather="check"></i>
                            Terima
                        </button>
                    @endif
                    @if ($pengajuan->jenis_cuti == 'Cuti sakit' && isset($pengajuan->file_surat_dokter))
                        <a href="{{ route('pengajuan-cuti.download', $pengajuan->id) }}" class="btn icon btn-secondary "><i
                                data-feather="download"></i>
                            Surat Dokter
                        </a>
                    @endif
                @endrole
            </div>
        </div>

        <div class="container mb-4 mt-4">
            <div id="printCuti">
                <header class="header">
                    <div class="header__left">
                        <img class="header__logo" src="{{ asset('backend/assets/images/logo/ASDP.png') }}"
                            alt="logo" />
                        <h1 class="header__title">FORMULIR PERMOHONAN CUTI</h1>
                    </div>
                    <div class="header__detail">
                        <div class="header__item">
                            <span class="header__key">No. Dokumen</span>
                            <span class="header__value">: SDM-106.00.03</span>
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
                <section class="sender">
                    <div class="sender__detail">
                        <div class="sender__detail-prefix">Yth.</div>
                        <div class="sender__data mt-2">Ketapang,
                            <span>{{ tanggal_indonesia($pengajuan->tanggal_surat) }}</span>
                        </div>
                        <div class="sender__data">Kepada:</div>
                        <div class="sender__data">General Manager</div>
                        <div class="sender__data">PT.ASDP Indonesia(Persero)</div>
                        <div class="sender__data">Cabang Ketapang</div>
                        <div class="sender__data">di</div>
                        <div class="sender__data"><u>TEMPAT</u></div>
                    </div>
                </section>
                <main class="content">
                    <div class="content__item">
                        <span>1.</span>
                        <span>Yang bertanda tangan dibawah ini :</span>
                    </div>
                    <div class="content__detail">
                        <div class="detail__profile">
                            <div class="detail__profile-item">
                                <span>-Nama</span><span>:</span><span class="name">{{ $pengajuan->user->name }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-N I K</span><span>:</span><span class="nik">{{ $pengajuan->user->nik }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-Jabatan</span><span>:</span><span
                                    class="jabatan">{{ $pengajuan->user->jabatan->nama_jabatan }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-Unit Kerja</span><span>:</span><span
                                    class="segmen">{{ $pengajuan->user->pegawai->segmen }}</span>
                            </div>
                            <div class="detail__profile-item">
                                <span>-No. HP</span><span>:</span><span
                                    class="no_hp">{{ $pengajuan->user->no_hp }}</span>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <p>
                                    Mengajukan permohonan {{ $pengajuan->jenis_cuti }} Selama
                                    {{ $pengajuan->lama_hari }} ({{ terbilang($pengajuan->lama_hari) }}) hari kerja,
                                    terhitung mulai tanggal
                                    {{ tanggal_indonesia($pengajuan->tanggal_mulai) }} s/d
                                    {{ tanggal_indonesia($pengajuan->tanggal_selesai) }}

                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="content__item">
                        <span>2.</span>
                        <span>
                            Selama menjalankan {{ $pengajuan->jenis_cuti }} alamat kami adalah :
                            {{ $pengajuan->user->alamat }}
                        </span>
                    </div>
                    <div class="content__item">
                        <span>3.</span>
                        <span>
                            Demikian permohonan kami ini kami sampaikan, atas persetujuannya
                            diucapkan terima kasih
                        </span>
                    </div>
                </main>
                <section class="signature">
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>Mengetahui,</strong>
                            <br />
                            <strong>Manager SDM & Umum</strong>
                        </span>
                        <span class="signature__name">
                            @foreach ($manajerSDM as $item)
                                <u><strong>{{ $item->name }}</strong></u>
                            @endforeach
                        </span>
                    </div>
                    <div class="signature__item">
                        <span class="signature__title">
                            <strong>Pemohon</strong>
                        </span>
                        <span class="signature__name">
                            <u><strong>{{ $pengajuan->user->name }}</strong></u>
                        </span>
                    </div>
                </section>
                <section class="consideration">
                    <span class="consideration__title">
                        <strong><u>Pertimbangan Atasan:</u> <sup>2</sup>)</strong>
                    </span>
                    <div class="consideration__field"></div>
                    <div class="consideration__field"></div>
                    <div class="consideration__field"></div>
                </section>
                <section class="note">
                    <p>
                        <strong><u>Catatan :</u></strong>
                    </p>
                    <p>
                        <sup>1</sup>)
                        <span style="padding-left: 8px">= Coret yang tidak perlu;</span>
                    </p>
                    <p>
                        <sup>2</sup>)
                        <span style="padding-left: 8px">
                            = Harus diisi oleh Nahkoda / atasan langsung yang bersangkutan
                        </span>
                    </p>
                </section>
            </div>
        </div>
    </div>
    @include('cuti.persetujuan.approve')
    @include('cuti.persetujuan.reject')
@endsection

{{-- script js --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        $('select').selectpicker();
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.approvebtn', function() {
                var pengajuan_id = $(this).val();
                // alert(emp_id);
                $('#approveCuti').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/pengajuan-cuti/" + pengajuan_id + "/getPengajuan",
                    dataType: 'json',
                    success: function(response) {
                        $('#pengajuan_id').val(response.pengajuan.id);
                    }
                });
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.rejectbtn', function() {
                var pengajuan_id = $(this).val();
                // alert(emp_id);
                $('#rejectCuti').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/pengajuan-cuti/" + pengajuan_id + "/getPengajuan",
                    dataType: 'json',
                    success: function(response) {
                        $('#pengajuan_iid').val(response.pengajuan.id);
                    }
                });
            });
        });
    </script>
@endpush
