<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Edit</h1>
        </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="/barangMasuk/update/<?= $barangMasuk['id_bm']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="barang">Barang</label>
                                    <select name='barang' class="form-control">
                                        <?php foreach ($barang as $barang) : ?>
                                            <option value='<?= $barang['id_bar']; ?>' <?php if ($barangMasuk['barang'] == $barang['id_bar']) echo 'selected="selected"'; ?>><?= $barang['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12"">
                                    <label for=" namaUS">Peminjam</label>
                                    <select name='namaUS' class="form-control">
                                        <?php foreach ($user as $user) : ?>
                                            <?php if ($user['role'] == 'admin') continue ?><option value='<?= $user['id_us']; ?>' <?php if ($barangMasuk['barang'] == $barang['id_bar']) echo 'selected="selected"'; ?>><?= $user['namaUSR']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Quantity</label>
                                    <input name="quantity" type="text" class="form-control" value="<?= $barangMasuk['quantityBM']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>