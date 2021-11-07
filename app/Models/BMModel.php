<?php

namespace App\Models;

use CodeIgniter\Model;

class BMModel extends Model
{
    protected $table = 'barangMasuk';
    protected $primaryKey = 'id_bm';
    protected $useTimestamps = true;
    protected $allowedFields = ['barang', 'quantityBM', 'namaUS', 'status', 'tglKel', 'tglMas'];

    public function getBM()
    {
        return $this->db->table('barangmasuk')
            ->join('barang', 'barangmasuk.barang = barang.id_bar')
            ->get()->getResultArray();
    }
    public function getBM2()
    {
        return $this->findAll();
    }
    public function getSpesBM($id_bm)
    {
        if ($id_bm == false) {
            return $this->findAll();
        }
        return $this->where(['id_bm' => $id_bm])->first();
    }
    public function getSpesMonth($month)
    {
        return $this->where(['MONTH(tglKel)' => $month]);
    }
    public function get_last_month($month)
    {
        // Your Query
        return $this->db->table('barangMasuk')
            ->join('barang', 'barangmasuk.barang = barang.id_bar')
            ->where('MONTH(tglMas)', $month)
            ->get()->getResultArray();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('barangMasuk');
    }

    public function getPakai()
    {
        return $this->db->table('barangmasuk')
            ->join('barang', 'barangmasuk.barang = barang.id_bar')
            ->where(['barang.jenis' => 2])
            ->where(['barangmasuk.status' => 0])
            ->get()->getResultArray();
    }
}
