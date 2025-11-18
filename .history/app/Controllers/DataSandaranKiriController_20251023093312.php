<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataSandaranKiriController extends BaseController
{
    public function SandaranKiri()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/Sandaran_Kiri/data_sandaran_kiri');
    }


}
