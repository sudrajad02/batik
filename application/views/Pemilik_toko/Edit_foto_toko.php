<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Foto Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Edit Foto Toko Batik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="container">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_foto/<?php echo $id_toko ?>/<?php echo $id_foto ?>" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label>Foto Toko*</label>
                                        <br><br>
                                        <img src="<?php echo base_url(); ?>public/image/toko_batik/<?php echo $foto->nama_foto ?>" width="250" height="250" />
                                    </div>
                                    <div class="position-relative form-group">
                                        <input type="file" class="form-control" id="inp_img" name="inp_img" value="<?php echo set_value('inp_img'); ?>" accept=".jpg, .jpeg, .png">
                                        <?php echo form_error('inp_img', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <input type="hidden" name="inp_id_foto_batik" value="<?php echo $id_foto ?>">
                                        <input type="hidden" name="inp_id_toko_batik" value="<?php echo $id_toko ?>">
                                        <input type="hidden" name="inp_old_img" value="<?php echo $foto->nama_foto ?>">
                                        <button type="submit" class="mt-1 btn btn-primary pull-left" name="btn_save">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->