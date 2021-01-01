<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <center>
                    <div class="mb-2">
                        <h1 style="color: white">Daftar Member</h1>
                    </div>
                </center>
                <div class="login-form">
                    <form action="<?php echo base_url() ?>Register" method="POST">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" name="inp_nama" value="<?php echo set_value('inp_nama') ?>">
                            <?php echo form_error('inp_nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="inp_email" value="<?php echo set_value('inp_email') ?>">
                            <?php echo form_error('inp_email', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="inp_username" value="<?php echo set_value('inp_username') ?>">
                            <?php echo form_error('inp_username', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="inp_password1">
                            <?php echo form_error('inp_password1', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Ulangi Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan Ulang Password" name="inp_password2">
                            <?php echo form_error('inp_password2', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <?php $this->session->userdata('message_captcha') ?>
                            <?php echo $script_captcha; ?>
                            <?php echo $captcha ?>
                            <?php echo form_error('g-recaptcha-response', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="btn_daftar">Daftar</button>
                        </div>
                        <div class="register-link m-t-15 text-center">
                            <p>Sudah punya akun ? <a href="<?php echo base_url() ?>Login"> Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>