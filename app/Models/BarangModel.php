<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_bar';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'jenis', 'detail_barang', 'kategori', 'quantity'];

    public function getBarang()
    {
        return $this->db->table('barang')
            ->join('kategori', 'barang.kategori = kategori.id_kat')
            ->get()->getResultArray();
    }
    public function getBarang2()
    {
        return $this->findAll();
    }
    public function getSpesBarang($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_bar' => $id])->first();
    }
    public function getSpesBarang2($id)
    {
        return $this->db->table('barang')
            ->join('barangsn', 'barangsn.id_bars = barang.id_bar')
            ->where(['id_bar' => $id])
            ->get()->getResultArray();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('barang');
    }
}
