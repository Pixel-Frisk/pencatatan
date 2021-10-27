<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <div class="modal fade Top" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Menambah Akun Sopir -->
                <div class="modal-body">
                    <form action="/Pencatatan/saveBK" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="barang">Barang</label>
                            <select name='barang' class="form-control">
                                <?php foreach ($barang as $barang) : ?>
                                    <option value='<?= $barang['id_bar']; ?>'><?= $barang['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaUS">Peminjam</label>
                            <select name='namaUS' class="form-control">
                                <?php foreach ($user as $user) : ?>
                                    <?php if ($user['role'] == 'admin') continue ?><option value='<?= $user['id_us']; ?>'><?= $user['namaUSR']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" required>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Barang</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php if (session()->getFlashData('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->getFlashData('pesan'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashData('gagal')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->getFlashData('gagal'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="card-header">
                            <div class="card-header-action">
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary float-right ml-1" data-toggle="modal" data-target="#exampleModal">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Barang</th>
                                                        <th scope="col">Peminjam</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Tanggal</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($barangKeluar as $barangKeluar) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $barangKeluar['nama']; ?></td>
                                                            <td><?= $barangKeluar['namaUSR']; ?></td>
                                                            <td><?= $barangKeluar['quantityBK']; ?></td>
                                                            <td><?= $barangKeluar['created_at']; ?></td>
                                                            <td>
                                                                <a href="/bk/edit/<?= $barangKeluar['id_bk']; ?>" class="btn btn-secondary">Edit</a>
                                                                <form action="/bk/<?= $barangKeluar['id_bk']; ?>" method="post" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapusnya ?')">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection(); ?>