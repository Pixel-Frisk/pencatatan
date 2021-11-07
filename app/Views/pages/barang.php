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
                    <form action="<?= base_url(); ?>/Pencatatan/saveBarang" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input name="nama" type="text" class="form-control" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="detail_barang">Detail Barang</label>
                            <textarea name="detail_barang" class="form-control" id="detail_barang"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name='kategori' class="form-control">
                                <?php foreach ($kategori as $kategori) : ?>
                                    <option value='<?= $kategori['id_kat']; ?>'><?= $kategori['kategori']; ?></option>
                                <?php endforeach; ?>
                                <option value='belum_ada'>Tambah Kategori...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="kategori2" type="text" class="form-control" id="kategori2" placeholder="Tambah Kategori...">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Barang</label>
                            <select name='jenis' class="form-control">
                                <option value="tetap">Barang Tetap</option>
                                <option value="habis">Barang Habis Pakai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input name="quantity" type="number" class="form-control" id="quantity" required>
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
            <h1>Data Barang</h1>
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
                                                        <th scope="col">Detail</th>
                                                        <th scope="col">Kategori</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($barang as $barang) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $barang['nama']; ?></td>
                                                            <?php if ($barang['detail_barang'] == null) : ?>
                                                                <td>-</td>
                                                            <?php endif; ?>
                                                            <?php if ($barang['detail_barang'] != null) : ?>
                                                                <td><?= $barang['detail_barang']; ?></td>
                                                            <?php endif; ?>
                                                            <td><?= $barang['kategori']; ?></td>
                                                            <td><?= $barang['quantity']; ?></td>
                                                            <td>
                                                                <a href="<?= base_url(); ?>/barang/edit/<?= $barang['id_bar']; ?>" class="btn btn-secondary">Edit</a>
                                                                <?php if ($barang['jenis'] == 1) : ?>
                                                                    <a href="<?= base_url(); ?>/barang/lihat/<?= $barang['id_bar']; ?>" class="btn btn-success">Detail</a>
                                                                <?php endif; ?>
                                                                <form action="<?= base_url(); ?>/barang/<?= $barang['id_bar']; ?>" method="post" class="d-inline">
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