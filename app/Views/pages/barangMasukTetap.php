<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Peminjaman</h1>
        </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="<?= base_url(); ?>/Pencatatan/saveMasukTetap/" method="post">
                        <?= csrf_field(); ?>
                        <input name="barang" type="text" value="<?php echo $barang['id_bar']; ?>" hidden>
                        <input name="sisa" type="text" value="<?php echo $sisa ?>" hidden>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama barang</label>
                                    <input name="nama" type="text" class="form-control" value="<?php echo $barang['nama']; ?>" required readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Peminjam</label>
                                    <input name="namaUS" type="text" class="form-control" value="<?php echo $nama; ?>" required readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="quantity">Quantity</label>
                                    <input name="quantity" type="text" class="form-control" value="<?php echo $quantity; ?>" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php $ban = $quantity ?>
                                <?php for ($x = 1; $x <= $quantity; $x++) {
                                    echo '<div class="form-group col-md-12 col-12">
                                        <label>Serial Number ke-' . $x, '</label>
                                        <select name="sn' . $x, '" class="form-control">';
                                    foreach ($sn as $sn) {
                                        echo '<option value="', $sn['id_sn'], '">', $sn['sn'], '</option>';
                                    }
                                    echo '</select>';
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