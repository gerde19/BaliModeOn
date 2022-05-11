<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tujuan Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tujuan kapal</h1>
        <?php
        if (session()->get('user_level') == "admin") {
        ?>
            <div class="section-header-button">
                <a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Tujuan Kapal</a>
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
    <?= form_open_multipart(base_url('Kapal/tujuanKapalAdd')) ?>
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tujuan Kapal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label for="tk_kode" class="form-label">Kode Tujuan</label>
                            <input type="text" name="tk_kode" id="tk_kode" class="form-control" value="TK<?php echo sprintf("%04s", $kodeTujuanKapal) ?>" autocomplete="off" readonly>
                        </div>
                        <div class="form-group col-lg-9">
                            <label for="tk_tujuan" class="form-label">Tujuan Kapal</label>
                            <input type="text" name="tk_tujuan" id="tk_tujuan" class="form-control" autocomplete="off">
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="tk_jam" class="form-label">Jam Kapal</label>
                            <input type="time" name="tk_jam" id="tk_jam" class="form-control datepicker" autocomplete="off">
                        </div>
                    </div>

                    <hr />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Data Tujuan Kapal</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">KODE</th>
                                    <th class="text-center">TUJUAN</th>
                                    <th class="text-center">JAM</th>
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
                                <?php foreach ($tujuanKapal as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['tk_kode'] ?></td>
                                        <td><?= $key['tk_tujuan'] ?></td>
                                        <td><?= $key['tk_jam'] ?></td>
                                        <?php
                                        if (session()->get('user_level') == "admin") {
                                        ?>
                                            <td class="text-center">

                                                <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['tk_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="<?= site_url('tujuanKapalDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="tk_id" value="<?= $key['tk_id'] ?>">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>


                                                <?= form_open_multipart(base_url('Kapal/tujuanKapalEdit')) ?>
                                                <div class="modal fade" data-backdrop="false" id="edit_<?= $key['tk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Detail Kapal</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <?= csrf_field(); ?>
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-3">
                                                                        <label>Kode Kapal</label>
                                                                        <input type="text" name="tk_kode" required="required" class="form-control" value="<?= $key['tk_kode'] ?>" style="width:100%" readonly>
                                                                    </div>
                                                                    <div class="form-group col-lg-9" style="width:100%">
                                                                        <label>Tujuan Kapal</label>
                                                                        <input type="hidden" name="tk_id" value="<?= $key['tk_id'] ?>">
                                                                        <input type="text" name="tk_tujuan" required="required" class="form-control" value="<?= $key['tk_tujuan'] ?>" style="width:100%">
                                                                    </div>
                                                                </div>

                                                                <hr />
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="tk_jam" class="form-label">Jam Kapal</label>
                                                                        <input type="time" name="tk_jam" id="tk_jam" class="form-control" value="<?= $key['tk_jam'] ?>" style="width:100%" autocomplete="off">
                                                                    </div>
                                                                </div>

                                                                <hr />

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>
                                                                <button type="reset" class="btn btn-secondary"> Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?= form_close() ?>
                                            </td>
                                        <?php } else {
                                        } ?>
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
<?= $this->endSection() ?>