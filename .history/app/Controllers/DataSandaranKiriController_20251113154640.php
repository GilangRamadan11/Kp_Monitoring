<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataSandaranKiriModel;

class DataSandaranKiriController extends BaseController
{
    public function SandaranKiri()
    {
        // Menampilkan halaman utama data sandaran kiri
        return view('Data/Sandaran_Kiri/data_sandaran_kiri');
    }

    public function AddData()
    {
        // Menampilkan halaman form tambah data sandaran kiri
        return view('Data/Sandaran_Kiri/add_data');
    }

    public function store()
    {
        // Inisialisasi respons default
        $response = [
            'success' => false,
            'message' => '',
            'errors'  => []
        ];

        // Validasi input dari form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tahun'   => 'required|numeric|greater_than_equal_to[2000]|less_than_equal_to[2100]',
            'periode' => 'required',
            // tambahkan field lain sesuai kebutuhan, contoh:
            // 'debit_air' => 'required|decimal',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            $response['message'] = 'Validasi gagal';
            $response['errors']  = $validation->getErrors();
            return $this->response->setJSON($response);
        }

        // Ambil data dari form
        $data = [
            'tahun'   => $this->request->getPost('tahun'),
            'periode' => $this->request->getPost('periode'),
            // tambahkan kolom lain sesuai tabel
        ];

        // Simpan ke database
        $model = new DataSandaranKiriModel();
        if ($model->insert($data)) {
            $response['success'] = true;
            $response['message'] = 'Data berhasil disimpan';
        } else {
            $response['message'] = 'Gagal menyimpan data';
        }

        return $this->response->setJSON($response);
    }
}
