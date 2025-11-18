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

        // VALIDASI
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tahun'     => 'required|numeric',
            'periode'   => 'required',
            'tanggal'   => 'required',

            'dma_feet'  => 'permit_empty|numeric',
            'dma_inch'  => 'permit_empty|numeric',
            'ch_bulanan'=> 'permit_empty|numeric',

            // L01 - L10
            'l01_feet' => 'permit_empty|numeric',
            'l01_inch' => 'permit_empty|numeric',
            'l02_feet' => 'permit_empty|numeric',
            'l02_inch' => 'permit_empty|numeric',
            'l03_feet' => 'permit_empty|numeric',
            'l03_inch' => 'permit_empty|numeric',
            'l04_feet' => 'permit_empty|numeric',
            'l04_inch' => 'permit_empty|numeric',
            'l05_feet' => 'permit_empty|numeric',
            'l05_inch' => 'permit_empty|numeric',
            'l06_feet' => 'permit_empty|numeric',
            'l06_inch' => 'permit_empty|numeric',
            'l07_feet' => 'permit_empty|numeric',
            'l07_inch' => 'permit_empty|numeric',
            'l08_feet' => 'permit_empty|numeric',
            'l08_inch' => 'permit_empty|numeric',
            'l09_feet' => 'permit_empty|numeric',
            'l09_inch' => 'permit_empty|numeric',
            'l10_feet' => 'permit_empty|numeric',
            'l10_inch' => 'permit_empty|numeric',

            'spz02_feet' => 'permit_empty|numeric',
            'spz02_inch' => 'permit_empty|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', $validation->getErrors());
        }

        // CEK DUPLIKASI (tahun + periode + tanggal tidak boleh sama)
        $cek = $model->where('tahun', $this->request->getPost('tahun'))
                     ->where('periode', $this->request->getPost('periode'))
                     ->where('tanggal', $this->request->getPost('tanggal'))
                     ->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Data untuk tahun, periode, dan tanggal tersebut sudah ada!');
        }

        // INPUT DATA
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'periode' => $this->request->getPost('periode'),
            'tanggal' => $this->request->getPost('tanggal'),

            'dma_feet'  => $this->request->getPost('dma_feet'),
            'dma_inch'  => $this->request->getPost('dma_inch'),
            'ch_bulanan'=> $this->request->getPost('ch_bulanan'),

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

        return redirect()->to('/data-sandaran-kiri')->with('success', 'Data Sandaran Kiri berhasil disimpan!');
    }

    public function index()
    {
        $model = new SandaranKiriModel();
        $data['sandaran'] = $model->orderBy('id', 'DESC')->findAll();

        return view('Data/Sandaran_Kiri/list_sandaran_kiri', $data);
    }

}
