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
                    <li class="active">Produk Toko Batik</li>
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
                    <?php if ($cek_produk < 5) : ?>
                        <div class="mb-4">
                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/tambah_produk_toko/<?php echo $toko->id_toko ?>" class="btn btn-success btn-lg">Tambah Produk Toko</a>
                        </div>
                    <?php endif; ?>
                    <?php echo $this->session->flashdata('pesan_produk') ?>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Batik</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($cek_produk <= 0) {
                            ?>
                                <td colspan="4" align="center">Belum Mempunyai Produk</td>
                                <?php
                            } else {
                                foreach ($produk as $pdk) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $pdk->nama_batik ?></td>
                                        <td><img src="<?php echo base_url() ?>public/image/produk_toko/<?php echo $pdk->foto_batik ?>" width="130px" height="100px"></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/edit_produk_toko/<?php echo $pdk->id_produk ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/hapus_produk_toko/<?php echo $pdk->id_toko ?>/<?php echo $pdk->id_produk ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus?')"><i class="fa fa-trash-o"></i> Hapus</a>
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