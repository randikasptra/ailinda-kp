<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Cetak Surat Izin Masuk' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page {
                size: 10cm 15cm;
                margin: 0.5cm;
            }

            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body class="bg-white text-black text-[11px] font-serif p-4">
    <div class="max-w-[10cm] w-[10cm] h-[15cm] border border-black p-4 shadow-sm">
        <!-- KOP -->
        <div class="text-center mb-4">
            <h1 class="text-[12px] font-bold leading-tight">KEMENTERIAN AGAMA</h1>
            <h2 class="text-[11px] font-semibold">MAN 1 KOTA TASIKMALAYA</h2>
        </div>

        <div class="text-center font-bold underline text-[12px] mb-2">SURAT IZIN MASUK</div>

        <p class="text-[11px]">Yang bertandatangan di bawah ini menerangkan bahwa:</p>

        <table class="mt-2 w-full text-[11px] leading-tight">
            <tr>
                <td class="w-28">Nama</td>
                <td>: <?= esc($izin['nama']) ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: <?= esc($izin['kelas']) ?> <?= esc($izin['jurusan']) ?></td>
            </tr>
            <tr>
                <td>Alasan Terlambat</td>
                <td>: <?= esc($izin['alasan']) ?></td>
            </tr>
            <tr>
                <td>Tindak Lanjut</td>
                <td>: <?= esc($izin['tindak_lanjut']) ?></td>
            </tr>
        </table>

        <div class="mt-6 text-[11px]">
            <p>Tasikmalaya, <?= date('d F Y', strtotime($izin['created_at'])) ?></p>
        </div>

        <!-- TTD -->
        <div class="mt-8 flex justify-between text-[11px]">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p class="mb-10">Guru Piket</p>
                <p></p>
                <p class="text-[10px]">NIP. ......................</p>
            </div>

            <div class="text-center">
                <p class="mb-10">Ttd. Siswa</p>
                <p></p>
            </div>
        </div>
    </div>

    <!-- Tombol -->
    <div class="no-print text-center mt-6 flex justify-center space-x-3">
        <!-- Print -->
        <button onclick="window.print()"
            class="flex items-center bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2h-2M6 18v4h12v-4M6 14h.01M18 14h.01" />
            </svg>
            Cetak
        </button>

        <!-- Kembali -->
        <a href="<?= base_url('piket/izin_masuk') ?>"
            class="flex items-center bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

</body>

</html>