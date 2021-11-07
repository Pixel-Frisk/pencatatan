<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pemakaian Barang</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($pakai as $pakai) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $pakai['nama']; ?></td>
                                                            <td><?= $pakai['namaUS']; ?></td>
                                                            <td><?= $pakai['quantityBM']; ?></td>
                                                            <td><?php if ($pakai['status'] == 0) echo 'Dipinjam' ?><?php if ($pakai['status'] == 1) echo 'Dikembalikan' ?></td>
                                                            <td><?= $pakai['tglMas']; ?></td>
                                                            <!-- <td>
                                                                <?php if ($pakai['status'] == 0) : ?>
                                                                    <a href="<?= base_url(); ?>/bm/kembali/<?= $pakai['id_bm']; ?>" class="btn btn-success" onclick="return confirm('Apakah barang sudah dikembalikan ?')">Dikembalikan?</a>
                                                                <?php endif; ?> -->
                                                            <!-- <a href="<?= base_url(); ?>/bm/edit/<?= $pakai['id_bm']; ?>" class="btn btn-secondary">Edit</a> -->
                                                            <!-- <form action="<?= base_url(); ?>/bm/<?= $pakai['id_bm']; ?>" method="post" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapusnya ?')">Delete</button>
                                                                </form> -->
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