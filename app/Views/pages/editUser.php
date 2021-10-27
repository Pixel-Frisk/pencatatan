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
                    <form action="/user/update/<?= $users['id_us']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama</label>
                                    <input name="nama" type="text" class="form-control" value="<?= $users['namaUSR']; ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>No. HP</label>
                                    <input name="noHP" type="number" class="form-control" value="<?= $users['noHP']; ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" value="<?= $users['email']; ?>" required>
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