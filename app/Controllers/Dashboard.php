<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function piket()
    {
        return view('dashboard/piket');
    }

    public function bp()
    {
        return view('dashboard/bp');
    }
}
