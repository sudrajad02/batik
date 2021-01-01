<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Edit Toko Batik</li>
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
                        <div class="col-md-8">
                            <div id="googleMap" style="width:650px;height:542px;"></div>
                        </div>
                        <div class="col-md-4">
                            <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_toko/<?php echo $toko->id_toko ?>" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label>Nama Toko*</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->nama_toko ?>" id="inp_nama" name="inp_nama">
                                        <?php echo form_error('inp_nama', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label>Alamat*</label>
                                        <textarea cols="30" rows="2" class="form-control" id="inp_alamat" name="inp_alamat"><?php echo $toko->alamat_toko ?></textarea>
                                        <?php echo form_error('inp_alamat', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label>Latitude*</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->latitude ?>" id="inp_latitude" name="inp_latitude" readonly>
                                        <?php echo form_error('inp_latitude', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label>Longitude*</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->longitude ?>" id="inp_longitude" name="inp_longitude" readonly>
                                        <?php echo form_error('inp_longitude', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label>No Hp Toko</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->no_hp_toko ?>" id="inp_no_hp" name="inp_no_hp">
                                        <?php echo form_error('inp_no_hp', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->email_toko ?>" id="inp_email" name="inp_email">
                                        <?php echo form_error('inp_email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" value="<?php echo $toko->website_toko ?>" id="inp_website" name="inp_website">
                                        <?php echo form_error('inp_website', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <input type="hidden" value="<?php echo $toko->id_toko ?>" name="inp_id_toko">
                                        <button type="submit" class="mt-1 btn btn-primary" name="btn_save">Simpan</button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/detail_toko/<?php echo $toko->id_toko ?>" class="mt-1 btn btn-warning" name="btn_save">Kembali</a>
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

<script>
    var marker;

    function taruhMarker(peta, posisiTitik) {

        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta
            });
        }

        //isi nilai latitude dan longitude
        document.getElementById("inp_latitude").value = posisiTitik.lat();
        document.getElementById("inp_longitude").value = posisiTitik.lng();
    }

    function buatMarker(peta, posisiTitik) {
        //membuat marker
        marker = new google.maps.Marker({
            position: posisiTitik,
            map: peta
        });
    }

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-7.797068, 110.370529),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        <?php
        $latitude = $toko->latitude;
        $longitude = $toko->longitude;
        ?>

        var lokasi = new google.maps.LatLng(<?php echo $latitude . "," ?><?php echo $longitude ?>);
        buatMarker(peta, lokasi);

        //event ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });
    }

    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
</script>