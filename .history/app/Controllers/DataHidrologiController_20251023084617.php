<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataInputHidrologiController extends BaseController
{
    public function index()
    {
        // Menampilkan halaman form input hidrologi
        return view('hidrologi/input_data');
    }


}
