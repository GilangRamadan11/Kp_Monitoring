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

    public function save()
    {
        // Ambil data dari form
        $data = [
            'curah_hujan' => $this->request->getPost('curah_hujan'),
            'debit_air'   => $this->request->getPost('debit_air'),
            'tinggi_muka_air' => $this->request->getPost('tinggi_muka_air'),
            'tanggal'     => $this->request->getPost('tanggal'),
        ];

        // Simpan ke database (contohnya nanti bisa disesuaikan)
        $db = \Config\Database::connect();
        $builder = $db->table('data_hidrologi');
        $builder->insert($data);

        return redirect()->to('/input-data-hidrologi')->with('success', 'Data berhasil disimpan!');
    }
}
