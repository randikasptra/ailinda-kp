</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
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
        <!-- Kop Surat -->
        <div class="flex items-center border-b-2 border-black pb-2 mb-2">
            <img src="<?= base_url('assets/img/logo-man1.png') ?>" alt="Logo" class="w-14 h-auto mr-[-20]">
            <div class="text-center w-full">
                <h1 class="text-[13px] font-bold leading-tight">KEMENTERIAN AGAMA</h1>
                <h2 class="text-[12px] font-semibold">MAN 1 KOTA TASIKMALAYA</h2>
                <p class="text-[8px] leading-none">Jl. Letnan Harun No. 30, Kota Tasikmalaya, Jawa Barat 46115</p>
                <p class="text-[8px] leading-none">Telp: (0265) 331336 – Email: man1kotatasik@gmail.com</p>
            </div>
        </div>

        <!-- Judul -->
        <div class="text-center font-bold underline text-[12px]">SURAT IZIN KELUAR</div>

        <!-- Isi Surat -->
        <p class="mt-2">Yang bertanda tangan di bawah ini menerangkan bahwa:</p>
        <table class="mt-2 w-full text-[12px] leading-none">
            <tr >
                <td>Nama</td>
                <td>: <?= esc($izin['nama']) ?></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: <?= esc($izin['nisn']) ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: <?= esc($izin['kelas']) ?></td>
            </tr>
            <tr>
                <td>Alasan</td>
                <td>: <?= esc($izin['alasan']) ?></td>
            </tr>
            <tr>
                <td>Jam Keluar</td>
                <td>: <?= esc($izin['waktu_keluar']) ?></td>
            </tr>
            <tr>
                <td>Jam Kembali</td>
                <td>: <?= esc($izin['waktu_kembali']) ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= date('d M Y', strtotime($izin['created_at'])) ?></td>
            </tr>
        </table><br>

        <p class="mt-2">
            Diberikan izin keluar dari madrasah karena alasan tersebut di atas.<br>
            Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.
        </p>

        <!-- Tanda Tangan -->
        <div class="flex mt-8">
            <div class="text-right mt-4">
                <p class="mb-10 text-center">Petugas Piket</p>
                <strong>( ................................ )</strong>
            </div>
            <div class="text-left ml-auto">
                <p>Tasikmalaya, <?= date('d M Y', strtotime($izin['created_at'])) ?></p>
                <p class="mb-10 ">Bagian Kesiswaan</p>
                <strong>( ................................ )</strong>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="no-print text-center mt-6 flex justify-center space-x-3">
        <!-- Print -->
        <button onclick="window.print()"
            class="flex items-center bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 18v4h12v-4M6 14h.01M18 14h.01" />
            </svg>
            Cetak
        </button>

        <!-- Kembali -->
        <a href="<?= base_url('piket/konfirmasi_kembali') ?>"
            class="flex items-center bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <!-- Edit -->
        <a href="<?= base_url('piket/edit_izin/' . $izin['id']) ?>"
            class="flex items-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            Edit
        </a>
    </div>

</body>

</html>