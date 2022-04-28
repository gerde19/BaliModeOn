<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Kode Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Kode Kapal</h1>
        <div class="section-header-button">
            <a href="<?= site_url('kk/add') ?>" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Kode</a>
        </div>
    </div>

    <!-- MODAL -->
    <form action="" method="post">
        <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Kode Kapal:</label>
                            <input type="text" name="kapal" class="form-control" id="recipient-name">
                        </div>
                        <!-- <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div> -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Data Kode Kapal</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">KODE KAPAL</th>
                                    <th width="10%" class="text-center">OPSI</th>
                                </tr>
                                <?php foreach ($kode_kapal as $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $row->kk_kode ?></td>
                                        <td class="text-center">
                                            <?php if ($row->kk_id != 1) { ?>
                                                <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kode_<?= $row->kk_id ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="<?= site_url('kk/delete/' . $row->kk_id) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } ?>

                                            <form action="<?= site_url('kk/edit' . $row->kk_id) ?>" method="post">
                                                <div class="modal fade" data-backdrop="false" id="edit_kode_<?= $row->kk_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Kode</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= csrf_field(); ?>
                                                                <div class="form-group" style="width:100%">
                                                                    <label>Nama Kode</label>

                                                                    <input type="text" name="kode" required="required" class="form-control" placeholder="Nama Kode .." value="<?= $row->kk_kode ?>" style="width:100%">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>
                                                                <button type="reset" class="btn btn-secondary"> Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

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