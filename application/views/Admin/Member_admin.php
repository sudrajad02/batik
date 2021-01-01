<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Member</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Admin/Admin">Dashboard</a></li>
                    <li class="active">Daftar Member</li>
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
                                        <th scope="col">Nama Member</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Hp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($member as $mb) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$start ?></th>
                                            <td><?php echo $mb->nama ?></td>
                                            <td><?php echo $mb->email ?></td>
                                            <td><?php echo $mb->no_hp ?></td>
                                            <td><?php echo $mb->alamat ?></td>
                                            <?php if ($mb->status_akun == 1) : ?>
                                                <td>Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_member/non_aktif/<?php echo $mb->id_akun ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menonaktifkan member?')"><i class="fa fa-ban"></i> Non Aktif</a></td>
                                            <?php else : ?>
                                                <td>Tidak Aktif</td>
                                                <td><a href="<?php echo base_url() ?>Admin/Admin_member/aktif/<?php echo $mb->id_akun ?>" class="btn btn-success btn-sm" style="width: 90px" onclick="return confirm('Yakin mengaktifkan komentar?')"><i class="fa fa-check"></i> Aktif</a></td>
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