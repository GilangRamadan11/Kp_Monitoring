<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataSandaranKananController extends BaseController
{
    public function SandaranKanan()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/Sandaran_Kanan/data_sandaran_kanan');
    }
    public function AddData()
    {
        // Menampilkan halaman form tambah Sandaran 
        return view('Data/Sandaran_Kiri/add_data');
    }


}
