<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah</h1>
        </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="<?= base_url(); ?>/Pencatatan/saveTetap/" method="post">
                        <?= csrf_field(); ?>
                        <input name="jenis" type="text" value="<?= $jenis; ?>" hidden>
                        <input name="kategori" type="text" value="<?= $kategori; ?>" hidden>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama barang</label>
                                    <input name="nama" type="text" class="form-control" value="<?= $nama; ?>" required readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Detail barang</label>
                                    <input name="detail_barang" type="text" class="form-control" value="<?= $detail_barang; ?>" required readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="kat">Kategori</label>
                                    <select name='kat' class="form-control" disabled>
                                        <?php foreach ($kategori2 as $kategori2) : ?>
                                            <option value='<?= $kategori2['id_kat']; ?>' <?php if ($kategori == $kategori2['id_kat']) echo 'selected="selected"'; ?>><?= $kategori2['kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Quantity</label>
                                    <input name="quantity" type="text" class="form-control" value="<?= $quantity; ?>" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4>Serial Number</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php $ban = $quantity ?>
                                <?php for ($x = 1; $x <= $quantity; $x++) {
                                    echo '<div class="form-group col-md-12 col-12">
                                        <label>Serial Number ke-' . $x, '</label>
                                        <input name="serial' . $x, '" type="text" class="form-control" required>
                                    </div>';
                                } ?>
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