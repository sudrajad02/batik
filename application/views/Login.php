<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <center>
                    <div class="mb-2">
                        <h1 style="color: white">Login</h1>
                    </div>
                </center>
                <div class="login-form">
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo $this->session->flashdata('member_message'); ?>
                    <form action="<?php echo base_url() ?>Login" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="inp_username" value="<?php echo set_value('inp_username') ?>">
                            <?php echo form_error('inp_username', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class=" form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="inp_password" value="<?php echo set_value('inp_password') ?>">
                            <?php echo form_error('inp_password', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class=" checkbox">
                            <label class="pull-right">
                                <a href="<?php echo base_url() ?>Lupa_password">Lupa Password?</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Masuk</button>
                        <div class="register-link m-t-15 text-center">
                            <br />
                            <p>Belum punya akun ? <a href="<?php echo base_url() ?>Register"> Daftar Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>