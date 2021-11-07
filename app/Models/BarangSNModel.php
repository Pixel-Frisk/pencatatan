<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangSNModel extends Model
{
    protected $table = 'barangsn';
    protected $primaryKey = 'id_sn';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_bars', 'sn', 'id_bar_spes'];

    public function getBarangSN()
    {
        return $this->db->table('barangsn')
            ->join('barang', 'barangsn.id_bars = barang.id_bar')
            ->join('kategori', 'barang.kategori = kategori.id_kat')
            ->get()->getResultArray();
    }
    public function getBarangSN2()
    {
        return $this->findAll();
    }
    public function getSpesBarangSN($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_bar' => $id])->findAll();
    }
    public function getSpesBarangSN2($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_bars' => $id])->findAll();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('barangsn');
    }
}
