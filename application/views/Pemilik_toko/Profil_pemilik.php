<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Profil <?php echo $pemilik->nama ?></h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li class="active">Profil</li>
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
                    <div class="row">
                        <div class="col-md-4">
                            <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_profil" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                                <img src="<?php echo base_url(); ?>public/image/foto_akun/<?php echo $pemilik->foto_akun ?>" width="250" height="250" />
                        </div>
                        <div class="position-relative form-group">
                            <input type="hidden" class="form-control" value="<?php echo $pemilik->foto_akun ?>" name="inp_old_img">
                            <input type="file" class="form-control" name="inp_img" accept=".jpg, .png, .jpeg">
                            <?php echo form_error('inp_img', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->session->flashdata('pesan') ?>
                        <div class="position-relative form-group">
                            <label>Nama Pemilik Toko</label>
                            <input type="text" class="form-control" value="<?php echo $pemilik->nama ?>" name="inp_nama">
                            <?php echo form_error('inp_nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?php echo $pemilik->username ?>" name="inp_username">
                            <?php echo form_error('inp_username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo $pemilik->email ?>" name="inp_email">
                            <?php echo form_error('inp_email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <label>Alamat</label>
                            <textarea name="inp_alamat" id="inp_alamat" cols="30" rows="2" class="form-control"><?php echo $pemilik->alamat ?></textarea>
                            <?php echo form_error('inp_alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control" value="<?php echo $pemilik->no_hp ?>" name="inp_no_hp">
                            <?php echo form_error('inp_no_hp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <button type="submit" class="mt-1 btn btn-primary" name="btn_save">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->