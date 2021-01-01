<section id="content">
    <div class="container">
        <div class="row">
            <form action="<?php echo base_url() ?>Member/Member_profil" method="post" enctype=multipart/form-data> 
            <div class="span6">
                <div class="span4">
                    <img src="<?php echo base_url(); ?>public/image/foto_akun/<?php echo $member->foto_akun ?>" style="width: 340px;height: 310px;" />
                </div>
                <div class="span3">
                    <input type="hidden" class="span3" value="<?php echo $member->foto_akun ?>" name="inp_old_img">
                    <input type="file" class="span3" name="inp_img" accept=".jpg, .png, .jpeg">
                    <?php echo form_error('inp_img', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
        <div class="span6">
            <div class="span4 control-group">
                <?php echo $this->session->flashdata('pesan') ?>
            </div>
            <div class="span4 control-group">
                <label>Nama Member</label>
                <input type="text" class="span4" value="<?php echo $member->nama ?>" name="inp_nama">
                <?php echo form_error('inp_nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="span4 control-group">
                <label>Username</label>
                <input type="text" class="span4" value="<?php echo  $member->username ?>" name="inp_username">
                <?php echo form_error('inp_username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="span4 control-group">
                <label>Email</label>
                <input type="text" class="span4" value="<?php echo $member->email ?>" name="inp_email">
                <?php echo form_error('inp_email', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="span4 control-group">
                <label>No Hp</label>
                <input type="text" class="span4" value="<?php echo $member->no_hp ?>" name="inp_no_hp">
                <?php echo form_error('inp_no_hp', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="span4 control-group">
                <label>Alamat</label>
                <textarea name="inp_alamat" class="span4" rows="4"><?php echo $member->alamat ?></textarea>
                <?php echo form_error('inp_alamat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="span4 control-group">
                <button type="submit" class="mt-1 btn btn-primary" name="btn_save">Simpan</button>
            </div>
        </div>
        </form>
    </div>
    </div>
</section>