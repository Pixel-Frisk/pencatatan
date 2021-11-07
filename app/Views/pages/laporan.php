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
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>Laporan Peminjaman Barang</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-3">
                                <div class="col-auto">
                                    <select id="bulan" class="form-group">
                                        <?php
                                        for ($i = 0; $i < 12; $i++) {
                                            $time = strtotime(sprintf('%d months', $i));
                                            $label = date('F', $time);
                                            $value = date('n', $time);
                                            echo "<option value='$value'>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <a href="" onclick="this.href='<?= base_url(); ?>/cetak/'+document.getElementById('bulan').value" target="_blank" class="btn btn-success mb-3">Cetak</a>
                                </div>
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
                                                    <th scope="col">Stok</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($barangMasuk as $barangMasuk) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $no++; ?></th>
                                                        <td><?= $barangMasuk['nama']; ?></td>
                                                        <td><?= $barangMasuk['namaUS']; ?></td>
                                                        <td><?= $barangMasuk['quantity']; ?></td>
                                                        <?php if ($barangMasuk['status'] == 0) : ?>
                                                            <td>Dipinjam Dari Tanggal <?= $barangMasuk['tglMas']; ?></td>
                                                        <?php endif; ?>
                                                        <?php if ($barangMasuk['status'] == 1) : ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
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