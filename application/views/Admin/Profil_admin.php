<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Profil <?php echo $admin->nama ?></h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Admin/Admin">Dashboard</a></li>
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
                            <form action="<?php echo base_url() ?>Admin/Admin_profil" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                                <img src="<?php echo base_url(); ?>public/image/foto_akun/<?php echo $admin->foto_akun ?>" width="250" height="250" />
                        </div>
                        <div class="position-relative form-group">
                            <input type="hidden" class="form-control" value="<?php echo $admin->foto_akun ?>" name="inp_old_img">
                            <?php echo form_error('inp_img', '<small class="text-danger">', '</small>'); ?>
                            <input type="file" class="form-control" name="inp_img">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="position-relative form-group">
                            <label>Nama Admin</label>
                            <input type="text" class="form-control" value="<?php echo $admin->nama ?>" name="inp_nama">
                            <?php echo form_error('inp_nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="position-relative form-group">
                            <label>Username Admin</label>
                            <input type="text" class="form-control" value="<?php echo $admin->username ?>" name="inp_username">
                            <?php echo form_error('inp_username', '<small class="text-danger">', '</small>'); ?>
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