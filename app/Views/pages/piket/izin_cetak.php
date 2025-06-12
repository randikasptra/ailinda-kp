<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 40px;
        }

        .surat-container {
            max-width: 800px;
            margin: auto;
            padding: 40px;
            border: 1px solid #000;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 90px;
            height: auto;
        }

        .kop-text {
            flex: 1;
            text-align: center;
        }

        .kop-text h1 {
            font-size: 20px;
            margin: 0;
        }

        .kop-text h2 {
            font-size: 18px;
            margin: 0;
            font-weight: normal;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 14px;
        }

        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 18px;
            margin: 20px 0;
        }

        table {
            margin-top: 20px;
            width: 100%;
        }

        td {
            padding: 6px;
            vertical-align: top;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
        }

        .print-btn {
            display: inline-block;
            margin-top: 30px;
            text-align: center;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="surat-container">

    <div class="kop-surat">
        <img src="<?= base_url('logo-madrasah.png') ?>" alt="Logo Madrasah">
        <div class="kop-text">
            <h1>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
            <h2>MAN 1 KOTA TASIKMALAYA</h2>
            <p>Jl. Letnan Harun No. 30, Kota Tasikmalaya, Jawa Barat 46115</p>
            <p>Telp: (0265) 331336 – Email: man1kotatasik@gmail.com</p>
        </div>
    </div>

    <div class="judul-surat">SURAT IZIN KELUAR</div>

    <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

    <table>
        <tr>
            <td><strong>Nama</strong></td>
            <td>: <?= esc($izin['nama']) ?></td>
        </tr>
        <tr>
            <td><strong>NISN</strong></td>
            <td>: <?= esc($izin['nisn']) ?></td>
        </tr>
        <tr>
            <td><strong>Kelas</strong></td>
            <td>: <?= esc($izin['kelas']) ?></td>
        </tr>
        <tr>
            <td><strong>Alasan</strong></td>
            <td>: <?= esc($izin['alasan']) ?></td>
        </tr>
        <tr>
            <td><strong>Jam Keluar</strong></td>
            <td>: <?= esc($izin['waktu_keluar']) ?></td>
        </tr>
        <tr>
            <td><strong>Jam Kembali</strong></td>
            <td>: <?= esc($izin['waktu_kembali']) ?></td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>: <?= date('d M Y', strtotime($izin['created_at'])) ?></td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        Diberikan izin keluar dari madrasah karena alasan tersebut di atas.<br>
        Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.
    </p>

    <div class="ttd">
        Tasikmalaya, <?= date('d M Y', strtotime($izin['created_at'])) ?><br>
        Guru Piket<br><br><br>
        <strong>( ................................ )</strong>
    </div>
</div>

<div style="text-align: center;">
    <button onclick="window.print()" class="print-btn">🖨️ Cetak Surat</button>
</div>

</body>
</html>
