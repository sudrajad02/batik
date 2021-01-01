<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Pemilik Toko</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Admin/Admin">Dashboard</a></li>
                    <li class="active">Daftar Pemilik Toko</li>
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
                        <?php echo $this->session->flashdata('message') ?>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Hp</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pemilik as $pmlk) :
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo ++$start ?></th>
                                        <td><?php echo $pmlk->nama ?></td>
                                        <td><?php echo $pmlk->email ?></td>
                                        <td><?php echo $pmlk->no_hp ?></td>
                                        <td><?php echo $pmlk->alamat ?></td>
                                        <?php if ($pmlk->status_akun == 1) : ?>
                                            <td>Aktif</td>
                                            <td><a href="<?php echo base_url() ?>Admin/Admin_pemilik_toko/non_aktif/<?php echo $pmlk->id_akun ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menonaktifkan pemilik toko?')"><i class="fa fa-ban"></i> Non Aktif</a></td>
                                        <?php else : ?>
                                            <td>Tidak Aktif</td>
                                            <td><a href="<?php echo base_url() ?>Admin/Admin_pemilik_toko/aktif/<?php echo $pmlk->id_akun ?>" class="btn btn-success btn-sm" style="width: 90px" onclick="return confirm('Yakin mengaktifkan pemilik toko?')"><i class="fa fa-check"></i> Aktif</a></td>
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
    </div><!-- .animated -->
</div><!-- .content -->