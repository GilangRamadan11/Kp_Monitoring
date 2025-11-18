<?php

namespace App\Models;

use CodeIgniter\Model;

class SandaranKiriModel extends Model
{
    protected $table = 'sandaran_kiri';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tahun', 'periode', 'tanggal', 'dma_waduk', 'curah_hujan',

        // SR L 1–10
        'srL_1_feet','srL_1_inch','srL_2_feet','srL_2_inch','srL_3_feet','srL_3_inch',
        'srL_4_feet','srL_4_inch','srL_5_feet','srL_5_inch','srL_6_feet','srL_6_inch',
        'srL_7_feet','srL_7_inch','srL_8_feet','srL_8_inch','srL_9_feet','srL_9_inch',
        'srL_10_feet','srL_10_inch',

        // SPZ
        'spz_1_feet', 'spz_1_inch',
        'spz_2_feet', 'spz_2_inch',
    ];
}
