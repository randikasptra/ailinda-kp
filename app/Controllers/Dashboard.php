<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function piket()
    {
        return view('pages/piket/piket', ['title' => 'Dashboard Piket']); // ✅ SESUAI folder
    }

    public function bp()
    {
        return view('pages/bp/bp', ['title' => 'Dashboard BP']); // ✅ Ubah path view-nya biar sesuai
    }
    public function admin()
    {
        return view('pages/admin/dashboard', ['title' => 'Dashboard Admin']); // ✅ Ubah path view-nya biar sesuai
    }
}
