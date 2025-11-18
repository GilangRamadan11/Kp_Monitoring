<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataSandaranKananController extends BaseController
{
    public function CurahHujan()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/');
    }


}
