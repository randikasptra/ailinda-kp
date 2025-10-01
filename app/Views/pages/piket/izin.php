<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Surat Izin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <h1 class="text-2xl font-bold text-center mb-8">📑 Data Surat Izin Siswa</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Surat Izin Keluar -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-3 text-blue-600">Surat Izin Keluar</h2>
            <table class="min-w-full border text-sm">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-3 py-2 border">NISN</th>
                        <th class="px-3 py-2 border">Nama</th>
                        <th class="px-3 py-2 border">Kelas</th>
                        <th class="px-3 py-2 border">Alasan</th>
                        <th class="px-3 py-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($izinKeluar)) : ?>
                        <?php foreach ($izinKeluar as $izin) : ?>
                            <tr class="border hover:bg-gray-100">
                                <td class="px-3 py-2 border"><?= esc($izin['nisn']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['nama']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['kelas']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['alasan']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['created_at']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <!-- Surat Izin Masuk -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-3 text-green-600">Surat Izin Masuk</h2>
            <table class="min-w-full border text-sm">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-3 py-2 border">NISN</th>
                        <th class="px-3 py-2 border">Nama</th>
                        <th class="px-3 py-2 border">Kelas</th>
                        <th class="px-3 py-2 border">Alasan</th>
                        <th class="px-3 py-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($izinMasuk)) : ?>
                        <?php foreach ($izinMasuk as $izin) : ?>
                            <tr class="border hover:bg-gray-100">
                                <td class="px-3 py-2 border"><?= esc($izin['nisn']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['nama']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['kelas']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['alasan']) ?></td>
                                <td class="px-3 py-2 border"><?= esc($izin['created_at']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
