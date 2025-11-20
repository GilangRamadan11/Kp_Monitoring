<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataSandaranKiriModel;

class DataSandaranKiriController extends BaseController
{
    public function SandaranKiri()
    {
        return view('Data/Sandaran_Kiri/data_sandaran_kiri');
    }

    public function AddData()
    {
        return view('Data/Sandaran_Kiri/add_data');
    }

    
}
