<?php namespace App\Controllers;

class Error extends BaseController
{
    public function unauthorized()
    {
        return view('errors/unauthorized'); // buat view ini
    }
}
