<section id="content">
    <div class="container">
        <div class="row">

            <div class="span12">
                <?php
                if ($this->session->userdata('status') == 'login_member') : ?>
                    <article>
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>Member/Member_toko/print_katalog" target="_blank" class="btn btn-medium btn-info">Cetak</a>
                        </div>
                    </article>
                <?php endif; ?>
                <?php if ($cek_toko <= 0) : ?>
                    <div class="span12">
                        <center>
                            <h1>Belum Ada Toko.</h1>
                        </center>
                    </div>
                <?php else : ?>
                    <?php foreach ($toko as $tk) : ?>
                        <article>
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><a href="<?php echo base_url() ?>Member/Member_toko/detail_toko/<?php echo $tk->id_toko ?>"><?php echo $tk->nama_toko ?></a></h3>
                                        </div>
                                        <?php
                                        $id_toko = $tk->id_toko;
                                        $query = $this->db->query("SELECT * FROM tb_foto_toko WHERE id_toko = '$id_toko' AND status_foto = 1")->row_array();
                                        $foto = $query['nama_foto'];
                                        ?>
                                        <img src="<?php echo base_url() ?>public/image/toko_batik/<?php echo $foto ?>" style="width:676px;height:368px" />
                                    </div>

                                </div>
                                <div class="span4">
                                    <div class="meta-post">
                                        <ul>
                                            <li><i class="icon-file"></i></li>
                                            <li>By <a href="#" class="author"><?php echo $tk->nama ?></a></li>
                                            <li>On <a href="#" class="date"><?php echo $tk->tgl_buat ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="post-entry">
                                        <p>
                                            <?php echo $tk->deskripsi ?>
                                        </p>
                                        <a href="<?php echo base_url() ?>Member/Member_toko/detail_toko/<?php echo $tk->id_toko ?>" class="readmore">Baca lebih <i class="icon-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                    <div id="pagination">
                        <span class="all">Halaman</span>
                        <?php echo $this->pagination->create_links() ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>