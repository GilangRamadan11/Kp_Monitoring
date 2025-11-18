<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataCurahHujanController extends BaseController
{
    public function CurahHujan()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/Curah_hujan/data_curah_hujan');
    }


}
