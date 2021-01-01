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
                    <li class="active">Deskripsi Toko Batik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("Pemilik_toko/Menu_detail_toko_pemilik"); ?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="container">
                <div class="card-body">
                    <?php echo $this->session->flashdata('message') ?>
                    <table class="table">
                        <tr>
                            <td style="width:30%"><strong>Deskripsi Toko Batik</strong></td>
                            <td><?php echo $toko->deskripsi; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Hari Buka</strong></td>
                            <td><?php echo $toko->hari_buka . " - " . $toko->hari_tutup; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Jam Operasional</strong></td>
                            <td><?php echo $toko->jam_buka . " - " . $toko->jam_tutup; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>

                    <br />
                    <div align="center">
                        <div class="mb-4">
                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_deskripsi_toko/<?php echo $toko->id_toko ?>" class="btn btn-info btn-lg"><i class="fa fa-edit"></i> Edit Data</a>
                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.card -->