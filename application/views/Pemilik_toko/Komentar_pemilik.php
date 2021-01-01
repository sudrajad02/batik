<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Komentar Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Komentar Toko Batik</li>
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
                    <?php echo $this->session->flashdata('pesan_komentar') ?>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nama Toko</th>
                                <th scope="col">Komentar</th>
                                <th scope="col" style="width: 150px">Status Komentar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cek_komentar <= 0) {
                            ?>
                                <td colspan="4" align="center">Belum Mempunyai Komentar</td>
                                <?php
                            } else {
                                $no = 1;
                                foreach ($komentar as $komen) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $komen->nama ?></td>
                                        <td><?php echo $komen->nama_toko ?></td>
                                        <td><?php echo $komen->komentar ?></td>
                                        <?php if ($komen->status_komentar == 1) : ?>
                                            <td align="center">Aktif</td>
                                        <?php else : ?>
                                            <td align="center">Tidak Aktif</td>
                                        <?php endif; ?>
                                        <td><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko_detail/balas_komentar/<?php echo $komen->id_komentar ?>/<?php echo $toko->id_toko ?>" class="btn btn-success btn-sm"><i class="fa fa-comments"></i> Balas</a></td>
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