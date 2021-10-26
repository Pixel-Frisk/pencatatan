<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;

class Pencatatan extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('pages/dashboard', $data);
    }
    public function user()
    {
        $data = [
            'title' => 'User'
        ];
        // return view('pages/dashboard', $data);
    }
    public function barang()
    {
        $data = [
            'title' => 'Barang',
            'barang' => $this->barangModel->getBarang(),
            'kategori' => $this->kategoriModel->getKategori()
        ];
        // dd($data);
        return view('pages/barang', $data);
    }
    public function masuk()
    {
        $data = [
            'title' => 'Barang Masuk'
        ];
        // return view('pages/dashboard', $data);
    }
    public function keluar()
    {
        $data = [
            'title' => 'Peminjaman Barang'
        ];
        return view('pages/dashboard', $data);
    }
    public function saveBarang()
    {
        $slug = url_title($this->request->getVar('nama'), '-', true);
        if ($this->request->getVar('kategori') == "belum_ada") {
            $this->kategoriModel->save([
                'kategori' => $this->request->getVar('kategori2')
            ]);
            $idKat = null;
            $kat = $this->kategoriModel->getKategori();
            foreach ($kat as $row) {
                $idKat = $row['id_kat'];
            };
            $this->barangModel->save([
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'detail_barang' => $this->request->getVar('detail_barang'),
                'kategori' => $idKat,
                'quantity' => $this->request->getVar('quantity')
            ]);
            echo $idKat;
        } else {
            $this->barangModel->save([
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'detail_barang' => $this->request->getVar('detail_barang'),
                'kategori' => $this->request->getVar('kategori'),
                'quantity' => $this->request->getVar('quantity')
            ]);
        }
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/barang');
    }
    public function delete($id)
    {
        $this->barangModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/barang');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Ubah Data Barang',
            'barang' => $this->barangModel->getSpesBarang($slug),
        ];
        return view('pages/editBarang', $data);
    }
    public function update($id)
    {
        $this->barangModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $this->request->getVar('slug'),
            'detail_barang' => $this->request->getVar('detail_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'quantity' => $this->request->getVar('quantity')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/barang');
    }
}
