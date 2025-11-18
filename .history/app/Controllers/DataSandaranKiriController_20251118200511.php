<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SandaranKiriModel;

class DataSandaranKiriController extends BaseController
{
    public function AddData()
    {
        return view('Data/Sandaran_Kiri/add_sandaran_kiri');
    }

    public function store()
    {
        $model = new SandaranKiriModel();

        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'periode' => $this->request->getPost('periode'),
            'tanggal' => $this->request->getPost('tanggal'),

            'dma_feet' => $this->request->getPost('dma_feet'),
            'dma_inch' => $this->request->getPost('dma_inch'),

            'ch_bulanan' => $this->request->getPost('ch_bulanan'),

            'l01_feet' => $this->request->getPost('l01_feet'),
            'l01_inch' => $this->request->getPost('l01_inch'),
            'l02_feet' => $this->request->getPost('l02_feet'),
            'l02_inch' => $this->request->getPost('l02_inch'),
            'l03_feet' => $this->request->getPost('l03_feet'),
            'l03_inch' => $this->request->getPost('l03_inch'),
            'l04_feet' => $this->request->getPost('l04_feet'),
            'l04_inch' => $this->request->getPost('l04_inch'),
            'l05_feet' => $this->request->getPost('l05_feet'),
            'l05_inch' => $this->request->getPost('l05_inch'),
            'l06_feet' => $this->request->getPost('l06_feet'),
            'l06_inch' => $this->request->getPost('l06_inch'),
            'l07_feet' => $this->request->getPost('l07_feet'),
            'l07_inch' => $this->request->getPost('l07_inch'),
            'l08_feet' => $this->request->getPost('l08_feet'),
            'l08_inch' => $this->request->getPost('l08_inch'),
            'l09_feet' => $this->request->getPost('l09_feet'),
            'l09_inch' => $this->request->getPost('l09_inch'),
            'l10_feet' => $this->request->getPost('l10_feet'),
            'l10_inch' => $this->request->getPost('l10_inch'),

            'spz02_feet' => $this->request->getPost('spz02_feet'),
            'spz02_inch' => $this->request->getPost('spz02_inch'),
        ];

        $model->save($data);

        return redirect()->back()->with('success', 'Data Sandaran Kiri berhasil disimpan!');
    }

    public function index()
    {
        $model = new SandaranKiriModel();
        $data['sandaran'] = $model->findAll();

        return view('Data/Sandaran_Kiri/list_sandaran_kiri', $data);
    }
}
