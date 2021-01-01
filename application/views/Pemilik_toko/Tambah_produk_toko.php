<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Produk Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Tambah Produk Toko Batik</li>
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
                        <div class="col-md-12">
                            <form action="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/tambah_produk_toko/<?php echo $id_toko ?>" method="post" enctype=multipart/form-data> <div class="position-relative form-group">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label>Nama Batik*</label>
                                        <input type="text" class="form-control" id="inp_nama_batik" name="inp_nama_batik" value="<?php echo set_value('inp_nama_batik'); ?>">
                                        <?php echo form_error('inp_nama_batik', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label>Foto Produk*</label>
                                        <input type="file" class="form-control" id="inp_foto_produk" name="inp_foto_produk" value="<?php echo set_value('inp_foto_produk'); ?>" accept="jpg">
                                        <?php echo form_error('inp_foto_produk', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <input type="hidden" name="inp_id_toko" value="<?php echo $id_toko ?>">
                                        <button type="submit" class="mt-1 btn btn-primary pull-left" name="btn_save">Simpan</button>
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