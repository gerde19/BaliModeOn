<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Customer | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Customer</h1>
        <div class="section-header-button">
            <a href="" class="btn btn-color" data-toggle="modal" data-target="#exampleModal">Tambah Customer</a>
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
    <?= form_open_multipart(base_url('Customer/customerAdd')) ?>
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="cus_nama" class="form-label">Nama</label>
                            <input type="text" name="cus_nama" id="cus_nama" class="form-control" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" name="cus_email" id="cus_email" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="cus_password" class="form-label">Password</label>
                            <input type="password" name="cus_password" id="cus_password" class="form-control" autocomplete="off" required>
                        </div>
                    </div>

                    <hr />
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="cus_alamat" class="form-label">Alamat</label>
                            <input type="text" name="cus_alamat" id="cus_alamat" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="cus_kota" class="form-label">Kota</label>
                            <input type="text" name="cus_kota" id="cus_kota" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="cus_provinsi" class="form-label">Provinsi</label>
                            <input type="text" name="cus_provinsi" id="cus_provinsi" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="cus_negara" class="form-label">Negara</label>
                            <input type="text" name="cus_negara" id="cus_negara" class="form-control" autocomplete="off" required>
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
                        <h4 class="text-dark">Data Customer</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">ALAMAT</th>
                                    <th class="text-center">KOTA</th>
                                    <th class="text-center">PROVINSI</th>
                                    <th class="text-center">NEGARA</th>
                                    <th width="10%" class="text-center">OPSI</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($customer as $key) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['cus_nama'] ?></td>
                                        <td class="text-center"><?= $key['cus_email'] ?></td>
                                        <td class="text-center"><?= $key['cus_alamat'] ?></td>
                                        <td class="text-center"><?= $key['cus_kota'] ?></td>
                                        <td class="text-center"><?= $key['cus_provinsi'] ?></td>
                                        <td class="text-center"><?= $key['cus_negara'] ?></td>
                                        <td class="text-center">

                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['cus_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('customerDel') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="cus_id" value="<?= $key['cus_id'] ?>">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>

                                            <?= form_open_multipart(base_url('customer/customerEdit')) ?>
                                            <div class="modal fade" data-backdrop="false" id="edit_<?= $key['cus_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Nama</label>
                                                                    <input type="hidden" name="cus_id" value="<?= $key['cus_id'] ?>">
                                                                    <input type="hidden" name="cus_date" value="<?= $key['cus_date'] ?>">
                                                                    <input type="text" name="cus_nama" required="required" class="form-control" value="<?= $key['cus_nama'] ?>" style="width:100%" onkeyup="this.value=this.value.toUpperCase()">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Email</label>
                                                                    <input type="text" name="cus_email" required="required" class="form-control" value="<?= $key['cus_email'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Password</label>
                                                                    <input type="password" name="cus_password" class="form-control" value="" style="width:100%" placeholder="Jangan diisi jika tidak dirubah!">
                                                                </div>
                                                            </div>

                                                            <hr />
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-12" style="width:100%">
                                                                    <label>Alamat</label>
                                                                    <input type="text" name="cus_alamat" required="required" class="form-control" value="<?= $key['cus_alamat'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Kota</label>
                                                                    <input type="text" name="cus_kota" required="required" class="form-control" value="<?= $key['cus_kota'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Provinsi</label>
                                                                    <input type="text" name="cus_provinsi" required="required" class="form-control" value="<?= $key['cus_provinsi'] ?>" style="width:100%">
                                                                </div>
                                                                <div class="form-group col-lg-4" style="width:100%">
                                                                    <label>Negara</label>
                                                                    <input type="text" name="cus_negara" required="required" class="form-control" value="<?= $key['cus_negara'] ?>" style="width:100%">
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