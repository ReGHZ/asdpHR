<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>Anu</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-size: 1.125rem;
            line-height: 1.625em;
            padding: 4rem;
            background-color: #a0a0a0;
        }

        .container {
            max-width: 980px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 4rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.1);
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
            gap: 5rem;
            grid-column: 1 / 3;
            border-right: 1px #242424 solid;
        }

        .header__logo {
            width: 120px;
        }

        .header__title {
            color: #242424;
            font-size: 1.500rem;
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
            padding: 0 0.75rem;
        }

        .header__item:not(:last-child) {
            border-bottom: 1px #242424 solid;
        }

        .header__key,
        .header__value {
            flex: 1;
        }

        .sender {
            padding-top: 1.5rem;
        }

        .sender__detail {
            display: grid;
            grid-template-rows: repeat(8, 1fr);
            grid-template-columns: 4rem 1fr;
            margin-left: auto;
            width: 50%;
        }

        .sender__detail-prefix {
            justify-self: end;
            grid-row: 3 / 4;
            grid-column: 1 / 2;
            margin-right: 1rem;
        }

        .sender__data:nth-child(2) {
            grid-row: 1 / 3;
        }

        .sender__data {
            grid-column: 2 / 3;
        }

        .content {
            padding-top: 2rem;
        }

        .content__item {
            display: grid;
            grid-template-columns: 2rem 1fr;
            padding: 0.5rem 0;
        }

        .content__detail {
            padding-left: 4rem;
        }

        .detail__profile {
            padding: 1rem 0 1rem 4rem;
        }

        .detail__profile-item {
            display: grid;
            grid-template-columns: 10rem 2rem 1fr;
        }

        .signature {
            display: flex;
            padding-top: 4rem;
            align-items: stretch;
            justify-content: center;
            height: 14rem;
        }

        .signature {
            padding-top: 4rem;
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
            padding-top: 4rem;
        }

        .consideration__field {
            height: 1.25rem;
            margin-left: 2rem;
            border-bottom: 2px #242424 dotted;
        }

        .note {
            padding-top: 4rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header__left">
                <img class="header__logo" src="{{ asset('backend/assets/images/logo/asdp.png') }}" alt="logo" />
                <h1 class="header__title">FORMULIR PENGAJUAN CUTI</h1>
            </div>
            <div class="header__detail">
                <div class="header__item">
                    <span class="header__key">No. Dokumen</span>
                    <span class="header__value">: SDM-106.00.03 </span>
                </div>
                <div class="header__item">
                    <span class="header__key">Revisi</span>
                    <span class="header__value">: 0</span>
                </div>
                <div class="header__item">
                    <span class="header__key">Berlaku Efektif</span>
                    <span class="header__value">: 2022</span>
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
                <div class="sender__data">Ketapang, {{ $cuti->tanggal_surat }}</div>
                <div class="sender__data">Kepada:</div>
                <div class="sender__data">General Manager</div>
                <div class="sender__data">PT.Dontol sejahtera(Persero)</div>
                <div class="sender__data">Cabang Bandung</div>
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
                        <span>-Nama</span><span>:</span><span>{{ $cuti->usercuti->name }}</span>
                    </div>
                    <div class="detail__profile-item">
                        <span>-N I K</span><span>:</span><span>{{ $cuti->usercuti->nik }}</span>
                    </div>
                    <div class="detail__profile-item">
                        <span>-Jabatan</span><span>:</span><span>{{ $cuti->usercuti->jabatan->nama_jabatan }}</span>
                    </div>
                    <div class="detail__profile-item">
                        <span>-Unit Kerja</span><span>:</span><span>{{ $cuti->usercuti->pegawai->segmen }}</span>
                    </div>
                    <div class="detail__profile-item">
                        <span>-No. HP</span><span>:</span><span>{{ $cuti->usercuti->no_hp }}</span>
                    </div>
                </div>
                <ul>
                    <li>
                        <p>
                            {{ $cuti->keterangan }}
                        </p>
                    </li>
                </ul>
            </div>
            <div class="content__item">
                <span>2.</span>
                <span>
                    Selama menjalankan bundir alamat kami adalah :Jl. Jati diri wibu
                    nomor 69
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
                    <strong>Manager Dontol Santosa</strong>
                </span>
                <span class="signature__name">
                    <u><strong>Dontol</strong></u>
                </span>
            </div>
            <div class="signature__item">
                <span class="signature__title">
                    <strong>Pemohon</strong>
                </span>
                <span class="signature__name">
                    <u><strong>Dontol Saroja</strong></u>
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
                <span style="padding-left: 0.5rem">= Coret yang tidak perlu;</span>
            </p>
            <p>
                <sup>2</sup>)
                <span style="padding-left: 0.5rem">
                    = Harus diisi oleh Dontol / atasan langsung yang bersangkutan
                </span>
            </p>
        </section>
    </div>
</body>

</html>
