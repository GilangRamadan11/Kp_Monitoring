<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSandaranKiriModel extends Model
{
    protected $table            = 'sandaran_kiri';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'tahun',
        'periode',
        'tanggal',
        'dma',
        'ch_bulanan',

        // L01 - L10 (feet & inch)
        'l01_feet', 'l01_inch',
        'l02_feet', 'l02_inch',
        'l03_feet', 'l03_inch',
        'l04_feet', 'l04_inch',
        'l05_feet', 'l05_inch',
        'l06_feet', 'l06_inch',
        'l07_feet', 'l07_inch',
        'l08_feet', 'l08_inch',
        'l09_feet', 'l09_inch',
        'l10_feet', 'l10_inch',

        // SPZ only SPZ-02 (sesuai form)
        'spz02_feet',
        'spz02_inch',

    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
}
