<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Komentar</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Admin/Admin">Dashboard</a></li>
                    <li class="active">Daftar Komentar</li>
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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Komentar</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($komentar as $km) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$start ?></th>
                                            <td><?php echo $km->nama ?></td>
                                            <td><?php echo $km->email ?></td>
                                            <td><?php echo $km->komentar ?></td>
                                            <?php if ($km->status_komentar == 1) : ?>
                                                <td>Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_komentar/non_aktif/<?php echo $km->id_komentar ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menonaktifkan komentar?')"><i class="fa fa-ban"></i> Non Aktif</a></td>
                                            <?php else : ?>
                                                <td>Tidak Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_komentar/aktif/<?php echo $km->id_komentar ?>" class="btn btn-success btn-sm" style="width: 90px" onclick="return confirm('Yakin mengaktifkan komentar?')"><i class="fa fa-check"></i> Aktif</a></td>
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