<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <center>
                    <div class="mb-2">
                        <h1 style="color: white">Ganti Password</h1>
                    </div>
                </center>
                <div class="login-form">
                    <div class="text-center">
                        <h5 class="mb-4"><?php echo $this->session->userdata('reset_email') ?></h5>
                    </div>
                    <?php echo $this->session->flashdata('message'); ?>
                    <form action="<?php echo base_url() ?>Lupa_password/ganti_password" method="POST">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="inp_password1" value="<?php echo set_value('inp_password1') ?>">
                            <?php echo form_error('inp_password1', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Konfirm Password</label>
                            <input type="password" class="form-control" placeholder="Ulangi Password" name="inp_password2" value="<?php echo set_value('inp_password2') ?>">
                            <?php echo form_error('inp_password2', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <?php $this->session->userdata('message_captcha') ?>
                            <?php echo $script_captcha; ?>
                            <?php echo $captcha ?>
                            <?php echo form_error('g-recaptcha-response', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn btn-primary btn-flat m-b-15">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>