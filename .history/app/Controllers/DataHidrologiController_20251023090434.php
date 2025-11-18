<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataHidrologiController extends BaseController
{
    public function ()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/curah_hujan/data_curah_hujan');
    }


}
