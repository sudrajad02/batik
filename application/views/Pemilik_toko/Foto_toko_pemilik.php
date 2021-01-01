<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Foto Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Foto Toko Batik</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("Pemilik_toko/Menu_detail_toko_pemilik"); ?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <?php if ($foto < 4) : ?>
                        <div class="mb-4">
                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/tambah_foto/<?php echo $toko->id_toko ?>" class="btn btn-success btn-lg">Tambah Foto Toko</a>
                        </div>
                    <?php endif; ?>
                    <?php echo $this->session->flashdata('pesan_foto');
                    ?>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Status</th>
                                <th scope="col">Foto Profil</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($foto <= 0) {
                            ?>
                                <td colspan="4" align="center">Belum Mempunyai Produk</td>
                                <?php
                            } else {
                                foreach ($foto_toko as $ft) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img src="<?php echo base_url() ?>public/image/toko_batik/<?php echo $ft->nama_foto ?>" width="130px" height="100px"></td>
                                        <?php if ($ft->status_foto == 1) : ?>
                                            <td>Foto Profil Toko</td>
                                            <td><a class="btn btn-secondary btn-sm" readonly="true" style="width: 90px">
                                                    <font color="white"><i class="fa fa-check"></i>
                                                        Aktif</font>
                                                </a></td>
                                        <?php else : ?>
                                            <td>Bukan Foto Profil Toko</td>
                                            <td><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/aktif/<?php echo $ft->id_foto_toko ?>/<?php echo $ft->id_toko ?>" class="btn btn-success btn-sm" style="width: 90px"><i class="fa fa-check"></i> Aktif</a></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_foto/<?php echo $ft->id_toko ?>/<?php echo $ft->id_foto_toko ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/hapus_foto_toko/<?php echo $ft->id_toko ?>/<?php echo $ft->id_foto_toko ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus?')"><i class="fa fa-trash-o"></i> Hapus</a>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>