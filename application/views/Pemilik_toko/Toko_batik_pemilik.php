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
                    <li class="active">Toko Batik</li>
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
                            <td style="width:30%"><strong>Nama Toko</strong></td>
                            <td><?php echo $toko->nama_toko; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Toko</strong></td>
                            <td><?php echo $toko->alamat_toko; ?></td>
                        </tr>
                        <tr>
                            <td><strong>No Hp Toko</strong></td>
                            <td><?php echo $toko->no_hp_toko; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email Toko</strong></td>
                            <td><?php echo $toko->email_toko; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Website Toko</strong></td>
                            <td><?php echo $toko->website_toko; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Longitude Toko</strong></td>
                            <td><?php echo $toko->longitude; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Latitude Toko</strong></td>
                            <td><?php echo $toko->latitude; ?></td>
                        </tr>
                    </table>

                    <br />
                    <div align="center">
                        <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_toko/<?php echo $toko->id_toko ?>" class="btn btn-info btn-lg"><i class="fa fa-edit"></i> Edit Data</a>
                        <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/hapus_toko/<?php echo $toko->id_toko ?>" class="btn btn-danger btn-lg" onclick="return confirm('Yakin Hapus?')"><i class="fa fa-trash"></i> Hapus</a>
                        <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                        <br /><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>