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
                    <form action="/barang/update/<?= $barang['id_bar']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="slug" value="<?= $barang['slug']; ?>">
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama barang</label>
                                    <input name="nama" type="text" class="form-control" value="<?= $barang['nama']; ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Detail barang</label>
                                    <input name="detail_barang" type="text" class="form-control" value="<?= $barang['detail_barang']; ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Kategori</label>
                                    <input name="kategori" type="text" class="form-control" value="<?= $barang['kategori']; ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Quantity</label>
                                    <input name="quantity" type="text" class="form-control" value="<?= $barang['quantity']; ?>" required>
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