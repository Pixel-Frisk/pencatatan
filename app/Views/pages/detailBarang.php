<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Barang</h1>
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
                                                        <th scope="col">Barang</th>
                                                        <th scope="col">Detail</th>
                                                        <th scope="col">Kategori</th>
                                                        <th scope="col">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <tr>
                                                        <td><?= $barang['nama']; ?></td>
                                                        <?php if ($barang['detail_barang'] == null) : ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if ($barang['detail_barang'] != null) : ?>
                                                            <td><?= $barang['detail_barang']; ?></td>
                                                        <?php endif; ?>
                                                        <?php foreach ($kategori as $kategori) : ?>
                                                            <?php if ($barang['kategori'] == $kategori['id_kat']) echo '<td>' . $kategori['kategori'], '</td>'; ?>
                                                        <?php endforeach ?>
                                                        <td><?= $barang['quantity']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5>Detail Barang</h5>
                                                    <br>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Kode Barang</th>
                                                                <th scope="col">Serial Number</th>
                                                                <th scope="col">Status Barang</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1 ?>
                                                            <?php foreach ($barangSN as $barangSN) : ?>
                                                                <tr>
                                                                    <?php if ($barang['id_bar'] == $barangSN['id_bars']) echo '<th scope="row">' . $barangSN['id_bar_spes'], '</th>
                                                        <td>' . $barangSN['sn'], '</td> <td>';
                                                                    if ($barangSN['statusSN'] == 0) {
                                                                        echo "Ada";
                                                                    } else {
                                                                        echo "Dipinjam";
                                                                    }; ?>
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
            </div>
        </div>
    </section>
    <?= $this->endSection(); ?>