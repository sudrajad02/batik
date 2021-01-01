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
                    <li class="active">Daftar Toko Batik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="container">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko/tambah_toko" class="btn btn-primary btn-md">Tambah Toko</a>
                            </div>
                            <?php echo $this->session->flashdata('message') ?>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Toko</th>
                                        <th>Alamat Toko</th>
                                        <th>Longitude</th>
                                        <th>Latitude</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($cek_toko <= 0) :
                                    ?>
                                        <tr>
                                            <td colspan="6">
                                                <center>Belum Punya Toko</center>
                                            </td>
                                        </tr>
                                        <?php
                                    else :
                                        $no = 1;
                                        foreach ($toko as $tk) : ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $tk->nama_toko ?></td>
                                                <td><?php echo $tk->alamat_toko ?></td>
                                                <td><?php echo $tk->longitude ?></td>
                                                <td><?php echo $tk->latitude ?></td>
                                                <td><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/detail_toko/<?php echo $tk->id_toko ?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i> Detail</a></td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->