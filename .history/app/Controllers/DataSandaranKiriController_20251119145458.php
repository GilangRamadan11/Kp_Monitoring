<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SandaranKiri\DataSandaranKiriModel;

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

    public function store()
    {
        $model = new DataSandaranKiriModel();

        $data = [
            'tahun'        => $this->request->getPost('tahun'),
            'periode'      => $this->request->getPost('periode'),
            'tanggal'      => $this->request->getPost('tanggal'),
            'dma'    => $this->request->getPost('dma'),
            'ch_bulanan'  => $this->request->getPost('ch_bulanan'),
        ];

        // Loop L1–L10
        for ($i = 1; $i <= 10; $i++) {
            $num = str_pad($i, 2, '0', STR_PAD_LEFT);
            $data["l{$num}_feet"] = $this->request->getPost("l{$num}_feet");
            $data["l{$num}_inch"] = $this->request->getPost("l{$num}_inch");
        }

        // Loop SPZ-1..2
        $data["spz02_feet"] = $this->request->getPost("spz02_feet");
        $data["spz02_inch"] = $this->request->getPost("spz02_inch");


        if ($model->insert($data)) {
            return redirect()
                ->to(base_url('input-data-sandaran-kiri'))
                ->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
}
