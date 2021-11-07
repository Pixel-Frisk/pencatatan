<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BarangSNModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Models\BMModel;
use App\Models\BKModel;
use App\Models\PeminjamanSNModel;

class Pencatatan extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $userModel;
    protected $bmModel;
    protected $bkModel;
    protected $barangSNModel;
    protected $peminjamansnModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangSNModel = new BarangSNModel();
        $this->kategoriModel = new KategoriModel();
        $this->userModel = new UserModel();
        $this->bmModel = new BMModel();
        $this->bkModel = new BKModel();
        $this->peminjamansnModel = new PeminjamanSNModel();
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
        $detail = $this->request->getVar('detail_barang');
        if ($this->request->getVar('nama') == null || $this->request->getVar('kategori') == null || $this->request->getVar('jenis') == null || $this->request->getVar('quantity') == null || $this->request->getVar('quantity') == 0) {
            session()->setFlashdata('gagal', 'Data Tidak Boleh Kosong.');
        } else {
            if ($this->request->getVar('jenis') == "tetap") {
                if ($this->request->getVar('detail_barang') == null) {
                    session()->setFlashdata('gagal', 'Data Tidak Boleh Kosong.');
                } else {
                    if ($this->request->getVar('kategori') == "belum_ada") {
                        $this->kategoriModel->save([
                            'kategori' => $this->request->getVar('kategori2')
                        ]);
                        $idKat = null;
                        $kat = $this->kategoriModel->getKategori();
                        foreach ($kat as $row) {
                            $idKat = $row['id_kat'];
                        };
                    } else {
                        $idKat = $this->request->getVar('kategori');
                    }
                    $data = [
                        'title' => 'Tambah Barang',
                        'kategori2' => $this->kategoriModel->getKategori(),
                        'nama' => $this->request->getVar('nama'),
                        'detail_barang' => $detail,
                        'kategori' => $idKat,
                        'quantity' => $this->request->getVar('quantity'),
                        'jenis' => $this->request->getVar('jenis')
                    ];
                    return view('pages/barangTetap', $data);
                }
            } elseif ($this->request->getVar('jenis') == "habis") {
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
                        'detail_barang' => $detail,
                        'kategori' => $idKat,
                        'quantity' => $this->request->getVar('quantity'),
                        'jenis' => 2
                    ]);
                } else {
                    $this->barangModel->save([
                        'nama' => $this->request->getVar('nama'),
                        'detail_barang' => $detail,
                        'kategori' => $this->request->getVar('kategori'),
                        'quantity' => $this->request->getVar('quantity'),
                        'jenis' => 2
                    ]);
                }
                session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
            }
        }
        return redirect()->to('/barang');
    }
    public function saveTetap()
    {
        $da = array();
        for ($x = 1; $x <= $this->request->getVar('quantity'); $x++) {
            $data2 = [
                'sn' => $this->request->getVar('serial' . $x)
            ];
            array_push($da, $data2['sn']);
        }
        if ($this->request->getVar('quantity') == count(array_unique($da))) {
            $this->barangModel->save([
                'nama' => $this->request->getVar('nama'),
                'detail_barang' => $this->request->getVar('detail_barang'),
                'kategori' => $this->request->getVar('kategori'),
                'quantity' => $this->request->getVar('quantity'),
                'jenis' => 1
            ]);
            $idBarNew = null;
            $bar = $this->barangModel->getBarang2();
            foreach ($bar as $row) {
                $idBarNew = $row['id_bar'];
            };
            for ($x = 1; $x <= $this->request->getVar('quantity'); $x++) {
                $this->barangSNModel->save([
                    'id_bars' => $idBarNew,
                    'sn' => $this->request->getVar('serial' . $x),
                    'id_bar_spes' => ($idBarNew * 100) + $x
                ]);
            }
            session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
        } else {
            session()->setFlashdata('gagal', 'Serial Number Kosong atau Sama');
        }
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
        if ($this->request->getVar('nama') == null || $this->request->getVar('kategori') == null || $this->request->getVar('quantity') == null || $this->request->getVar('quantity') == 0) {
            session()->setFlashdata('gagal', 'Data Tidak Boleh Kosong.');
        } elseif ($this->request->getVar('jenis') == 1 && $this->request->getVar('detail_barang') == null) {
            session()->setFlashdata('gagal', 'Data Tidak Boleh Kosong.');
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'detail_barang' => $this->request->getVar('detail_barang'),
                'kategori' => $this->request->getVar('kategori'),
                'quantity' => $this->request->getVar('quantity')
            ];
            $buil = $this->barangModel->build()->where('id_bar', $id);
            $buil->update($data);

            session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        }
        return redirect()->to('/barang');
    }
    public function lihatBar($id)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => $this->barangModel->getSpesBarang($id),
            'kategori' => $this->kategoriModel->getKategori(),
            'barangSN' => $this->barangSNModel->getBarangSN2()
        ];
        return view('pages/detailBarang', $data);
    }


    //Peminjaman
    public function masuk()
    {
        $data = [
            'title' => 'Peminjaman Barang',
            'barangMasuk' => $this->bmModel->getBM(),
            'barang' => $this->barangModel->getBarang2(),
            'user' => $this->userModel->getUser()
        ];
        // dd($data);
        return view('pages/barangMasuk', $data);
    }
    public function saveBM()
    {
        $st = 0;
        $nu = null;
        $da = date("Y-m-d h:i:s");
        $quan = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyak = $quan['quantity'] - $this->request->getVar('quantity');
        if ($this->request->getVar('namaUS') == null || $this->request->getVar('quantity') == null) {
            session()->setFlashdata('gagal', 'Data Tidak Boleh Kosong.');
        } else {
            if ($banyak <= 0) {
                session()->setFlashdata('gagal', 'Barang Tidak cukup.');
            } elseif ($quan['jenis'] == 1) {
                $data = [
                    'title' => 'Tambah Data Peminjaman',
                    'barang' => $this->barangModel->getSpesBarang($this->request->getVar('barang')),
                    'sn' => $this->barangSNModel->getSpesBarangsn2($this->request->getVar('barang')),
                    'nama' => $this->request->getVar('namaUS'),
                    'quantity' => $this->request->getVar('quantity'),
                    'sisa' => $banyak
                ];
                return view('pages/barangMasukTetap', $data);
            } elseif ($banyak > 0 && $quan['jenis'] == 2) {
                $dataquan = [
                    'quantity' => $banyak
                ];
                $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
                $buil->update($dataquan);
                $this->bmModel->save([
                    'barang' => $this->request->getVar('barang'),
                    'quantityBM' => $this->request->getVar('quantity'),
                    'namaUS' => $this->request->getVar('namaUS'),
                    'status' => 0,
                    'tglMas' => $da
                ]);
                session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
            }
        }
        return redirect()->to('/masuk');
    }
    public function saveMasukTetap()
    {
        $da = date("Y-m-d h:i:s");
        $sisa = $this->request->getVar('sisa');
        $dataquan = [
            'quantity' => $this->request->getVar('sisa')
        ];
        $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
        $buil->update($dataquan);
        $this->bmModel->save([
            'barang' => $this->request->getVar('barang'),
            'quantityBM' => $this->request->getVar('quantity'),
            'namaUS' => $this->request->getVar('namaUS'),
            'status' => 0,
            'tglMas' => $da
        ]);
        $idPemiNew = null;
        $pem = $this->bmModel->getBM2();
        foreach ($pem as $row) {
            $idPemiNew = $row['id_bm'];
        };
        for ($x = 1; $x <= $this->request->getVar('quantity'); $x++) {
            $datastat = [
                'statusSN' => 1
            ];
            $buil2 = $this->barangSNModel->build()->where('id_sn', $this->request->getVar('sn' . $x));
            $buil2->update($datastat);
            $this->peminjamansnModel->save([
                'id_pemiBar' => $idPemiNew,
                'id_snBar' => $this->request->getVar('sn' . $x)
            ]);
        }
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/masuk');
    }
    public function deleteBM($id_bm)
    {
        $sts = $this->bmModel->getSpesBM($id_bm);
        $sts2 = $sts['status'];

        if ($sts2 == 0) {
            $quan = $this->bmModel->getSpesBM($id_bm);
            $banyak = $quan['quantityBM'];
            $id = $quan['barang'];
            // dd($banyak, $id);
            $quan2 = $this->barangModel->getSpesBarang($id);
            $banyak2 = $quan2['quantity'];
            $data = [
                'quantity' => $banyak2 + $banyak
            ];
            $buil = $this->barangModel->build()->where('id_bar', $id);
            $buil->update($data);

            $this->bmModel->delete($id_bm);
            session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
            return redirect()->to('/masuk');
        } elseif ($sts2 == 1) {
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
    }
    public function editBM($id_bm)
    {
        $data = [
            'title' => 'Ubah Data Pengembalian',
            'barangMasuk' => $this->bmModel->getSpesBM($id_bm),
            'barang' => $this->barangModel->getBarang2(),
        ];
        return view('pages/editBM', $data);
    }
    public function updateBM($id_bm)
    {
        $quan = $this->bmModel->getSpesBM($id_bm);
        $banyak = $quan['quantityBM'];
        $idBar = $quan['barang'];
        $sts = $quan['status'];
        $usr = $quan['namaUS'];
        $namm = $this->userModel->getUser();
        $namsts = 0;
        $nu = null;
        $quanBar = $this->barangModel->getSpesBarang($idBar);
        $banyakBar = $quanBar['quantity'];
        $namUSR = $this->userModel->getSpesUser($usr);
        $namUSR2 = $this->request->getVar('namaUS');
        $quanBar2 = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
        $banyakBar2 = $quanBar2['quantity'];
        foreach ($namm as $namm) {
            if (strtolower($namm['namaUSR']) == strtolower($this->request->getVar('namaUS'))) {
                $nu = $namm['id_us'];
                $namsts = 1;
            };
        }
        if ($namsts == 0) {
            session()->setFlashdata('gagal', 'User tidak ada.');
        } else {
            if ($sts == 1) {
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
                        'namaUS' => $nu
                    ];
                    $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
                    $buil2->update($dataBM);
                    session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
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
                        'namaUS' => $nu
                    ];
                    $buil = $this->barangModel->build()->where('id_bar', $idBar);
                    $buil->update($dataBar1);
                    $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
                    $buil->update($dataBar2);
                    $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
                    $buil2->update($dataBM);
                    session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
                }
            } elseif ($sts == 0) {
                if ($idBar == $this->request->getVar('barang')) { //ID SAMA
                    if ($banyakBar - ($this->request->getVar('quantity') - $banyak) > 0) {
                        if ($banyak == $this->request->getVar('quantity') and $namUSR == $this->request->getVar('namaUS')) {
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
                            'namaUS' => $nu,
                            'quantityBM' => $this->request->getVar('quantity')
                        ];
                        $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
                        $buil2->update($dataBK);
                        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
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
                            'namaUS' => $nu,
                            'quantityBM' => $this->request->getVar('quantity')
                        ];
                        $buil = $this->barangModel->build()->where('id_bar', $idBar);
                        $buil->update($dataBar1);
                        $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
                        $buil->update($dataBar2);
                        $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
                        $buil2->update($dataBK);
                        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
                    } else {
                        session()->setFlashdata('gagal', 'Barang Tidak cukup.');
                    }
                }
            }
        }
        return redirect()->to('/masuk');
    }
    public function kembaliBM($id_bm)
    {
        $pengembalian = $this->bmModel->getSpesBM($id_bm);
        $quan = $pengembalian['quantityBM'];
        $barid = $pengembalian['barang'];
        $bar = $this->barangModel->getSpesBarang($barid);
        $banyak = $bar['quantity'] + $quan;
        $dataquan = [
            'quantity' => $banyak
        ];
        $buil = $this->barangModel->build()->where('id_bar', $barid);
        $buil->update($dataquan);
        $sta = [
            'status' => 1,
            'tglKel' => date("Y-m-d h:i:s")
        ];
        $buil2 = $this->bmModel->build()->where('id_bm', $id_bm);
        $buil2->update($sta);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        return redirect()->to('/masuk');
    }
    public function keluar()
    {
        $data = [
            'title' => 'Laporan Peminjaman Barang',
            'barangMasuk' => $this->bmModel->getBM(),
        ];
        return view('pages/laporan', $data);
    }
    public function cetak($bulan)
    {
        $data = ['lapor' => $this->bmModel->get_last_month($bulan)];
        return view('/pages/cetak', $data);
    }

    public function pakai()
    {
        $data = [
            'title' => 'Barang Habis pakai',
            'pakai' => $this->bmModel->getPakai()
        ];
        return view('/pages/pemakaian', $data);
    }


    //BARANG KELUAR
    // public function keluar()
    // {
    //     $data = [
    //         'title' => 'Pengembalian barang',
    //         'barangKeluar' => $this->bkModel->getBK(),
    //         'barang' => $this->barangModel->getBarang2(),
    //         'user' => $this->userModel->getUser()
    //     ];
    //     // dd($data);
    //     return view('pages/barangKeluar', $data);
    // }
    // public function saveBK()
    // {
    //     $quan = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
    //     $banyak = $quan['quantity'] - $this->request->getVar('quantity');
    //     if ($banyak > 0) {
    //         $data = [
    //             'quantity' => $banyak
    //         ];
    //         $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
    //         $buil->update($data);
    //         $this->bkModel->save([
    //             'barang' => $this->request->getVar('barang'),
    //             'namaUS' => $this->request->getVar('namaUS'),
    //             'quantityBK' => $this->request->getVar('quantity')
    //         ]);
    //         session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
    //     } else {
    //         session()->setFlashdata('gagal', 'Barang Tidak cukup.');
    //     }
    //     return redirect()->to('/keluar');
    // }
    // public function deleteBK($id_bk)
    // {
    //     $quan = $this->bkModel->getSpesBK($id_bk);
    //     $banyak = $quan['quantityBK'];
    //     $id = $quan['barang'];
    //     // dd($banyak, $id);
    //     $quan2 = $this->barangModel->getSpesBarang($id);
    //     $banyak2 = $quan2['quantity'];
    //     $data = [
    //         'quantity' => $banyak2 + $banyak
    //     ];
    //     $buil = $this->barangModel->build()->where('id_bar', $id);
    //     $buil->update($data);

    //     $this->bkModel->delete($id_bk);
    //     session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
    //     return redirect()->to('/keluar');
    // }
    // public function editBK($id_bk)
    // {
    //     $data = [
    //         'title' => 'Ubah Data Pengembalian Barang',
    //         'barangKeluar' => $this->bkModel->getSpesBK($id_bk),
    //         'barang' => $this->barangModel->getBarang2(),
    //         'user' => $this->userModel->getUser()
    //     ];
    //     return view('pages/editBK', $data);
    // }
    // public function updateBK($id_bk)
    // {
    //     $quan = $this->bkModel->getSpesBK($id_bk);
    //     $banyak = $quan['quantityBK'];
    //     $idBar = $quan['barang'];
    //     $idUs = $quan['namaUS'];
    //     $quanBar = $this->barangModel->getSpesBarang($idBar);
    //     $banyakBar = $quanBar['quantity'];
    //     $quanBar2 = $this->barangModel->getSpesBarang($this->request->getVar('barang'));
    //     $banyakBar2 = $quanBar2['quantity'];
    //     $idUS2 = $this->request->getVar('namaUS');
    //     if ($idBar == $this->request->getVar('barang')) { //ID SAMA
    //         if ($banyakBar - ($this->request->getVar('quantity') - $banyak) > 0) {
    //             if ($banyak == $this->request->getVar('quantity') and $idUs == $this->request->getVar('namaUS')) {
    //                 // echo 'Sama';
    //             } elseif ($this->request->getVar('quantity') > $banyak) {
    //                 // echo 'Lebih Besar';
    //                 $dataBar = [
    //                     'quantity' => $banyakBar - ($this->request->getVar('quantity') - $banyak)
    //                 ];
    //                 // dd($dataBar);
    //                 $buil = $this->barangModel->build()->where('id_bar', $idBar);
    //                 $buil->update($dataBar);
    //             } elseif ($this->request->getVar('quantity') < $banyak) {
    //                 // echo 'Lebih Sedikit';
    //                 $dataBar = [
    //                     'quantity' => $banyakBar + ($banyak - $this->request->getVar('quantity'))
    //                 ];
    //                 // dd($dataBar);
    //                 $buil = $this->barangModel->build()->where('id_bar', $idBar);
    //                 $buil->update($dataBar);
    //             }
    //             $dataBK = [
    //                 'namaUS' => $this->request->getVar('namaUS'),
    //                 'quantityBK' => $this->request->getVar('quantity')
    //             ];
    //             $buil2 = $this->bkModel->build()->where('id_bk', $id_bk);
    //             $buil2->update($dataBK);
    //             session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
    //         } else {
    //             session()->setFlashdata('gagal', 'Barang Tidak cukup.');
    //         }
    //     } else { //ID BEDA
    //         if ($banyakBar2 - ($this->request->getVar('quantity') - $banyak) > 0) {
    //             $dataBar1 = [
    //                 'quantity' => $banyakBar + $this->request->getVar('quantity')
    //             ];
    //             $dataBar2 = [
    //                 'quantity' => $banyakBar2 - $this->request->getVar('quantity')
    //             ];
    //             $dataBK = [
    //                 'barang' => $this->request->getVar('barang'),
    //                 'namaUS' => $this->request->getVar('namaUS'),
    //                 'quantityBK' => $this->request->getVar('quantity')
    //             ];
    //             $buil = $this->barangModel->build()->where('id_bar', $idBar);
    //             $buil->update($dataBar1);
    //             $buil = $this->barangModel->build()->where('id_bar', $this->request->getVar('barang'));
    //             $buil->update($dataBar2);
    //             $buil2 = $this->bkModel->build()->where('id_bk', $id_bk);
    //             $buil2->update($dataBK);
    //             session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
    //         } else {
    //             session()->setFlashdata('gagal', 'Barang Tidak cukup.');
    //         }
    //     }
    //     return redirect()->to('/keluar');
    // }
}
