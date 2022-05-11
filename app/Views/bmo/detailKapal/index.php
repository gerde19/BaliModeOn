<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Detail Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Detail kapal</h1>
        <?php
        if (session()->get('user_level') == "admin") {
        ?>
            <div class="section-header-button">
                <a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Detail Kapal</a>
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
    <?= form_open_multipart(base_url('Kapal/detailKapalAdd')) ?>
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Kapal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label for="dk_kode" class="form-label">Kode Kapal</label>
                            <select name="dk_kode" id="dk_kode" class="form-control" required>
                                <option value="" hidden>- PILIH -</option>
                                <?php foreach ($kodeKapal as $d) : ?>
                                    <option value="<?= $d['kk_id']; ?>"><?= $d['kk_kode']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-9">
                            <label for="dk_nama" class="form-label">Nama Kapal</label>
                            <input type="text" name="dk_nama" id="dk_nama" class="form-control" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="dk_kapal" class="form-label">Kapten Kapal</label>
                            <select name="dk_kapten" id="dk_kapten" class="form-control" required="required">
                                <option value="" hidden>- PILIH -</option>
                                <option value="1">ADA</option>
                                <option value="0">TIDAK ADA</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dk_kapasitas" class="form-label">Kapasitas Kapal</label>
                            <input type="number" name="dk_kapasitas" id="dk_kapasitas" class="form-control" autocomplete="off">
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="dk_day" class="form-label">Harga Weekday</label>
                            <input type="number" name="dk_day" id="dk_day" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="dk_end" class="form-label">Harga Weekend</label>
                            <input type="number" name="dk_end" id="dk_end" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="dk_tujuan" class="form-label">Tujuan</label>
                            <select name="dk_tujuan" id="dk_tujuan" class="form-control" required>
                                <option value="" hidden>- PILIH -</option>
                                <?php foreach ($tujuanKapal as $d) : ?>
                                    <option value="<?= $d['tk_kode']; ?>"><?= $d['tk_tujuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="dk_mesin" class="form-label">Mesin Kapal</label>
                            <input type="text" name="dk_mesin" id="dk_mesin" class="form-control" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dk_gambar" class="form-label">Foto Kapal</label>
                            </br>
                            <input type="file" name="dk_gambar" id="dk_gambar" class="form-control" required>
                        </div>
                    </div>

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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Data Harga Sewa Kapal</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">KODE</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">KAPTEN</th>
                                    <th class="text-center">KAPASITAS</th>
                                    <th class="text-center">WEEKDAY</th>
                                    <th class="text-center">WEEKEND</th>
                                    <th class="text-center">TUJUAN</th>
                                    <th class="text-center">MESIN</th>
                                    <th class="text-center">GAMBAR</th>
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
                                <?php foreach ($detailKapal as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['kk_kode'] ?></td>
                                        <td><?= $key['dk_nama'] ?></td>
                                        <td class="text-center"><?php if ($key['dk_kapten'] == "1") {
                                                                    echo "&radic;";
                                                                } else {
                                                                    echo "";
                                                                } ?></td>
                                        <td class="text-center"><?= $key['dk_kapasitas'] ?></td>
                                        <td><?= "Rp. " . number_format($key['dk_day']) ?></td>
                                        <td><?= "Rp. " . number_format($key['dk_end']) ?></td>
                                        <td><?= $key['tk_tujuan'] ?></td>
                                        <td><?= $key['dk_mesin'] ?></td>
                                        <td class="text-center"><img src="<?= base_url('kapal/detail/' . $key['dk_gambar']) ?>" style="width:100px;height:100px;"></td>
                                        <?php
                                        if (session()->get('user_level') == "admin") {
                                        ?>
                                            <td class="text-center">

                                                <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['dk_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="<?= site_url('detailKapalDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="dk_id" value="<?= $key['dk_id'] ?>">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>


                                                <?= form_open_multipart(base_url('Kapal/detailKapalEdit')) ?>
                                                <div class="modal fade" data-backdrop="false" id="edit_<?= $key['dk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <select name="dk_kode" class="form-control" required="required">
                                                                            <option value="">- Pilih -</option>
                                                                            <?php foreach ($kodeKapal as $k) : ?>
                                                                                <option <?php if ($key['dk_kode'] == $k['kk_id']) {
                                                                                            echo "selected='selected'";
                                                                                        } ?> value="<?= $k['kk_id'] ?>"><?= $k['kk_kode']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-lg-9" style="width:100%">
                                                                        <label>Nama Kapal</label>
                                                                        <input type="hidden" name="dk_id" value="<?= $key['dk_id'] ?>">
                                                                        <input type="text" name="dk_nama" required="required" class="form-control" value="<?= $key['dk_nama'] ?>" style="width:100%">
                                                                    </div>
                                                                </div>

                                                                <hr />
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-6">
                                                                        <label>Kapten Kapal</label>
                                                                        <select name="dk_kapten" class="form-control" required="required">
                                                                            <option value="">- Pilih -</option>
                                                                            <option <?php if ($key['dk_kapten'] == "1") {
                                                                                        echo "selected='selected'";
                                                                                    } ?> value="1">ADA</option>
                                                                            <option <?php if ($key['dk_kapten'] == "0") {
                                                                                        echo "selected='selected'";
                                                                                    } ?> value="0">TIDAK ADA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-lg-6" style="width:100%">
                                                                        <label>Kapasitas Kapal</label>
                                                                        <input type="text" name="dk_kapasitas" required="required" class="form-control" value="<?= $key['dk_kapasitas'] ?>" style="width:100%">
                                                                    </div>
                                                                </div>

                                                                <hr />
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-4" style="width:100%">
                                                                        <label>Harga Weekday</label>
                                                                        <input type="number" name="dk_day" required="required" class="form-control" value="<?= $key['dk_day'] ?>" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group col-lg-4" style="width:100%">
                                                                        <label>Harga Weekend</label>
                                                                        <input type="number" name="dk_end" required="required" class="form-control" value="<?= $key['dk_end'] ?>" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group col-lg-4" style="width:100%">
                                                                        <label>Tujuan</label>
                                                                        <select name="dk_tujuan" class="form-control" required="required" style="width:100%">
                                                                            <option value="">- Pilih -</option>
                                                                            <?php foreach ($tujuanKapal as $k) : ?>
                                                                                <option <?php if ($key['dk_tujuan'] == $k['tk_kode']) {
                                                                                            echo "selected='selected'";
                                                                                        } ?> value="<?= $k['tk_kode'] ?>"><?= $k['tk_tujuan']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <hr />
                                                                <div class="form-row">
                                                                    <div class="form-group col-lg-6" style="width:100%">
                                                                        <label>Mesin Kapal</label>
                                                                        <input type="text" name="dk_mesin" required="required" class="form-control" value="<?= $key['dk_mesin'] ?>" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="dk_gambar" class="form-label">Foto Kapal</label>
                                                                        </br>
                                                                        <input type="file" name="dk_gambar" id="dk_gambar" value="<?= base_url('kapal/detail/' . $key['dk_gambar']) ?>" class="form-control">
                                                                        </br>
                                                                        Kosongkan jika tidak ingin berubah!.
                                                                    </div>
                                                                    <div>
                                                                        <img src="<?= base_url('kapal/detail/' . $key['dk_gambar']) ?>" style="width:80%;">
                                                                    </div>

                                                                </div>
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