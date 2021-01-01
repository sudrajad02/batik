<section id="content">
    <div class="container">
        <div class="row">
            <div class="span8">
                <article class="single">
                    <div class="row">
                        <div class="span8">
                            <div class="post-image">
                                <div class="post-heading">
                                    <h3><a href="<?php base_url() ?>"><?php echo $toko->nama_toko ?></h3>
                                </div>
                                <img src="<?php echo base_url() ?>public/image/toko_batik/<?php echo $foto_toko_profil->nama_foto ?>" alt="" />
                            </div>
                            <div class="meta-post">
                                <ul>
                                    <li><i class="icon-file"></i></li>
                                    <li>By <a href="#" class="author"><?php echo $toko->nama ?></a></li>
                                    <li>On <a href="#" class="date"><?php echo $toko->tgl_buat ?></a></li>
                                </ul>
                            </div>
                            <p><?php echo $toko->deskripsi ?></p>
                        </div>
                    </div>
                </article>

                <!--Tombol Join!-->
                <?php if ($cek_member > 0) { ?>
                    <center><a class="btn btn-medium btn" readonly="true">Sudah Menjadi Member</a></center>
                <?php } else { ?>
                    <center><a href="<?php echo base_url() ?>Member/Member_toko/join_member/<?php echo $toko->id_toko ?>" class="btn btn-medium btn-info">Gabung Member</a></center>
                <?php } ?>
                <br>

                <?php echo $this->session->flashdata('member_message'); ?>

                <br>
                <!--Produk Toko!-->
                <div class="comment-area">
                    <h4>Produk Toko</h4>
                    <?php if ($cek_produk > 0) : ?>
                        <ul id="flexiselDemo1" class="span7">
                            <?php foreach ($produk as $pdk) : ?>
                                <li>
                                    <img src="<?php echo base_url() ?>public/image/produk_toko/<?php echo $pdk->foto_batik ?>" style="width: 200px;height:150px" />
                                    <p><?php echo $pdk->nama_batik ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>Belum Mempunyai Produk</p>
                    <?php endif; ?>
                </div>

                <!--Komentar!-->
                <div class="comment-area">
                    <h4><?php echo $jml_komentar ?> Komentar</h4>
                    <?php if ($cek_komentar > 0) : ?>
                        <ol class="comment-list">
                            <?php echo komentar_tree_renderer($toko->id_toko, $komentar, $reply); ?>
                        </ol>
                    <?php else : ?>
                        <p>Belum Mempunyai Komentar</p>
                    <?php endif ?>

                    <div class="marginbot30"></div>
                    <h4>Tinggalkan Komentar Disini</h4>

                    <form id="commentform" action="<?php echo base_url() ?>Member/Member_toko/tambah_komen_proses" method="post" name="comment-form">
                        <div class="row">
                            <div class="span8 margintop10">
                                <?php echo $this->session->flashdata('eror');
                                ?>
                                <p>
                                    <input type="hidden" name="inp_id_toko" value="<?php echo $toko->id_toko ?>">
                                    <textarea cols="30" rows="4" id="inp_komentar" name="inp_komentar"></textarea>
                                </p>
                                <p>
                                    <button class="btn btn-theme btn-medium margintop10" name="btn_komen" type="submit">Kirim Komentar</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="span4">
                <aside class="right-sidebar">
                    <?php if ($this->session->userdata('status') == 'login_member') : ?>
                        <div class="widget">
                            <div class="tabbable tabs-right">
                                <div class="tab-content">
                                    <a href="<?php echo base_url() ?>Member/Member_toko/print_detail_toko/<?php echo $toko->id_toko ?>" target="_blank" class="btn btn-medium btn-info">Cetak</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="widget">
                        <div class="tabbable tabs-right">
                            <div class="tab-content">
                                <p><b>Alamat : </b> <?php echo $toko->alamat_toko ?></p>
                                <p><b>Hari Buka :</b> <?php echo $toko->hari_buka . " - " . $toko->hari_tutup ?></p>
                                <p><b>Jam Operasional :</b> <?php echo $toko->jam_buka . " - " . $toko->jam_tutup ?></p>
                                <p><b>No Hp : </b> <?php echo $toko->no_hp_toko ?></p>
                                <p><b>Email :</b> <?php echo $toko->email_toko ?></p>
                                <p><b>Website :</b> <?php echo $toko->website_toko ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="widget">
                        <h5><a href="<?php base_url() ?>">Foto Toko</h5>
                        <div class="tabbable tabs-right">
                            <div class="tab-content">
                                <?php foreach ($foto_toko as $fto) : ?>
                                    <img src="<?php echo base_url() ?>public/image/toko_batik/<?php echo $fto->nama_foto ?>" alt="" />
                                    <br /><br />
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    $(window).load(function() {
        $("#flexiselDemo1").flexisel({
            visibleItems: 3,
            itemsToScroll: 1,
            autoPlay: {
                enable: true,
                interval: 5000,
                pauseOnHover: true
            }
        });

    });
</script>

<?php
function komentar_tree_renderer($id_toko, $komen, $reply = 0, $level = 1)
{
    static $margin = 35;
    $id_member = isset($_SESSION['id_member']) ? $_SESSION['id_member'] : 0;

    if (!isset($komen->items) or empty($komen->items)) {
        return '';
    }
    $coddeven  = (($level % 2) == 0) ? 'odd' : 'even';
    $out = '';
    $thread = 1;
    $levelmargin = $margin * $level;
    foreach ($komen->items as $kmn) {
        $childs    = $kmn->items;
        $hasChilds = !empty($childs);
        if ($level == 1) {
            if ($hasChilds) {
                $isparent = ' parent';
            } else {
                $isparent = ' thread-alt';
            }
        } else {
            if ($hasChilds) {
                $isparent = ' parent';
            } else {
                $isparent = '';
            }
        }

        $class = "comment " . $coddeven;
        $toddeven  = (($thread % 2) == 0) ? 'odd' : 'even';
        if ($isparent) {
            $class .= " thread-" . $toddeven;
        } else {
            $class .= " alt";
        }

        $tgl_komen = $kmn->tgl_komen;
        $out .= "<div class='media'>";
        $out .= "<a href='#' class='pull-left'><img src='" . base_url() . "public/image/foto_akun/" . $kmn->foto_akun . "' alt='' style='width:60px;height:60px' class='img-circle' /></a>";
        $out .= "<div class='media-body'>";
        $out .= "<div class='media-content'>";
        if ($kmn->id_hak_akses == 2) {
            $out .= "<h6><span>" . date("d F Y", strtotime($tgl_komen)) . "</span><font color='red'> " . $kmn->nama . "</font></h6>";
        } else {
            $out .= "<h6><span>" . date("d F Y", strtotime($tgl_komen)) . "</span> " . $kmn->nama . "</h6>";
        }
        $out .= "<p>" . $kmn->komentar . "</p>";
        if ($level < 3) {
            $out .= '<a rel="nofollow" class="align-right" href="' . base_url('Member/Member_toko/detail_toko/' . $id_toko . '/' . $kmn->id_komentar) . '" data-commentid="' . $kmn->id_komentar . '" data-postid="' . $kmn->id_komentar . '" data-belowelement="div-comment-' . $kmn->id_komentar . '" data-respondelement="respond" aria-label="Reply to ' . $kmn->nama . '">Balas</a>';
            $out .= "</div>";
            $out .= "</div>";
        }
        $out .= "</div>";

        if (($reply === $kmn->id_komentar) and ($level < 3)) {
            $out .= "<form id='commentform' action='" . base_url() . "Member/Member_toko/tambah_komen_proses' method='post' name='comment-form'>";
            $out .= "<div class='row'>";
            $out .= "<div class='span8 margintop10'>";
            $out .= "<input type='hidden' name='inp_id_toko' value='" . $kmn->id_toko . "'>";
            $out .= '<input type="hidden" name="inp_parent_id" value="' . $kmn->id_komentar . '" />';
            $out .= '<input type="hidden" name="inp_id_member" value="' . $id_member . '" />';
            $out .= "<p><textarea cols='30' rows='4' id='inp_komentar' name='inp_komentar'></textarea></p>";
            $out .= "<p><button class='btn btn-theme btn-medium margintop10' name='btn_komen' type='submit'>Kirim Komentar</button></p>";
            $out .= "</div>";
            $out .= "</div>";
            $out .= "</form>";
        }
        if ($hasChilds) {
            $out .= '<ol class="children" style="margin-left:' . $levelmargin . 'px;">';
            $out .= komentar_tree_renderer($id_toko, $kmn, $reply, ($level + 1));
            $out .= '</ol>';
        }
        $thread++;
    }

    return $out;
}
?>