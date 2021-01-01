<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Member Toko Batik</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik">Dashboard</a></li>
                    <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko">Daftar Toko Batik</a></li>
                    <li class="active">Member Toko Batik</li>
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
                    <div class="box-body table-responsive">
                        <table class="table" width="25px">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Nama Member</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($cek_member <= 0) {
                                ?>
                                    <td colspan="2" align="center">Belum Mempunyai Member</td>
                                    <?php
                                } else {
                                    foreach ($member as $mmb) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $mmb->nama ?></td>
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
            <!-- /.card -->
        </div>
    </div>
</div>