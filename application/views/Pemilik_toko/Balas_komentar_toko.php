<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Balas Komentar</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Balas Komentar Toko Batik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="col-md-12">
                        <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/balas_komentar/<?php echo $id_komentar ?>/<?php echo $id_toko ?>" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label>Komentar*</label>
                                    <textarea name="inp_komen" id="inp_komen" cols="20" rows="5" readonly class="form-control"><?php echo $komentar->komentar ?></textarea>
                                </div>
                                <div class="position-relative form-group">
                                    <label>Balas Komentar*</label>
                                    <textarea name="inp_reply" id="inp_reply" cols="20" rows="5" class="form-control"></textarea>
                                    <?php echo form_error('inp_reply', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <input type="hidden" name="inp_parent_id" value="<?php echo $id_komentar ?>">
                                    <input type="hidden" name="inp_id_toko" value="<?php echo $id_toko ?>">
                                    <button type="submit" class="mt-1 btn btn-primary pull-left" name="btn_save">Kirim Balasan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>