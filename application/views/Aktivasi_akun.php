<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <?php echo $this->session->flashdata('message'); ?>
                    <form action="<?php echo base_url() ?>Member/Member_register_pemilik/aktivasi" method="POST">                        
                        <button type="submit" name="btn_aktivasi" class="btn btn-primary btn-flat m-b-15">Aktivasi Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>