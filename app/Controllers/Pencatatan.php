<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Models\BMModel;
use App\Models\BKModel;

class Pencatatan extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $userModel;
    protected $bmModel;
    protected $bkModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->userModel = new UserModel();
        $this->bmModel = new BMModel();
        $this->bkModel = new BKModel();
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
            'title' => 'User',
            'user' => $this->userModel->getUser()
        ];
        return view('pages/user', $data);
    }
    public function saveUser()
    {
        $this->userModel->save([
            'role' => 'user',
            'namaUSR' => $this->request->getVar('nama'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/user');
    }
    public function editUser($id_us)
    {
        $data = [
            'title' => 'Ubah Data User',
            'users' => $this->userModel->getSpesUser($id_us)
        ];
        // dd($data);
        return view('pages/editUser', $data);
    }
    public function updateUser($id_us)
    {
        $data = [
            'namaUSR' => $this->request->getVar('nama'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email'),
        ];
        $buil = $this->userModel->build()->where('id_us', $id_us);
        $buil->update($data);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        return redirect()->to('/user');
    }
    public function deleteUser($id_us)
    {
        $this->userModel->delete($id_us);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/user');
    }

    //BARANG
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
    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Barang',
            'barang' => $this->barangModel->getSpesBarang($id),
            'kategori' => $this->kategoriModel->getKategori()
        ];
        return view('pages/editBarang', $data);
    }
    public function update($id)
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'slug' => $this->request->getVar('slug'),
            'detail_barang' => $this->request->getVar('detail_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'quantity' => $this->request->getVar('quantity')
        ];
        $buil = $this->barangModel->build()->where('id_bar', $id);
        $buil->update($data);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        return redirect()->to('/barang');
    }

    //BARANG MASUK
    public function masuk()
    {
        $data = [
            'title' => 'Pengembalian Barang',
            'barangMasuk' => $this->bmModel->getBM(),
            'barang' => $this->barangModel->getBarang2(),
            'user' => $this->userModel->getUser()
        ];
        // dd($data);
        return view('pages/barangMasuk', $data);
    }
    public function saveBM()
    {
        $this->bmModel->save([
            'barang' => $this->request->getVar('barang'),
            'quantityBM' => $this->request->getVar('quantity'),
            'namaUS' => $this->request->getVar('namaUS')
        ]);
        $quan = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyak = $quan['quantity'];
        $data = [
            'quantity' => $this->request->getVar('quantity') + $banyak
        ];
        $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
        $buil->update($data);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/masuk');
    }
    public function deleteBM($id_bm)
    {
        $quan = $this->bmModel->getSpesBM($id_bm);
        $banyak = $quan['quantityBM'];
        $id = $quan['barang'];
        // dd($banyak, $id);
        $quan2 = $this->barangModel->getSpesBarang($id);
        $banyak2 = $quan2['quantity'];
        $data = [
            'quantity' => $banyak2 - $banyak
        ];
        $buil = $this->barangModel->build()->where('id_bar', $id);
        $buil->update($data);

        $this->bmModel->delete($id_bm);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/masuk');
    }
    public function editBM($id_bm)
    {
        $data = [
            'title' => 'Ubah Data Pengembalian',
            'barangMasuk' => $this->bmModel->getSpesBM($id_bm),
            'barang' => $this->barangModel->getBarang2(),
            'user' => $this->userModel->getUser()
        ];
        return view('pages/editBM', $data);
    }
    public function updateBM($id_bm)
    {
        $quan = $this->bmModel->getSpesBM($id_bm);
        $banyak = $quan['quantityBM'];
        $idBar = $quan['barang'];
        $quanBar = $this->barangModel->getSpesBarang($idBar);
        $banyakBar = $quanBar['quantity'];
        $quanBar2 = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyakBar2 = $quanBar2['quantity'];
        if ($idBar == $this->request->getVar('barang')) { //ID SAMA
            if ($banyak == $this->request->getVar('quantity')) {
                // echo 'Sama';
            } elseif ($this->request->getVar('quantity') > $banyak) {
                // echo 'Lebih Besar';
                $dataBar = [
                    'quantity' => $banyakBar + ($this->request->getVar('quantity') - $banyak)
                ];
                // dd($dataBar);
                $buil = $this->barangModel->build()->where('id_bar', $idBar);
                $buil->update($dataBar);
            } elseif ($this->request->getVar('quantity') < $banyak) {
                // echo 'Lebih Sedikit';
                $dataBar = [
                    'quantity' => $banyakBar - ($banyak - $this->request->getVar('quantity'))
                ];
                // dd($dataBar);
                $buil = $this->barangModel->build()->where('id_bar', $idBar);
                $buil->update($dataBar);
            }
            $dataBM = [
                'quantityBM' => $this->request->getVar('quantity'),
                'namaUS' => $this->request->getVar('namaUS')
            ];
            $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
            $buil2->update($dataBM);
        } else { //ID BEDA
            $dataBar1 = [
                'quantity' => $banyakBar - $this->request->getVar('quantity')
            ];
            $dataBar2 = [
                'quantity' => $banyakBar2 + $this->request->getVar('quantity')
            ];
            $dataBM = [
                'barang' => $this->request->getVar('barang'),
                'quantityBM' => $this->request->getVar('quantity'),
                'namaUS' => $this->request->getVar('namaUS')
            ];
            $buil = $this->barangModel->build()->where('id_bar', $idBar);
            $buil->update($dataBar1);
            $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
            $buil->update($dataBar2);
            $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
            $buil2->update($dataBM);
        }
        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        return redirect()->to('/masuk');
    }

    //BARANG KELUAR
    public function keluar()
    {
        $data = [
            'title' => 'Pengembalian barang',
            'barangKeluar' => $this->bkModel->getBK(),
            'barang' => $this->barangModel->getBarang2(),
            'user' => $this->userModel->getUser()
        ];
        // dd($data);
        return view('pages/barangKeluar', $data);
    }
    public function saveBK()
    {
        $quan = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyak = $quan['quantity'] - $this->request->getVar('quantity');
        if ($banyak > 0) {
            $data = [
                'quantity' => $banyak
            ];
            $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
            $buil->update($data);
            $this->bkModel->save([
                'barang' => $this->request->getVar('barang'),
                'namaUS' => $this->request->getVar('namaUS'),
                'quantityBK' => $this->request->getVar('quantity')
            ]);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        } else {
            session()->setFlashdata('gagal', 'Barang Tidak cukup.');
        }
        return redirect()->to('/keluar');
    }
    public function deleteBK($id_bk)
    {
        $quan = $this->bkModel->getSpesBK($id_bk);
        $banyak = $quan['quantityBK'];
        $id = $quan['barang'];
        // dd($banyak, $id);
        $quan2 = $this->barangModel->getSpesBarang($id);
        $banyak2 = $quan2['quantity'];
        $data = [
            'quantity' => $banyak2 + $banyak
        ];
        $buil = $this->barangModel->build()->where('id_bar', $id);
        $buil->update($data);

        $this->bkModel->delete($id_bk);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/keluar');
    }
    public function editBK($id_bk)
    {
        $data = [
            'title' => 'Ubah Data Pengembalian Barang',
            'barangKeluar' => $this->bkModel->getSpesBK($id_bk),
            'barang' => $this->barangModel->getBarang2(),
            'user' => $this->userModel->getUser()
        ];
        return view('pages/editBK', $data);
    }
    public function updateBK($id_bk)
    {
        $quan = $this->bkModel->getSpesBK($id_bk);
        $banyak = $quan['quantityBK'];
        $idBar = $quan['barang'];
        $idUs = $quan['namaUS'];
        $quanBar = $this->barangModel->getSpesBarang($idBar);
        $banyakBar = $quanBar['quantity'];
        $quanBar2 = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyakBar2 = $quanBar2['quantity'];
        $idUS2 = $this->request->getVar('namaUS');
        if ($idBar == $this->request->getVar('barang')) { //ID SAMA
            if ($banyakBar - ($this->request->getVar('quantity') - $banyak) > 0) {
                if ($banyak == $this->request->getVar('quantity') and $idUs == $this->request->getVar('namaUS')) {
                    // echo 'Sama';
                } elseif ($this->request->getVar('quantity') > $banyak) {
                    // echo 'Lebih Besar';
                    $dataBar = [
                        'quantity' => $banyakBar - ($this->request->getVar('quantity') - $banyak)
                    ];
                    // dd($dataBar);
                    $buil = $this->barangModel->build()->where('id_bar', $idBar);
                    $buil->update($dataBar);
                } elseif ($this->request->getVar('quantity') < $banyak) {
                    // echo 'Lebih Sedikit';
                    $dataBar = [
                        'quantity' => $banyakBar + ($banyak - $this->request->getVar('quantity'))
                    ];
                    // dd($dataBar);
                    $buil = $this->barangModel->build()->where('id_bar', $idBar);
                    $buil->update($dataBar);
                }
                $dataBK = [
                    'namaUS' => $this->request->getVar('namaUS'),
                    'quantityBK' => $this->request->getVar('quantity')
                ];
                $buil2 = $this->bkModel->build()->where('id_bk', $id_bk);
                $buil2->update($dataBK);
                session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
            } else {
                session()->setFlashdata('gagal', 'Barang Tidak cukup.');
            }
        } else { //ID BEDA
            if ($banyakBar2 - ($this->request->getVar('quantity') - $banyak) > 0) {
                $dataBar1 = [
                    'quantity' => $banyakBar + $this->request->getVar('quantity')
                ];
                $dataBar2 = [
                    'quantity' => $banyakBar2 - $this->request->getVar('quantity')
                ];
                $dataBK = [
                    'barang' => $this->request->getVar('barang'),
                    'namaUS' => $this->request->getVar('namaUS'),
                    'quantityBK' => $this->request->getVar('quantity')
                ];
                $buil = $this->barangModel->build()->where('id_bar', $idBar);
                $buil->update($dataBar1);
                $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
                $buil->update($dataBar2);
                $buil2 = $this->bkModel->build()->where('id_bk', $id_bk);
                $buil2->update($dataBK);
                session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
            } else {
                session()->setFlashdata('gagal', 'Barang Tidak cukup.');
            }
        }
        return redirect()->to('/keluar');
    }
}
