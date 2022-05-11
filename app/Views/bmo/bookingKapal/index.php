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
                <?= form_open_multipart(base_url('Kapal/bookingKapalAdd')) ?>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="transaksi_nama" class="form-label">Nama</label>
                            <input type="text" name="transaksi_nama" id="transaksi_nama" class="form-control" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="transaksi_email" class="form-label">Email</label>
                            <input type="email" name="transaksi_email" id="transaksi_emailemail" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="transaksi_kode_kapal" class="form-label">Pilih Kapal</label>
                            <select name="transaksi_kode_kapal" id="transaksi_kode_kapal" class="form-control" required>
                                <option value="" hidden>- PILIH -</option>
                                <?php foreach ($detailKapal as $d) : ?>
                                    <option value="<?= $d['dk_id']; ?>"><?= $d['dk_nama'] . " - " . $d['tk_tujuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="transaksi_tgl_booking" class="form-label">Tanggal Booking</label>
                            <input type="date" name="transaksi_tgl_booking" id="transaksi_tgl_booking" class="form-control datepicker" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="transaksi_telp" class="form-label">Nomor Telp</label>
                            <input type="text" name="transaksi_telp" id="transaksi_telp" class="form-control datepicker" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Booking</button>
                </div>
                <?= form_close() ?>
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
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">TGL BOOKING</th>
                                    <th class="text-center">TGL SELESAI</th>
                                    <th class="text-center">JAM BERANGKAT</th>
                                    <th class="text-center">JAM SELESAI</th>
                                    <th class="text-center">KODE KAPAL</th>
                                    <th class="text-center">HARGA</th>
                                    <th class="text-center">TUJUAN</th>
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
                                        <td class="text-center"><?= $key['transaksi_nama'] ?></td>
                                        <td><?= $key['transaksi_email'] ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['transaksi_tgl_booking'])) ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($key['transaksi_tgl_selesai'] == "0000-00-00") {
                                                echo "-";
                                            } else {
                                                echo date('d-m-Y', strtotime($key['transaksi_tgl_selesai']));
                                            }
                                            ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['transaksi_jam_booking'])) ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($key['transaksi_jam_kembali'])) ?></td>
                                        <td class="text-center"><?= $key['dk_nama'] ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['transaksi_harga']) ?></td>
                                        <td class="text-center"><?= $key['tk_tujuan'] ?></td>
                                        <td class="text-center"><?= $key['transaksi_status_kapal'] ?></td>
                                        <td class="text-center"><?= $key['transaksi_status_pembayaran'] ?></td>
                                        <td class="text-center">

                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['transaksi_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('printBookingKapal') ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                <button class="btn btn-info"><i class="fas fa-print"></i></button>
                                            </form>
                                            <?php
                                            if ($key['transaksi_status_kapal'] == "Booking") { ?>
                                                <form action="<?= site_url('bookingKapalDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } ?>

                                            <?php
                                            if ($key['transaksi_status_kapal'] == "Booking") {
                                                echo form_open_multipart(base_url('Kapal/bookingKapalSailing'));
                                            } elseif ($key['transaksi_status_kapal'] == "Berlayar") {
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
                                                                <div class="form-group col-lg-6" style="width:100%">
                                                                    <label>Nama</label>
                                                                    <input type="hidden" name="transaksi_id" value="<?= $key['transaksi_id'] ?>">
                                                                    <input type="text" name="transaksi_nama" required="required" class="form-control" value="<?= $key['transaksi_nama'] ?>" style="width:100%" <?php
                                                                                                                                                                                                                if ($key['transaksi_status_pembayaran'] == "Lunas") {
                                                                                                                                                                                                                    echo "readonly";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>>
                                                                </div>
                                                                <div class="form-group col-lg-6" style="width:100%">
                                                                    <label>Email</label>
                                                                    <input type="email" name="transaksi_email" required="required" class="form-control" value="<?= $key['transaksi_email'] ?>" style="width:100%" <?php
                                                                                                                                                                                                                    if ($key['transaksi_status_pembayaran'] == "Lunas") {
                                                                                                                                                                                                                        echo "readonly";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label>Pilih Kapal</label>
                                                                    <select name="transaksi_kode_kapal" class="form-control" required="required" <?php
                                                                                                                                                    if ($key['transaksi_status_pembayaran'] == "Lunas") {
                                                                                                                                                        echo "disabled";
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                                                        <option value="">- Pilih -</option>
                                                                        <?php foreach ($detailKapal as $k) : ?>
                                                                            <option <?php if ($key['transaksi_kode_kapal'] == $k['dk_id']) {
                                                                                        echo "selected='selected'";
                                                                                    } ?> value="<?= $k['dk_id'] ?>"><?= $k['dk_nama'] . " - " . $k['dk_tujuan']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="transaksi_tgl_booking" class="form-label">Tanggal Booking</label>
                                                                    <input type="date" name="transaksi_tgl_booking" id="transaksi_tgl_booking" value="<?= $key['transaksi_tgl_booking'] ?>" class="form-control" autocomplete="off" readonly>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="transaksi_telp" class="form-label">Nomor Telp</label>
                                                                    <input type="text" name="transaksi_telp" class="form-control text-right" value="<?= $key['transaksi_telp'] ?>" autocomplete="off">
                                                                </div>
                                                                <?php
                                                                if ($key['transaksi_status_kapal'] == "Booking") { ?>
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="tgl_re" class="form-label">Tanggal Re-Schedule</label>
                                                                        <input type="date" name="tgl_re" id="tgl_re" class="form-control datepicker" autocomplete="off"> Kosongkan jika tanggal booking tidak berubah!
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                            <hr />
                                                            <div class="form-row">
                                                                <?php
                                                                if ($key['transaksi_status_kapal'] == "Berlayar") { ?>
                                                                    <div class="form-group col-lg-4">
                                                                        <label for="transaksi_tgl_selesai" class="form-label">Tanggal Selesai</label>
                                                                        <input type="date" name="transaksi_tgl_selesai" id="transaksi_tgl_selesai" class="form-control datepicker" autocomplete="off" required>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="transaksi_nomor_bank" class="form-label">Nomor Refrensi Bank</label>
                                                                    <input type="number" name="transaksi_nomor_bank" id="transaksi_nomor_bank" class="form-control text-right" value="<?= $key['transaksi_nomor_bank']; ?>" autocomplete="off" <?php
                                                                                                                                                                                                                                                if ($key['transaksi_status_pembayaran'] == "Lunas") {
                                                                                                                                                                                                                                                    echo "readonly";
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                ?>>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="transaksi_bayar" class="form-label">Bayar</label>
                                                                    <?php
                                                                    $hasil = floatval($key['transaksi_harga']) - floatval($key['transaksi_bayar']);
                                                                    if ($hasil > 0) { ?>
                                                                        <input type="number" name="transaksi_bayar" id="transaksi_bayar" class="form-control text-right" autocomplete="off" required>Sisa pembayaran kurang Rp. <?= number_format($hasil) ?>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input type="text" name="transaksi_bayar" id="transaksi_bayar" value="<?= $key['transaksi_bayar'] ?>" class="form-control text-right" autocomplete="off" readonly>
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