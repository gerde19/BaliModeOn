<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Booking Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Booking Kapal</h1>
        <?php
        if (session()->get('user_level') == "admin") {
        ?>
            <div class="section-header-button">
                <a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Booking Kapal</a>
            </div>
        <?php
        } else {
        }
        ?>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error !</b>
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php $validation = session()->getFlashdata('validation'); ?>

    <!-- MODAL -->
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Booking Kapal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <?php foreach ($detailKapal as $key) : ?>
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="<?= base_url('kapal/detail/' . $key['dk_gambar']) ?>" width="100%" height="225">
                                    <div class="card-body">
                                        <h2 class="text-center"><?= $key['dk_nama'] ?></h2>
                                        <table class="table table-striped table-md">
                                            <tbody>
                                                <tr>
                                                    <td>Tujuan</td>
                                                    <td>:</td>
                                                    <td class="text-left"><?= $key['tk_tujuan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kapasitas</td>
                                                    <td>:</td>
                                                    <td class="text-right"><?= $key['dk_kapasitas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mesin</td>
                                                    <td>:</td>
                                                    <td class="text-right" style="font-size: 10pt;"><?= $key['dk_mesin'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Weekday</td>
                                                    <td>:</td>
                                                    <td class="text-right"><?= "Rp. " . number_format($key['dk_day']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Weekend</td>
                                                    <td>:</td>
                                                    <td class="text-right"><?= "Rp. " . number_format($key['dk_end']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted"></small>
                                            <div class="btn-group">
                                                <?= form_open_multipart(base_url('Kapal/bookingKapalAdd')) ?>
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="dk_id" value="<?= $key['dk_id'] ?>">
                                                <button class="btn btn-sm btn-outline-success"><i class="far fa-calendar-alt"></i> Booking</button>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" name="tambah" class="btn btn-primary">Simpan</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Data Booking Kapal</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">ID CUS</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">NAMA KAPAL</th>
                                    <th class="text-center">TGL BOOKING</th>
                                    <th class="text-center">HARGA</th>
                                    <th class="text-center">PERJAM</th>
                                    <th class="text-center">JUMLAH BAYAR</th>
                                    <th class="text-center">KODE BANK</th>
                                    <th class="text-center">STATUS KAPAL</th>
                                    <th class="text-center">STATUS PEMBAYARAN</th>
                                    <?php
                                    if (session()->get('user_level') == "admin") {
                                    ?>
                                        <th width="10%" class="text-center">OPSI</th>
                                    <?php
                                    } else {
                                    }
                                    ?>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($bookingKapal as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['customer'] ?></td>
                                        <td><?= $key['nama'] ?></td>
                                        <td><?= $key['dk_nama'] ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['tgl_booking'])) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_booking']) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_perjam']) ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['harga_bayar']) ?></td>
                                        <td class="text-center"><?= $key['kode_bank'] ?></td>
                                        <td class="text-center"><?php
                                                                if ($key['status_kapal'] == "Booked") {
                                                                    echo "Ready / Standby";
                                                                } elseif ($key['status_kapal'] == "Berlayar") {
                                                                    echo "Berlayar / Booked";
                                                                } elseif ($key['status_kapal'] == "Selesai") {
                                                                    echo "Bersandar";
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

                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['transaksi_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('printBookingKapal') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                <button class="btn btn-info"><i class="fas fa-print"></i></button>
                                            </form>
                                            <?php
                                            if ($key['status_kapal'] == "Booked") { ?>
                                                <form action="<?= site_url('bookingKapalDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } ?>

                                            <?php
                                            if ($key['status_kapal'] == "Booked") {
                                                echo form_open_multipart(base_url('Kapal/bookingKapalSailing'));
                                            } elseif ($key['status_kapal'] == "Berlayar") {
                                                echo form_open_multipart(base_url('Kapal/bookingKapalBack'));
                                            } ?>
                                            <div class="modal fade" data-backdrop="false" id="edit_<?= $key['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eksekusi Booking Kapal</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-3">
                                                                    <label>Customer</label>
                                                                    <select name="customer" class="form-control" required="required" <?php
                                                                                                                                        if ($key['status_pembayaran'] == "Lunas" or $key['status_pembayaran'] == "DP") {
                                                                                                                                            echo "disabled";
                                                                                                                                        }
                                                                                                                                        ?>>
                                                                        <option value="">- Pilih -</option>
                                                                        <?php foreach ($customer as $c) : ?>
                                                                            <option <?php if ($key['customer'] == $c['cus_id']) {
                                                                                        echo "selected='selected'";
                                                                                    } ?> value="<?= $c['cus_id'] ?>"><?= $c['cus_nama']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-lg-6" style="width:100%">
                                                                    <label>Nama</label>
                                                                    <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                                    <input type="text" name="nama" required="required" class="form-control" value="<?= $key['nama'] ?>" style="width:100%" <?php
                                                                                                                                                                                            if ($key['status_pembayaran'] == "Lunas" or $key['status_pembayaran'] == "DP") {
                                                                                                                                                                                                echo "readonly";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>>
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Pilih Kapal</label>
                                                                    <select name="nama_kapal" class="form-control" required="required" <?php
                                                                                                                                        if ($key['status_pembayaran'] == "Lunas" or $key['status_pembayaran'] == "DP") {
                                                                                                                                            echo "disabled";
                                                                                                                                        }
                                                                                                                                        ?>>
                                                                        <option value="">- Pilih -</option>
                                                                        <?php foreach ($detailKapal as $k) : ?>
                                                                            <option <?php if ($key['nama_kapal'] == $k['dk_id']) {
                                                                                        echo "selected='selected'";
                                                                                    } ?> value="<?= $k['dk_id'] ?>"><?= $k['dk_nama']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label for="tgl_booking" class="form-label">Tanggal Booking</label>
                                                                    <input type="date" name="tgl_booking" id="tgl_booking" value="<?= $key['tgl_booking'] ?>" class="form-control" autocomplete="off" readonly>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label for="harga_booking" class="form-label">Harga Sewa</label>
                                                                    <input type="hidden" name="harga_booking" id="harga_booking" class="form-control text-right" value="<?= $key['harga_booking'] ?>" autocomplete="off" readonly>
                                                                    <input type="text" class="form-control text-right" value="<?= "Rp. " . number_format($key['harga_booking']) ?>" autocomplete="off" readonly>
                                                                </div>
                                                                <?php
                                                                if ($key['status_kapal'] == "Booked") { ?>
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="tgl_re" class="form-label">Tanggal Re-Schedule</label>
                                                                        <input type="date" name="tgl_re" id="tgl_re" class="form-control datepicker" autocomplete="off"> Kosongkan jika tanggal booking tidak berubah!
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                            <hr />
                                                            <div class="form-row">
                                                                <?php
                                                                if ($key['status_kapal'] == "Berlayar") { ?>
                                                                    <div class="form-group col-lg-4">
                                                                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                                                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control datepicker" autocomplete="off" required>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="kode_bank" class="form-label">Nomor Refrensi Bank</label>
                                                                    <input type="number" name="kode_bank" id="kode_bank" class="form-control text-right" value="<?= $key['kode_bank']; ?>" autocomplete="off" <?php
                                                                                                                                                                                                                if ($key['status_pembayaran'] == "Lunas") {
                                                                                                                                                                                                                    echo "readonly";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="harga_bayar" class="form-label">Bayar</label>
                                                                    <?php
                                                                    $hasil = floatval($key['harga_booking']) - floatval($key['harga_bayar']);
                                                                    if ($hasil > 0) { ?>
                                                                        <input type="number" name="harga_bayar" id="harga_bayar" class="form-control text-right" autocomplete="off">Sisa pembayaran kurang Rp. <?= number_format($hasil) ?>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input type="text" name="harga_bayar" id="harga_bayar" value="<?= $key['harga_bayar'] ?>" class="form-control text-right" autocomplete="off" readonly>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Verifikasi</button>
                                                            <button type="reset" class="btn btn-secondary"> Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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