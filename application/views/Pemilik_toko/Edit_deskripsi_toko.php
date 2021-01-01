<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Deskripsi Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Edit Deskripsi Toko Batik</li>
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
                        <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_deskripsi_toko/<?php echo $toko->id_toko ?>" method="post" enctype=multipart/form-data> <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label>Deskripsi*</label>
                                <textarea cols="30" rows="4" class="form-control" id="inp_deskripsi" name="inp_deskripsi" value="<?php echo set_value('inp_deskripsi'); ?>"><?php echo $toko->deskripsi ?></textarea>
                                <?php echo form_error('inp_deskripsi', '<small class="text-danger">', '</small>'); ?>
                            </div>
                    </div>
                    <?php
                    $hari_buka = $toko->hari_buka;
                    $hari_tutup = $toko->hari_tutup;
                    ?>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Hari Buka*</label>
                            <select class="form-control" name="inp_hari_buka" id="inp_hari_buka" value="<?php echo set_value('inp_hari_buka'); ?>">
                                <option value="">---Pilih---</option>
                                <?php
                                if ($hari_buka == "Senin") {
                                ?>
                                    <option value="Senin" selected>Senin</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Senin">Senin</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Selasa") {
                                ?>
                                    <option value="Selasa" selected>Selasa</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Selasa">Selasa</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Rabu") {
                                ?>
                                    <option value="Rabu" selected>Rabu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Rabu">Rabu</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Kamis") {
                                ?>
                                    <option value="Kamis" selected>Kamis</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Kamis">Kamis</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Jumat") {
                                ?>
                                    <option value="Jumat" selected>Jumat</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Jumat">Jumat</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Sabtu") {
                                ?>
                                    <option value="Sabtu" selected>Sabtu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Sabtu">Sabtu</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_buka == "Minggu") {
                                ?>
                                    <option value="Minggu" selected>Minggu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Minggu">Minggu</option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('inp_hari_buka', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Hari Tutup*</label>
                            <select class="form-control" name="inp_hari_tutup" id="inp_hari_tutup" value="<?php echo set_value('inp_hari_tutup'); ?>">
                                <option value="">---Pilih---</option>
                                <?php
                                if ($hari_tutup == "Senin") {
                                ?>
                                    <option value="Senin" selected>Senin</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Senin">Senin</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Selasa") {
                                ?>
                                    <option value="Selasa" selected>Selasa</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Selasa">Selasa</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Rabu") {
                                ?>
                                    <option value="Rabu" selected>Rabu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Rabu">Rabu</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Kamis") {
                                ?>
                                    <option value="Kamis" selected>Kamis</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Kamis">Kamis</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Jumat") {
                                ?>
                                    <option value="Jumat" selected>Jumat</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Jumat">Jumat</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Sabtu") {
                                ?>
                                    <option value="Sabtu" selected>Sabtu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Sabtu">Sabtu</option>
                                <?php
                                }
                                ?>

                                <?php
                                if ($hari_tutup == "Minggu") {
                                ?>
                                    <option value="Minggu" selected>Minggu</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Minggu">Minggu</option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('inp_hari_tutup', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Jam Buka*</label>
                            <input type="time" class="form-control" id="inp_jam_buka" name="inp_jam_buka" value="<?php echo $toko->jam_buka; ?>">
                            <?php echo form_error('inp_jam_buka', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Jam Tutup*</label>
                            <input type="time" class="form-control" id="inp_jam_tutup" name="inp_jam_tutup" value="<?php echo $toko->jam_tutup; ?>">
                            <?php echo form_error('inp_jam_tutup', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <button type="submit" class="mt-1 btn btn-primary pull-left" name="btn_update">Simpan</button>
                        </div>
                    </div>
                    <input type="hidden" name="inp_id_toko" value="<?php echo $id_toko ?>">
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->