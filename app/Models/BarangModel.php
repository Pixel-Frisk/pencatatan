<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_bar';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'detail_barang', 'kategori', 'quantity'];

    public function getBarang()
    {
        return $this->db->table('barang')
            ->join('kategori', 'barang.kategori = kategori.id_kat')
            ->get()->getResultArray();
    }
    public function getSpesBarang($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
