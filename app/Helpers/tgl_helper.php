<?php
use Carbon\Carbon;

if (!function_exists('tglIndo')) {
    /**
     * Format tanggal ke bahasa Indonesia menggunakan Carbon
     */
    function tglIndo($datetime = null, $format = 'd F Y')
    {
        try {
            $datetime = $datetime ?: date('Y-m-d H:i:s'); // default sekarang
            return Carbon::parse($datetime)
                ->locale('id')
                ->translatedFormat($format);
        } catch (\Throwable $e) {
            // fallback manual
            $ts = strtotime($datetime) ?: time();
            $bulan = [
                1 => 'Januari','Februari','Maret','April','Mei','Juni',
                'Juli','Agustus','September','Oktober','November','Desember'
            ];
            return date('d', $ts) . ' ' . $bulan[(int)date('m', $ts)] . ' ' . date('Y', $ts);
        }
    }
}
