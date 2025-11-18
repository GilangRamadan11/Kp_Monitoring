<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSandaranKiriModel extends Model
{
    protected $table = 'data_sandaran_kiri';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'periode',
        'tanggal',
        'dma_waduk',
        'curah_hujan',
        'srL',
        'spz'
    ];
    protected $useTimestamps = true;
}
