<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <center>
                    <div class="mb-2">
                        <h1 style="color: white">Lupa Password</h1>
                    </div>
                </center>
                <div class="login-form">
                    <?php echo $this->session->flashdata('message'); ?>
                    <form action="<?php echo base_url() ?>Lupa_password" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" placeholder="Email" name="inp_email" value="<?php echo set_value('inp_email') ?>">
                            <?php echo form_error('inp_email', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-15">Kirim</button>
                        <div class="mb-4">
                            <div class="checkbox">
                                <label class="pull-left">
                                    <a href="<?php echo base_url() ?>Login">Kembali Ke Halaman Login</a>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>