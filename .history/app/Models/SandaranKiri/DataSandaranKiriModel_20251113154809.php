<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSandaranKiriModel extends Model
{
    protected $table      = 'data_sandaran_kiri'; // ubah sesuai nama tabel
    protected $primaryKey = 'id';                 // ubah sesuai primary key tabel
    protected $allowedFields = [
        'tahun',
        'periode',
        // tambahkan kolom lain sesuai tabel kamu
    ];
}
