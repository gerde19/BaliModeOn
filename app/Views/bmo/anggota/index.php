<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Anggota | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Anggota</h1>
        <div class="section-header-button">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Anggota</a>
        </div>
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
    <?= form_open_multipart(base_url('Anggota/anggotaAdd')) ?>
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="user_nama" class="form-label">Nama</label>
                            <input type="text" name="user_nama" id="user_nama" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" name="user_email" id="user_email" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" name="user_password" id="user_password" class="form-control" autocomplete="off" required>
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="user_level" class="form-label">Level</label>
                            <select name="user_level" id="user_level" class="form-control" required="required">
                                <option value="" hidden>- PILIH -</option>
                                <option value="admin">ADMIN</option>
                                <option value="manajemen">MANAJEMEN</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="user_status" class="form-label">Status</label>
                            <select name="user_status" id="user_status" class="form-control" required="required">
                                <option value="" hidden>- PILIH -</option>
                                <option value="active">ACTIVE</option>
                                <option value="disable">DISABLE</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="user_foto" class="form-label">Foto</label>
                            </br>
                            <input type="file" name="user_foto" id="user_doto" class="form-control" required>
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
                        <h4 class="text-dark">Data Anggota</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">LEVEL</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">FOTO</th>
                                    <th width="10%" class="text-center">OPSI</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($anggota as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['user_nama'] ?></td>
                                        <td class="text-center"><?= $key['user_email'] ?></td>
                                        <td class="text-center"><?= $key['user_level'] ?></td>
                                        <td class="text-center"><?= $key['user_status'] ?></td>
                                        <td class="text-center"><img src="<?= base_url('img/' . $key['user_foto']) ?>" style="width:100px;height:100px;"></td>
                                        <td class="text-center">

                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['user_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('anggotaDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="user_id" value="<?= $key['user_id'] ?>">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>

                                            <?= form_open_multipart(base_url('anggota/anggotaEdit')) ?>
                                            <div class="modal fade" data-backdrop="false" id="edit_<?= $key['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Nama</label>
                                                                    <input type="hidden" name="user_id" value="<?= $key['user_id'] ?>">
                                                                    <input type="hidden" name="user_date" value="<?= $key['user_date'] ?>">
                                                                    <input type="text" name="user_nama" required="required" class="form-control" value="<?= $key['user_nama'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Email</label>
                                                                    <input type="text" name="user_email" required="required" class="form-control" value="<?= $key['user_email'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Password</label>
                                                                    <input type="password" name="user_password" class="form-control" value="" style="width:100%" placeholder="Jangan diisi jika tidak dirubah!">
                                                                </div>
                                                            </div>

                                                            <hr />
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-4">
                                                                    <label>Lavel</label>
                                                                    <select name="user_level" class="form-control" required="required">
                                                                        <option value="">- Pilih -</option>
                                                                        <option <?php if ($key['user_level'] == "admin") {
                                                                                    echo "selected='selected'";
                                                                                } ?> value="admin">ADMIN</option>
                                                                        <option <?php if ($key['user_level'] == "manajemen") {
                                                                                    echo "selected='selected'";
                                                                                } ?> value="manajemen">MANAJEMEN</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label>Status</label>
                                                                    <select name="user_status" class="form-control" required="required">
                                                                        <option value="">- Pilih -</option>
                                                                        <option <?php if ($key['user_status'] == "active") {
                                                                                    echo "selected='selected'";
                                                                                } ?> value="active">ACTIVE</option>
                                                                        <option <?php if ($key['user_status'] == "disable") {
                                                                                    echo "selected='selected'";
                                                                                } ?> value="disable">DISABLE</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label for="user_foto" class="form-label">Foto</label>
                                                                    </br>
                                                                    <input type="file" name="user_foto" id="user_foto" class="form-control">
                                                                    </br>
                                                                    Kosongkan jika tidak ingin berubah!.
                                                                </div>
                                                                <div>
                                                                    <img src="<?= base_url('img/' . $key['user_foto']) ?>" style="width:80%;">
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