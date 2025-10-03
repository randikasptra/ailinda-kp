<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Ringan (5 poin)
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Terlambat datang ke madrasah.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Memarkir kendaraan tidak pada tempatnya.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Berkuku panjang.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Menggulung lengan baju.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Menggunakan pakaian atau atribut di luar ketentuan yang ditetapkan selama berada di lingkungan madrasah.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Menggunakan perhiasan berlebihan.', 'poin' => 5],
            ['kategori' => 'Ringan', 'jenis_pelanggaran' => 'Menggunakan asesoris.', 'poin' => 5],

            // Sedang (10–15 poin)
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Menggunakan kendaraan yang tidak sesuai dengan peraturan berlalulintas.', 'poin' => 10],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Meninggalkan atau menyimpan barang-barang milik pribadi di madrasah.', 'poin' => 10],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Meninggalkan kelas tanpa seizin guru saat pembelajaran.', 'poin' => 10],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Izin lebih dari tiga hari tanpa surat yang diperbaharui.', 'poin' => 10],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Membuang sampah/meludah sembarangan.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Masuk atau keluar madrasah dari tempat yang tidak ditentukan.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Berkata kasar dan seronok.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Tidak masuk sekolah tanpa keterangan.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Meninggalkan madrasah tanpa seizin guru piket sebelum KBM berakhir.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Meninggalkan sholat berjamaah dzuhur sebanyak tiga kali dalam seminggu.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Tidak menyimpan handphone atau tablet di lemari penyimpanan tanpa seizin guru.', 'poin' => 15],
            ['kategori' => 'Sedang', 'jenis_pelanggaran' => 'Menggunakan pewarna bibir, penebal alis, maskara, eyeshadow, lensa mata, cat kuku, dan hena.', 'poin' => 15],

            // Berat (25–50 poin)
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Rambut diwarnai/gondrong/model tidak normatif.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Mengubah bentuk alis.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Mengotori dan merusak lingkungan madrasah.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Membuat surat keterangan izin/sakit tanpa sepengetahuan pihak yang memiliki kewenangan.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Berkumpul dengan lawan jenis yang dapat menimbulkan fitnah.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Merokok selama masih mengenakan seragam madrasah baik di madrasah maupun di luar madrasah.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Tidak menyimpan handphone/tablet ke locker madrasah.', 'poin' => 25],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Menghina, mengejek, merendahkan, dan melukai warga madrasah.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Merusak fasilitas madrasah.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Berpacaran.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Memiliki foto atau video yang tidak sesuai dengan norma agama dan sosial.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Mempublikasikan dokumen di media sosial yang tidak sesuai dengan norma agama dan sosial.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Memiliki akun atau aplikasi media sosial yang dipergunakan untuk hal-hal yang melanggar norma agama dan sosial.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Memberikan informasi, keterangan dan kesaksian palsu.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Memprovokasi dan atau menghasut tindakan kekerasan.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Membawa senjata tajam atau sejenisnya.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Membentuk organisasi/komunitas/perkumpulan tanpa seizin pihak madrasah.', 'poin' => 50],
            ['kategori' => 'Berat', 'jenis_pelanggaran' => 'Membuat dan atau menggunakan logo tanpa seizin pihak madrasah.', 'poin' => 50],

            // Sangat Berat (≥75 poin)
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Menjelek-jelekan madrasah baik secara lisan maupun tulisan.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Mengambil barang-barang milik madrasah.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Mengambil barang-barang milik orang lain atau lembaga lain.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Berkelahi sesama warga madrasah maupun dengan warga lain.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Membawa media yang bermuatan pornografi.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Menjadi anggota geng/organisasi/komunitas terlarang.', 'poin' => 75],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Berjudi atau hal-hal yang bisa diindikasikan perjudian.', 'poin' => 80],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Melakukan pemerasan atau tindakan premanisme.', 'poin' => 80],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Memalsukan dokumen administrasi madrasah.', 'poin' => 80],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Melakukan perundungan, pelecehan seksual, atau pornoaksi.', 'poin' => 90],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Bertato.', 'poin' => 100],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Membawa/mengkonsumsi/mengedarkan narkoba atau minuman keras.', 'poin' => 100],
            ['kategori' => 'Sangat Berat', 'jenis_pelanggaran' => 'Menikah dan atau hamil/menghamili.', 'poin' => 100],
        ];

        $this->db->table('pelanggaran')->insertBatch($data);
    }
}
