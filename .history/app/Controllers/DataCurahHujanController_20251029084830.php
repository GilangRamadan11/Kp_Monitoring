<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataCurahHujanController extends BaseController
{
    public function CurahHujan()
    {
        // Menampilkan halaman form input hidrologi
        return view('Data/Curah_Hujan/data_curah_hujan');
    }

    public function addData()
    {
        // Menampilkan halaman form tambah data curah hujan
        return view('Data/Curah_Hujan/add_data');
    }
    public function create()
{
    $modelPengukuran = new MDataPengukuran();
    
    $data = [
        'periode_options' => $modelPengukuran->distinct()->select('periode')->orderBy('periode', 'ASC')->findAll()
    ];
    
    return view('Data/add_data', $data);
}


}
