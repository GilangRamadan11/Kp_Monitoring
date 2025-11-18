<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataSandaranKiriModel;

class DataSandaranKiriController extends BaseController
{
    // =======================
    // HALAMAN DAFTAR DATA
    // =======================
    public function index()
    {
        $model = new DataSandaranKiriModel();

        // Ambil semua data untuk ditampilkan
        $data['records'] = $model->orderBy('id', 'DESC')->findAll();

        return view('Data/Sandaran_Kiri/data_sandaran_kiri', $data);
    }

    // =======================
    // HALAMAN ADD FORM
    // =======================
    public function AddData()
    {
        return view('Data/Sandaran_Kiri/add_data');
    }

    // =======================
    // PROSES SIMPAN DATA
    // =======================
    public function store()
    {
        $model = new DataSandaranKiriModel();

        $data = [
            'tahun'        => $this->request->getPost('tahun'),
            'periode'      => $this->request->getPost('periode'),
            'tanggal'      => $this->request->getPost('tanggal'),
            'dma_waduk'    => $this->request->getPost('dma_waduk'),
            'curah_hujan'  => $this->request->getPost('curah_hujan'),
        ];

        // SR L-1 sampai L-10
        for ($i = 1; $i <= 10; $i++) {
            $data["srL_{$i}_feet"] = $this->request->getPost("srL_{$i}_feet");
            $data["srL_{$i}_inch"] = $this->request->getPost("srL_{$i}_inch");
        }

        // SPZ 1–2
        for ($i = 1; $i <= 2; $i++) {
            $data["spz_{$i}_feet"] = $this->request->getPost("spz_{$i}_feet");
            $data["spz_{$i}_inch"] = $this->request->getPost("spz_{$i}_inch");
        }

        if ($model->insert($data)) {
            return redirect()->to(base_url('input-data-sandaran-kiri'))
                             ->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
}
