<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Izin Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        h2 {
            text-align: center;
        }

        .izin-detail {
            margin-top: 30px;
        }

        .izin-detail table {
            width: 100%;
            border-collapse: collapse;
        }

        .izin-detail td {
            padding: 8px;
            vertical-align: top;
        }

        .izin-detail td.label {
            width: 200px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <h2>Surat Izin Siswa</h2>

    <div class="izin-detail">
        <table>
            <tr>
                <td class="label">Nama</td>
                <td>: <?= esc($izin['nama']) ?></td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td>: <?= esc($izin['nisn']) ?></td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: <?= esc($izin['kelas']) ?></td>
            </tr>
            <tr>
                <td class="label">Alasan Izin</td>
                <td>: <?= esc($izin['alasan']) ?></td>
            </tr>
            <tr>
                <td class="label">Waktu Keluar</td>
                <td>: <?= esc($izin['waktu_keluar']) ?></td>
            </tr>
            <tr>
                <td class="label">Waktu Kembali</td>
                <td>: <?= esc($izin['waktu_kembali']) ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal</td>
                <td>: <?= date('d-m-Y', strtotime($izin['created_at'])) ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Tanda tangan Guru Piket</p>
        <br><br><br>
        <p>________________________</p>
    </div>

    <div class="no-print" style="margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background-color: #1E5631; color: white; border: none; border-radius: 5px;">Cetak</button>
    </div>

</body>

</html>