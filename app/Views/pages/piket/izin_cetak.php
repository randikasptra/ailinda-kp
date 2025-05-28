<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        td {
            padding: 8px;
        }

        .print-btn {
            display: none;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <h2>Surat Izin Siswa</h2>

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

    <br><br>
    <p>Mengetahui,</p>
    <br><br>
    <p>...............................</p>
    <p>Guru Piket</p>

    <br><br>
    <button onclick="window.print()" class="print-btn">Cetak</button>

</body>

</html>