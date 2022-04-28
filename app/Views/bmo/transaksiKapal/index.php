<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Laporan Transaksi Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Laporan Transaksi Kapal</h1>
        <?php
        if (session()->get('user_level') == "admin") {
        ?>
            <div class="section-header-button">
                <a href="<?= site_url('bookingKapal') ?>" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Booking Kapal</a>
            </div>
        <?php
        } else {
        }
        ?>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Laporan Transaksi Kapal</h4>
                    </div>
                    <div class="box-body col-md-12 text-center">
                        <?= form_open_multipart(base_url('Kapal/laporanBookingKapal')) ?>
                        <div class="row" style="margin: auto;">
                            <?= csrf_field(); ?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Awal</label>
                                    <input type="date" name="tgl_awal" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="tgl_sampai" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <br />
                                    <button type="submit" class="btn btn-sm btn-primary btn-block" style="float: right;">CARI</button>
                                </div>
                            </div>

                        </div>
                        <?= form_close() ?>
                    </div>
                    <div class="card-body table-responsive">
                        <?php if (empty($cetak)) {
                            echo "";
                        } else {
                            foreach ($cetak as $row) : ?>
                                <?= form_open_multipart(base_url('Kapal/printTransaksiKapal')) ?>
                                <?= csrf_field() ?>
                                <input type="hidden" name="tgl_awal" value="<?php echo $row['tgl1']; ?>">
                                <input type="hidden" name="tgl_sampai" value="<?php echo $row['tgl2']; ?>">
                                <button class="btn btn-sm btn-success float-right" style="border-radius: 10px;"><i class="fas fa-print"> CETAK</i></button>
                                <?= form_close() ?>
                            <?php endforeach; ?>
                        <?php } ?>
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">ID CUS</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">NAMA KAPAL</th>
                                    <th class="text-center">TGL BOOKING</th>
                                    <th class="text-center">TGL SELESAI</th>
                                    <th class="text-center">HARGA</th>
                                    <th class="text-center">PERJAM</th>
                                    <th class="text-center">JUMLAH BAYAR</th>
                                    <th class="text-center">KODE BANK</th>
                                    <th class="text-center">STATUS KAPAL</th>
                                    <th class="text-center">STATUS PEMBAYARAN</th>
                                    <th class="text-center">NOTA</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($transaksi as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['customer'] ?></td>
                                        <td><?= $key['nama'] ?></td>
                                        <td><?= $key['dk_nama'] ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['tgl_booking'])) ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['tgl_selesai'])) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_booking']) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_perjam']) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_bayar']) ?></td>
                                        <td class="text-center"><?= $key['kode_bank'] ?></td>
                                        <td class="text-center"><?php
                                                                if ($key['status_kapal'] == "Booked") {
                                                                    echo "Ready / Standby";
                                                                } elseif ($key['status_kapal'] == "Berlayar") {
                                                                    echo "Berlayar / Booked";
                                                                } elseif ($key['status_kapal'] == "Kembali") {
                                                                    echo "Selesai";
                                                                } ?></td>
                                        <td class="text-center"><?php
                                                                if ($key['status_pembayaran'] == "DP") {
                                                                    echo "Pembayaran Di DP";
                                                                } elseif ($key['status_pembayaran'] == "Lunas") {
                                                                    echo "Pembayaran Lunas";
                                                                } elseif ($key['status_pembayaran'] == "Belum") {
                                                                    echo "Belum DIbayar";
                                                                } ?></td>
                                        <td class="text-center">
                                            <?= form_open_multipart(base_url('Kapal/printBookingKapal')) ?>
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                            <button class="btn btn-info"><i class="fas fa-print"></i></button>
                                            <?= form_close() ?>
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
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?= $this->endSection() ?>