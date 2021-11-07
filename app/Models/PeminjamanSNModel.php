<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanSNModel extends Model
{
    protected $table = 'peminjamansn';
    protected $primaryKey = 'id_pemiSN';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pemiBar', 'id_snBar'];

    public function getPemiSN()
    {
        return $this->db->table('barangsn')
            ->join('barang', 'barangsn.id_bars = barang.id_bar')
            ->join('kategori', 'barang.kategori = kategori.id_kat')
            ->get()->getResultArray();
    }
    public function getPemiSN2()
    {
        return $this->findAll();
    }
    public function getSpesPemiSN($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_bar' => $id])->findAll();
    }
    public function getSpesPemiSN2($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_bars' => $id])->findAll();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('peminjamansn');
    }
}
