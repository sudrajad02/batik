<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Admin/Admin">Dashboard</a></li>
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
                    <div class="card-body">
                        <div class="container">
                            <?php echo $this->session->flashdata('message') ?>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" style="width: 150px">Nama Toko</th>
                                        <th scope="col" style="width: 200px">Alamat</th>
                                        <th scope="col">No Hp</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Website</th>
                                        <th scope="col" style="width: 130px">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($toko as $tk) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$start ?></th>
                                            <td><?php echo $tk->nama_toko ?></td>
                                            <td><?php echo $tk->alamat_toko ?></td>
                                            <td><?php echo $tk->no_hp_toko ?></td>
                                            <td><?php echo $tk->email_toko ?></td>
                                            <td><?php echo $tk->website_toko ?></td>
                                            <?php if ($tk->status_toko == 1) : ?>
                                                <td>Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_toko_batik/non_aktif/<?php echo $tk->id_toko ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menonaktifkan toko?')"><i class="fa fa-ban"></i> Non Aktif</a></td>
                                            <?php else : ?>
                                                <td>Tidak Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_toko_batik/aktif/<?php echo $tk->id_toko ?>" class="btn btn-success btn-sm" style="width: 90px" onclick="return confirm('Yakin mengaktifkan toko?')"><i class="fa fa-check"></i> Aktif</a></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $this->pagination->create_links() ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->