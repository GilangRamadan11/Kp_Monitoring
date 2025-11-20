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
        return view('Data/A');
    }
data/Add_SandaranKiri
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

        // Loop dinamis untuk L-1..10 dan SPZ-1..2
        for ($i = 1; $i <= 10; $i++) {
            $data["srL_{$i}_feet"] = $this->request->getPost("srL_{$i}_feet");
            $data["srL_{$i}_inch"] = $this->request->getPost("srL_{$i}_inch");
        }

        for ($i = 1; $i <= 2; $i++) {
            $data["spz_{$i}_feet"] = $this->request->getPost("spz_{$i}_feet");
            $data["spz_{$i}_inch"] = $this->request->getPost("spz_{$i}_inch");
        }

        if ($model->insert($data)) {
            return redirect()->to(base_url('input-data-sandaran-kiri'))->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
}
