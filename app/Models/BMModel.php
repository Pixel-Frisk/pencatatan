<?php

namespace App\Models;

use CodeIgniter\Model;

class BMModel extends Model
{
    protected $table = 'barangMasuk';
    protected $primaryKey = 'id_bm';
    protected $useTimestamps = true;
    protected $allowedFields = ['barang', 'quantityBM', 'namaUS'];

    public function getBM()
    {
        return $this->db->table('barangmasuk')
            ->join('barang', 'barangmasuk.barang = barang.id_bar')
            ->join('user', 'barangMasuk.namaUS = user.id_us')
            ->get()->getResultArray();
    }
    public function getSpesBM($id_bm)
    {
        if ($id_bm == false) {
            return $this->findAll();
        }
        return $this->where(['id_bm' => $id_bm])->first();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('barangMasuk');
    }
}
