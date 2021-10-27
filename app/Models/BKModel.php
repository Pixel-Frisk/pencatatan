<?php

namespace App\Models;

use CodeIgniter\Model;

class BKModel extends Model
{
    protected $table = 'barangkeluar';
    protected $primaryKey = 'id_bk';
    protected $useTimestamps = true;
    protected $allowedFields = ['barang', 'namaUS', 'quantityBK'];

    public function getBK()
    {
        return $this->db->table('barangkeluar')
            ->join('barang', 'barangkeluar.barang = barang.id_bar')
            ->join('user', 'barangkeluar.namaUS = user.id_us')
            ->get()->getResultArray();
    }
    public function getSpesBK($id_bk)
    {
        if ($id_bk == false) {
            return $this->findAll();
        }
        return $this->where(['id_bk' => $id_bk])->first();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('barangkeluar');
    }
}
